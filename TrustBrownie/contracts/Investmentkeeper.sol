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
    ITrust private trustContract;
    ITrustIDA private trustIDA;
    address private _acceptedToken;
    uint256 constant investmentInterval = 20 minutes;
    uint256 constant slalryInterval = 30 days;
    uint256 public lastInvestCheck;
    uint256 public lastSalaryCheck;

    constructor(
        address _trustContract,
        address _trustIda,
        address _token
    ) {
        _acceptedToken = _token;
        trustIDA = ITrustIDA(_trustIda);
        trustContract = ITrust(_trustContract);
        trustContract.addAdmin(address(this));
        lastInvestCheck = block.timestamp;
        lastSalaryCheck = block.timestamp;
    }

    function checkEndedPositions()
        private
        view
        returns (
            bool status,
            uint256 id,
            address buyer
        )
    {
        uint256 len = trustIDA.getPositions();
        if (len > 0) {
            for (uint256 i = 0; i < len; i++) {
                id = trustIDA.s_positions(i);
                (, , uint256 endtime, , , address _buyer) = trustIDA
                    .getPositionDetails(id);
                if (endtime >= block.timestamp) {
                    status = true;
                    buyer = _buyer;
                }
            }
        }
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
        (bool status, , address buyer) = checkEndedPositions();
        if (status == true) {
            upkeepNeeded = true;
            performData = abi.encodePacked(address(buyer));
        }
    }

    function makeDeposit() private {
        uint256 investors = trustContract.getTotalInvestors();
        for (uint256 i = 0; i < investors; i++) {
            address user = trustContract.s_investingAddresses(i);
            //(, , , , , address _asset) = trustContract.viewInvestment(user);
            trustContract.makeInvestmentDeposit(user, _acceptedToken);
        }
    }

    function performUpkeep(bytes calldata performData) external override {
        if (abi.decode(performData, (uint256)) < 2) {
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
        } else {
            address buyer = abi.decode(performData, (address));
            trustContract.closeStream(buyer);
        }
    }
}
