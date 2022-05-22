// SPDX-License-Identifier: MIT

pragma solidity ^0.8.13;

interface IStreamMarket {
    function addPosition(
        uint256 id,
        uint256 price,
        uint256 endTime,
        address seller,
        bool _active
    ) external;
}
