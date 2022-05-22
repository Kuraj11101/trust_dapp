// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import {ISuperfluid, ISuperToken, SuperAppDefinitions} from "@superfluid/interfaces/superfluid/ISuperfluid.sol";
import {IInstantDistributionAgreementV1} from "@superfluid/interfaces/agreements/IInstantDistributionAgreementV1.sol";

import {Ownable} from "@openzeppelin/contracts/access/Ownable.sol";

import {SuperAppBase} from "@superfluid/apps/SuperAppBase.sol";

contract TrustIDA is SuperAppBase, Ownable {
    ISuperToken private _cashToken;
    ISuperfluid private _host;
    IInstantDistributionAgreementV1 private _ida;
    address public trusContract;
    address public keeper;

    uint256 public amountTodistribute;

    mapping(address => bool) public isSubscribing;
    uint32 public constant INDEX_ID = 0;

    constructor(
        ISuperToken cashToken,
        ISuperfluid host,
        IInstantDistributionAgreementV1 ida
    ) {
        _cashToken = cashToken;
        _host = host;
        _ida = ida;

        uint256 configWord = SuperAppDefinitions.APP_LEVEL_FINAL |
            SuperAppDefinitions.BEFORE_AGREEMENT_TERMINATED_NOOP |
            SuperAppDefinitions.AFTER_AGREEMENT_TERMINATED_NOOP;

        _host.registerApp(configWord);

        _host.callAgreement(
            _ida,
            abi.encodeWithSelector(
                _ida.createIndex.selector,
                _cashToken,
                INDEX_ID,
                new bytes(0) // placeholder ctx
            ),
            new bytes(0) // user data
        );
    }

    function _checkSubscription(
        ISuperToken superToken,
        bytes calldata ctx,
        bytes32 agreementId
    ) private {
        ISuperfluid.Context memory context = _host.decodeCtx(ctx);
        // only interested in the subscription approval callbacks
        if (
            context.agreementSelector ==
            IInstantDistributionAgreementV1.approveSubscription.selector
        ) {
            address publisher;
            uint32 indexId;
            bool approved;
            uint128 units;
            uint256 pendingDistribution;
            (publisher, indexId, approved, units, pendingDistribution) = _ida
                .getSubscriptionByID(superToken, agreementId);

            // sanity checks for testing purpose
            require(publisher == address(this), "DRT: publisher mismatch");
            require(indexId == INDEX_ID, "DRT: publisher mismatch");

            if (approved) {
                isSubscribing[
                    context.msgSender /* subscriber */
                ] = true;
            }
        }
    }

    function getAddressIndexId(address _employer)
        public
        pure
        returns (uint32 indexID)
    {
        uint256 addressUint = uint256(uint160(_employer));
        indexID = uint32(addressUint);
    }

    function distribute(uint256 cashAmount) external onlyOwner {
        (uint256 actualCashAmount, ) = _ida.calculateDistribution(
            _cashToken,
            address(this),
            INDEX_ID,
            cashAmount
        );

        _host.callAgreement(
            _ida,
            abi.encodeWithSelector(
                _ida.distribute.selector,
                _cashToken,
                INDEX_ID,
                actualCashAmount,
                new bytes(0) // placeholder ctx
            ),
            new bytes(0) // user data
        );
    }

    function _addAddressToIndex(address recipient, uint256 amount) external {
        _host.callAgreement(
            _ida,
            abi.encodeWithSelector(
                _ida.updateSubscription.selector,
                _cashToken,
                INDEX_ID,
                recipient,
                uint128(amount),
                new bytes(0) // placeholder ctx
            ),
            new bytes(0) // user data
        );
        amountTodistribute += amount;
    }

    function removeAddress(address _employee) external {
        _host.callAgreement(
            _ida,
            abi.encodeWithSelector(
                _ida.updateSubscription.selector,
                _cashToken,
                INDEX_ID,
                _employee,
                uint128(0),
                new bytes(0) // placeholder ctx
            ),
            new bytes(0) // user data
        );
    }

    function addAdmin(address _keeper) external onlyOwner {
        keeper = _keeper;
    }

    function addIdaContract(address _trust) external onlyOwner {
        trusContract = _trust;
    }

    function afterAgreementCreated(
        ISuperToken superToken,
        address, /* agreementClass */
        bytes32 agreementId,
        bytes calldata, /*agreementData*/
        bytes calldata, /*cbdata*/
        bytes calldata ctx
    ) external override returns (bytes memory newCtx) {
        _checkSubscription(superToken, ctx, agreementId);
        newCtx = ctx;
    }

    function beforeAgreementUpdated(
        ISuperToken superToken,
        address agreementClass,
        bytes32, /* agreementId */
        bytes calldata, /*agreementData*/
        bytes calldata /*ctx*/
    ) external view override returns (bytes memory data) {
        require(superToken == _cashToken, "DRT: Unsupported cash token");
        require(agreementClass == address(_ida), "DRT: Unsupported agreement");
        return new bytes(0);
    }

    function afterAgreementUpdated(
        ISuperToken superToken,
        address, /* agreementClass */
        bytes32 agreementId,
        bytes calldata, /*agreementData*/
        bytes calldata, /*cbdata*/
        bytes calldata ctx
    ) external override returns (bytes memory newCtx) {
        _checkSubscription(superToken, ctx, agreementId);
        newCtx = ctx;
    }
}
