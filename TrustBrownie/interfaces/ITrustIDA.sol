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

    function s_positions(uint256 index) external view returns (uint256 id);

    function getPositions() external view returns (uint256 index);

    function getPositionDetails(uint256 id)
        external
        view
        returns (
            uint256 price,
            int96 flowRate,
            uint256 endTime,
            address seller,
            bool isActive,
            address buyer
        );
}
