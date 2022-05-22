// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import {IConstantFlowAgreementV1} from "@superfluid/interfaces/agreements/IConstantFlowAgreementV1.sol";
import {ISuperTokenFactory} from "@superfluid/interfaces/superfluid/ISuperTokenFactory.sol";
import {ISuperfluid, ISuperToken, ISuperApp, ISuperAgreement, SuperAppDefinitions} from "@superfluid/interfaces/superfluid/ISuperfluid.sol";
import {Ownable} from "@openzeppelin/contracts/access/Ownable.sol";
import {IPoolAddressesProvider} from "../interfaces/IPoolAddressesProvider.sol";
import {IPool} from "../interfaces/IPool.sol";
import {IStreamMarket} from "../interfaces/IStreamMarket.sol";
import {ITrustIDA} from "../interfaces/ITrustIDA.sol";

import {IERC20} from "@openzeppelin/contracts/token/ERC20/IERC20.sol";

contract TrustCFA is Ownable {
    IStreamMarket private market;
    IConstantFlowAgreementV1 private _cfa;
    ISuperfluid private _host;
    ISuperToken private _acceptedToken;
    IPoolAddressesProvider private provider =
        IPoolAddressesProvider(
            address(0x5343b5bA672Ae99d627A1C87866b8E53F47Db2E6)
        );
    IPool private lendingPool = IPool(provider.getPool());
    ITrustIDA idaContract;

    //assets to invest
    mapping(string => address) public s_assetAddress;

    enum PAYTYPE {
        INSTALLMENTS,
        STREAM
    }

    enum ORIGIN {
        NATIVE,
        FIAT
    }

    struct Company {
        address _address;
        bool status;
        PAYTYPE paymentType;
        uint256 totalPaying;
        ORIGIN origin;
    }

    mapping(address => address[]) public s_companyEmployees;

    mapping(address => Company) public s_companyInfo;

    struct EmployeeInfo {
        bool isActive;
        uint256 monthlyIncome;
        address employer;
        uint256 startTime;
        uint256 paymentInterval;
        PAYTYPE paymentType;
        bool isInvesting;
        bool hasLoan;
    }
    address[] public periodicEmployees;

    mapping(address => EmployeeInfo) private s_employeeinfo;

    struct InvestmentInfo {
        bool isActive;
        uint256 startTime;
        uint128 percentage;
        uint256 frequency;
        uint256 amountAccumunated;
        address asset;
    }

    address private investmentKeeper;

    mapping(address => InvestmentInfo) private s_addressInvestment;

    address[] public s_investingAddresses; //active addresses

    struct Loan {
        address employee;
        uint256 startTime;
        uint256 amount;
        uint256 endTime;
    }

    uint256 public loans;
    mapping(uint256 => Loan) public s_loanpositions;

    mapping(address => uint256) private s_accumulated;

    modifier onlyAdmin() {
        require(msg.sender == owner());
        _;
    }

    modifier onlyInvestmentKeeper() {
        require(msg.sender == investmentKeeper);
        _;
    }

    constructor(
        address host,
        address cfa,
        address _trustIDA
    ) {
        _host = ISuperfluid(host);
        _cfa = IConstantFlowAgreementV1(cfa);
        idaContract = ITrustIDA(_trustIDA);
    }

    /**
     * @notice add a compny to the platform
     * @dev only callable by the contract admin
     * @param _payType: the type of payment the company gives ie. Installments or stream
     * @param _companyAddress: the address of the company
     */
    function _createCompany(
        uint8 _payType,
        address _companyAddress,
        uint8 _origin
    ) external {
        if (_origin == 0) {
            if (_payType == 1) {
                s_companyInfo[_companyAddress] = Company(
                    _companyAddress,
                    true,
                    PAYTYPE.STREAM,
                    0,
                    ORIGIN.NATIVE
                );
            } else {
                s_companyInfo[_companyAddress] = Company(
                    _companyAddress,
                    true,
                    PAYTYPE.INSTALLMENTS,
                    0,
                    ORIGIN.NATIVE
                );
            }
        } else {
            if (_payType == 0) {
                s_companyInfo[_companyAddress] = Company(
                    _companyAddress,
                    true,
                    PAYTYPE.INSTALLMENTS,
                    0,
                    ORIGIN.FIAT
                );
            } else {
                s_companyInfo[_companyAddress] = Company(
                    _companyAddress,
                    true,
                    PAYTYPE.STREAM,
                    0,
                    ORIGIN.FIAT
                );
            }
        }
    }

    /**
     * @notice add an employer to the platform
     * @dev only callable by an active employer
     * @param _employeeAddress: address of the employer
     * @param _salary: the employee salary
     * @param _paymentInterval: the interval to which the employee receives the pay
     */
    function _addemployee(
        address _employeeAddress,
        uint256 _salary,
        uint256 _paymentInterval
    ) external {
        Company storage company = s_companyInfo[msg.sender];
        require(company.status == true, "not active");
        s_employeeinfo[_employeeAddress] = EmployeeInfo(
            false,
            _salary,
            msg.sender,
            block.timestamp,
            _paymentInterval,
            company.paymentType,
            false,
            false
        );
        s_companyInfo[msg.sender].totalPaying += _salary;
        //if (company.paymentType == PAYTYPE.STREAM) {
        //    //ascertain that the mployer has paid
        //    //create flow to the employee
        //}
        if (company.paymentType == PAYTYPE.INSTALLMENTS) {
            idaContract._addAddressToIndex(_employeeAddress, _salary);
            periodicEmployees.push(_employeeAddress);
        }
    }

    function getEmployeeIndex(address _employee)
        public
        view
        returns (uint256 index)
    {
        uint256 size = getTotalCompanyEmployees(msg.sender);
        for (uint256 i = 0; i > size; i++) {
            if (s_companyEmployees[msg.sender][i] == _employee) {
                index = i;
            }
        }
    }

    function removeEmployee(address _employee) external {
        require(msg.sender == s_employeeinfo[_employee].employer);
        uint256 indexToremove = getEmployeeIndex(_employee);
        uint256 size = getTotalCompanyEmployees(msg.sender) - 1;
        s_employeeinfo[_employee] = EmployeeInfo(
            false,
            0,
            address(0),
            0,
            0,
            PAYTYPE.INSTALLMENTS,
            false,
            false
        );
        if (s_companyInfo[msg.sender].paymentType == PAYTYPE.INSTALLMENTS) {
            //remove employee from IDA
            idaContract.removeAddress(_employee);
        }
        if (indexToremove == size) {
            s_companyEmployees[msg.sender].pop();
        } else {
            s_companyEmployees[msg.sender][indexToremove] = s_companyEmployees[
                msg.sender
            ][size];
            s_companyEmployees[msg.sender].pop();
        }
    }

    function createIvestmentPosition(
        uint128 _percentage,
        uint256 _frequency,
        string memory _asset
    ) external {
        EmployeeInfo storage employee = s_employeeinfo[msg.sender];
        require(employee.paymentType == PAYTYPE.STREAM, "not eligible");
        s_addressInvestment[msg.sender] = InvestmentInfo(
            true,
            block.timestamp,
            _percentage,
            _frequency,
            0,
            s_assetAddress[_asset]
        );
        s_investingAddresses.push(msg.sender);
    }

    function stopInvestmentPosition() external {
        EmployeeInfo storage employee = s_employeeinfo[msg.sender];
        require(employee.isActive == true, "not investing");
        s_addressInvestment[msg.sender] = InvestmentInfo(
            false,
            block.timestamp,
            0,
            0,
            0,
            address(0)
        );
    }

    function makeInvestmentDeposit(address recepient, address token)
        external
        onlyInvestmentKeeper
    {
        InvestmentInfo storage investment = s_addressInvestment[recepient];
        s_accumulated[recepient] = _totalAccumulated(recepient);
        uint256 amount = s_accumulated[recepient];
        IERC20(token).approve(address(lendingPool), amount);
        lendingPool.deposit(token, amount, recepient, 0);
        //update the user details

        uint256 feq = investment.frequency;
        s_addressInvestment[recepient] = InvestmentInfo(
            true,
            block.timestamp,
            investment.percentage,
            0,
            feq,
            investment.asset
        );
    }

    function openStream(address _to, int96 _flowRate) external {
        _createFlow(_to, _flowRate);
    }

    function closeStream(address _to) external {
        _deleteFlow(address(this), _to);
    }

    function reduceFlow(address to, int96 flowRate) external {
        _updateFlow(to, flowRate);
    }

    function _createFlow(address to, int96 flowRate) internal {
        if (to == address(this) || to == address(0)) return;
        _host.callAgreement(
            _cfa,
            abi.encodeWithSelector(
                _cfa.createFlow.selector,
                _acceptedToken,
                to,
                flowRate,
                new bytes(0) // placeholder
            ),
            "0x"
        );
    }

    function _updateFlow(address to, int96 flowRate) internal {
        if (to == address(this) || to == address(0)) return;
        _host.callAgreement(
            _cfa,
            abi.encodeWithSelector(
                _cfa.updateFlow.selector,
                _acceptedToken,
                to,
                flowRate,
                new bytes(0) // placeholder
            ),
            "0x"
        );
    }

    function _deleteFlow(address from, address to) internal {
        _host.callAgreement(
            _cfa,
            abi.encodeWithSelector(
                _cfa.deleteFlow.selector,
                _acceptedToken,
                from,
                to,
                new bytes(0) // placeholder
            ),
            "0x"
        );
    }

    function sellStream(uint256 amount, uint256 endTime) external {
        EmployeeInfo storage _employee = s_employeeinfo[msg.sender];
        require(_employee.isActive == true); //@dev: not active
        require(amount <= (_employee.monthlyIncome / 2)); //@dev; has to be haff of salary or less
        require(endTime <= 30 days); //@dev has to be paid within a month
        require(_employee.hasLoan == false); //@dev cant borrow twice
        if (_employee.paymentType == PAYTYPE.STREAM) {
            s_loanpositions[loans] = Loan(
                msg.sender,
                block.timestamp,
                amount,
                endTime
            );
            market.addPosition(loans, amount, endTime, msg.sender, false);
        }
    }

    function addAdmin(address _keeper) external {
        investmentKeeper = _keeper;
    }

    function _totalAccumulated(address _investor)
        private
        view
        returns (uint256)
    {
        InvestmentInfo storage investment = s_addressInvestment[_investor];
        EmployeeInfo storage employee = s_employeeinfo[_investor];
        require(employee.paymentType == PAYTYPE.STREAM); //@dev: must be a streaming employee
        uint256 startTime = investment.startTime;
        uint256 flowrate = (employee.monthlyIncome / (30 days));
        return ((block.timestamp - startTime) * flowrate);
    }

    function getEmployeeFlowRate(address _employee)
        external
        view
        returns (int96)
    {
        uint256 salary = s_employeeinfo[_employee].monthlyIncome;
        return toIint(salary);
    }

    function toIint(uint256 number) private pure returns (int96) {
        int256 number1 = int256(number);
        return (int96(number1));
    }

    function getTotalInvestors() external view returns (uint256 number) {
        number = s_investingAddresses.length;
    }

    function getPeriodicEmployee() external view returns (uint256 len) {
        len = periodicEmployees.length;
    }

    function getTotalCompanyEmployees(address _company)
        public
        view
        returns (uint256)
    {
        s_companyEmployees[_company].length;
    }

    function getTotalPaying(address _company) public view returns (uint256) {
        s_companyInfo[_company].totalPaying;
    }

    /**
     * @notice get an employer's infor
     * @param _company: employee address
     */
    function viewCompanyInfo(address _company)
        external
        view
        returns (
            address _address,
            bool status,
            PAYTYPE payType,
            uint256 totalPaying
        )
    {
        Company storage company = s_companyInfo[_company];
        _address = company._address;
        status = company.status;
        payType = company.paymentType;
        totalPaying = company.totalPaying;
    }

    /**
     * @notice get an employee's infor
     * @param _employee: employee address
     */
    function viewEmployeeInfo(address _employee)
        external
        view
        returns (
            uint256 salary,
            address employer,
            uint256 startTime,
            uint256 paymentInterval
        )
    {
        EmployeeInfo storage employeeInfor = s_employeeinfo[_employee];
        salary = employeeInfor.monthlyIncome;
        employer = employeeInfor.employer;
        startTime = employeeInfor.startTime;
        paymentInterval = employeeInfor.paymentInterval;
    }

    function viewInvestment(address _investor)
        external
        view
        returns (
            bool isActive,
            uint256 startTime,
            uint128 percentage,
            uint256 frequency,
            uint256 amountAccumunated,
            address asset
        )
    {
        InvestmentInfo storage invest = s_addressInvestment[_investor];
        isActive = invest.isActive;
        startTime = invest.startTime;
        percentage = invest.percentage;
        frequency = invest.frequency;
        amountAccumunated = invest.amountAccumunated;
        asset = invest.asset;
    }
}
