// SPDX-License-Identifier: MIT

pragma solidity ^0.8.13;

interface ITrust {
    function openStream(address _to, int96 _flowrate) external;

    function closeStream(address _to) external;

    function makeInvestmentDeposit(address _recepient, address _token) external;

    function _getFlow(address sender) external view returns (uint256, int96);

    function removeEmployee(address _toRemove) external;

    function getTotalCompanyEmployees(address _company)
        external
        view
        returns (uint256);

    function getTotalPaying(address _company) external view returns (uint256);

    //function getUserAddress(uint256 index) external view returns (address);

    function s_investingAddresses(uint256 index)
        external
        view
        returns (address);

    function reduceFlow(address to) external;

    function getTotalAddresses() external view returns (uint256);

    function addAdmin(address _adminCon) external;

    function getEmployeeFlowRate(address _employee)
        external
        view
        returns (int96);

    function getTotalInvestors() external view returns (uint256 number);

    function s_companyEmployees(uint256 index) external view returns (address);

    function getPeriodicEmployee() external view returns (uint256 len);

    function getAddressTokenInfo(address user)
        external
        view
        returns (
            uint256 startTime,
            int96 flowRate,
            uint256 amountAccumunated,
            uint256 freequency
        );

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
        );
}
