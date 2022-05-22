// SPDX-License-Identifier: MIT

pragma solidity ^0.8.7;

import "@openzeppelin/contracts/token/ERC1155/ERC1155.sol";
import "@openzeppelin/contracts/token/ERC1155/IERC1155Receiver.sol";

import "@openzeppelin/contracts/token/ERC20/IERC20.sol";

import {ITrust} from "../interfaces/ITrust.sol";
import {ISuperToken} from "@superfluid/interfaces/superfluid/ISuperToken.sol";
import "@openzeppelin/contracts/security/ReentrancyGuard.sol";

contract StreamMarket is ReentrancyGuard {
    ITrust private trustContract;
    ISuperToken public DAI;
    IERC20 public dai;

    struct Derivative {
        uint256 price;
        int96 flowRate;
        uint256 endtime;
        address seller;
        bool active;
        address buyer;
    }

    uint256[] public s_positions;

    mapping(uint256 => Derivative) public s_derivativeIdInfo;

    event positionAdded(
        address indexed from,
        uint256 indexed id,
        uint256 price
    );

    modifier onlyTrust() {
        require(msg.sender == address(trustContract), "not allowed");
        _;
    }

    constructor(
        address _trustAddress,
        ISuperToken _dai,
        IERC20 fdai
    ) {
        trustContract = ITrust(_trustAddress);
        DAI = _dai;
        dai = fdai;
    }

    function getPositionDetails(uint256 id)
        public
        view
        returns (
            uint256 price,
            int96 flowRate,
            uint256 endTime,
            address seller,
            bool status,
            address buyer
        )
    {
        Derivative storage der = s_derivativeIdInfo[id];
        price = der.price;
        flowRate = der.flowRate;
        endTime = der.endtime;
        seller = der.seller;
        status = der.active;
        buyer = der.buyer;
    }

    function addPosition(
        uint256 id,
        uint256 price,
        uint256 endtime,
        address seller,
        bool _active
    ) external nonReentrant onlyTrust {
        s_derivativeIdInfo[id] = Derivative(
            price,
            0,
            endtime,
            seller,
            _active,
            address(0)
        );
        emit positionAdded(seller, id, price);
    }

    function toIint(uint256 number) private pure returns (int96) {
        int256 number1 = int256(number);
        return (int96(number1));
    }

    function buyStream(uint256 id) public nonReentrant {
        Derivative storage pos = s_derivativeIdInfo[id];
        require(pos.active == false);
        require(pos.endtime > block.timestamp);
        uint256 price = pos.price;
        require(
            dai.allowance(msg.sender, address(this)) >= price,
            "allowance not enough"
        );
        address seller = s_derivativeIdInfo[id].seller;
        dai.transferFrom(msg.sender, seller, price);
        //calculate flowrate based on time and amount
        uint256 number = (pos.price / (pos.endtime - block.timestamp));
        int96 flowrate = toIint(number);
        s_derivativeIdInfo[id].flowRate = flowrate;
        s_derivativeIdInfo[id].buyer = msg.sender;
        s_derivativeIdInfo[id].active = true;
        trustContract.openStream(msg.sender, flowrate);
        s_positions.push(id);
    }

    function stopPosition(uint256 id) external {
        Derivative storage toRemove = s_derivativeIdInfo[id];
        if (toRemove.endtime <= block.timestamp) {
            address buyer = toRemove.buyer;
            trustContract.closeStream(buyer);
            s_derivativeIdInfo[id].active = false;
        }
    }

    function getPositions() external view returns (uint256 index) {
        index = s_positions.length;
    }
}
