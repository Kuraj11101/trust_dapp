from brownie import (
    NativeCompany,
    StreamMarket,
    TrustCFA,
    TrustToken,
    TrustSwap,
    network,
    convert,
    accounts,
    config,
    web3,
    TrustIDA,
    DepositKeeper
)


NON_FORKED_LOCAL_BLOCKCHAIN_ENVIRONMENTS = [
    "hardhat", "development", "ganache"]
LOCAL_BLOCKCHAIN_ENVIRONMENTS = NON_FORKED_LOCAL_BLOCKCHAIN_ENVIRONMENTS + [
    "mainnet-fork",
    "binance-fork",
    "matic-fork",
]
# Etherscan usually takes a few blocks to register the contract has been deployed
BLOCK_CONFIRMATIONS_FOR_VERIFICATION = 6


DECIMALS = 18
INITIAL_VALUE = web3.toWei(2000, "ether")

host_mumbai = convert.to_address("0xEB796bdb90fFA0f28255275e16936D25d3418603")
cfa_mumbai = convert.to_address("0x49e565Ed1bdc17F3d220f72DF0857C26FA83F873")
ida_mumbai = convert.to_address("0x804348D4960a61f2d5F9ce9103027A3E849E09b8")
daix_mumbai = convert.to_address("0x983E2b60604603792ea99b95f5e69A0445a83278")
fdai_mumbai = convert.to_address("0x9A753f0F7886C9fbF63cF59D0D4423C5eFaCE95B")


def get_account(index=None, id=None):
    if index:
        return accounts[index]
    if network.show_active() in LOCAL_BLOCKCHAIN_ENVIRONMENTS:
        return accounts[0]
    if id:
        return accounts.load(id)
    return accounts.add(config["wallets"]["from_key"])


account = get_account()


def main():
    trust_contract = (
        TrustCFA.deploy(
            host_mumbai,
            cfa_mumbai,
            {'from': account}
        )
        if len(TrustCFA) <= 0
        else TrustCFA[-1]
    )
    ida = (
        TrustIDA.deploy(
            daix_mumbai,
            host_mumbai,
            ida_mumbai,
            {"from": account}
        )
        if len(TrustIDA) <= 0
        else TrustIDA[-1]
    )
    native = (
        NativeCompany.deploy(
            host_mumbai,
            cfa_mumbai,
            daix_mumbai,
            trust_contract.address,
            {"from": account}
        )
        if len(NativeCompany) <= 0
        else NativeCompany[-1]
    )
    market = (
        StreamMarket.deploy(
            trust_contract.address,
            daix_mumbai,
            fdai_mumbai,
            {"from": account}
        )
        if len(StreamMarket) <= 0
        else StreamMarket[-1]
    )
    trust_keeper = (
        DepositKeeper.deploy(
            trust_contract.address,
            ida.address,
            daix_mumbai,
            {"from": account}
        )
        if len(DepositKeeper) <= 0
        else DepositKeeper[-1]
    )


if __name__ == "__main__":
    main()
