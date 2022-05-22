// SPDX-License-Identifier: MIT
pragma solidity ^0.8.10;

interface KeeperCompatibleInterface {
    function checkUpkeep(bytes calldata checkData)
        external
        returns (bool upkeepNeeded, bytes memory performData);

    function performUpkeep(bytes calldata performData) external;
}

pragma solidity ^0.8.13;

import {ITrust} from "../interfaces/ITrust.sol";
import {ITrustIDA} from "../interfaces/ITrustIDA.sol";

contract DepositKeeper is KeeperCompatibleInterface {
    ITrust trustContract;
    ITrustIDA trustIDA;
    uint256 constant investmentInterval = 20 minutes;
    uint256 constant slalryInterval = 30 days;
    uint256 public lastInvestCheck;
    uint256 public lastSalaryCheck;

    mapping(address => uint256) private tokenAddresses;

    constructor(address _trustContract, address _trustIda) {
        trustIDA = ITrustIDA(_trustIda);
        trustContract = ITrust(_trustContract);
        trustContract.addAdmin(address(this));
        lastInvestCheck = block.timestamp;
        lastSalaryCheck = block.timestamp;
    }

    function checkUpkeep(
        bytes calldata /*checkData*/
    )
        external
        view
        override
        returns (bool upkeepNeeded, bytes memory performData)
    {
        if ((lastInvestCheck + investmentInterval) <= block.timestamp) {
            upkeepNeeded = true;
            performData = abi.encodePacked(uint256(0));
        }
        if ((lastSalaryCheck + slalryInterval) <= block.timestamp) {
            upkeepNeeded = true;
            performData = abi.encodePacked(uint256(1));
        }
    }

    function makeDeposit() private {
        uint256 investors = trustContract.getTotalInvestors();
        for (uint256 i = 0; i < investors; i++) {
            address user = trustContract.s_investingAddresses(i);
            (, , , , , address _asset) = trustContract.viewInvestment(user);
            trustContract.makeInvestmentDeposit(user, _asset);
        }
    }

    function performUpkeep(bytes calldata performData) external override {
        uint256 value = abi.decode(performData, (uint256));
        if (value == 0) {
            lastInvestCheck = block.timestamp;
            makeDeposit();
        }
        if (value == 1) {
            lastSalaryCheck = block.timestamp;
            uint256 amount = trustIDA.amountTodistribute();
            trustIDA.distribute(amount);
        }
    }
}
