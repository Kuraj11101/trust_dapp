// SPDX-License-Identifier: MIT

pragma solidity ^0.8.13;

interface ITrustIDA {
    function getAddressIndexId(address _employer)
        external
        pure
        returns (uint32 indexID);

    function distribute(uint256 cashAmount) external;

    function _addAddressToIndex(address recipient, uint256 amount) external;

    function removeAddress(address _employee) external;

    function amountTodistribute() external view returns (uint256);
}
