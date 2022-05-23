import CoinbaseLogo from '../../assets/images/coinbase_logo.png';
import MetamaskLogo from '../../assets/images/metamask_logo.png';
import GnosisLogo from '../../assets/images/gnosisW_logo.png';
import PhantomLogo from '../../assets/images/phantom_logo.png';

export default function PersonalWallet() {
  return (
		<div className="container">
			<div className="pt-5 px-5 mt-5">
				<p className="h2">Connect Your Wallet</p>
				<p className="text-secondary mt-4">
					Select what network and wallet you want below
				</p>

				<div class="form-check my-5">
					<input
						class="form-check-input"
						type="checkbox"
						value=""
						id="flexCheckDefault"
					/>
					<p>
						Accept <strong className="text-primary">Terms of Service</strong> and{' '}
						<strong className="text-primary">Privacy Policy</strong>
					</p>
				</div>
        
				<p className="fw-semibold mt-5">Choose Wallet</p>

				<div className="row">
					<div className="col-3">
						<div className="card rounded-5 h-100">
							<div className="card-body d-flex justify-content-center flex-column align-items-center">
								<div>
									<img src={CoinbaseLogo} width={40} />
								</div>
								<p className="mb-0 pt-2">Coinbase</p>
							</div>
						</div>
					</div>
					<div className="col-3">
						<div className="card rounded-5 h-100">
							<div className="card-body d-flex justify-content-center flex-column align-items-center">
								<div>
									<img src={MetamaskLogo} width={40} />
								</div>
								<p className="mb-0 pt-2">Metamask</p>
							</div>
						</div>
					</div>
					<div className="col-3">
						<div className="card rounded-5 h-100">
							<div className="card-body d-flex justify-content-center flex-column align-items-center">
								<div>
									<img src={PhantomLogo} width={40} />
								</div>
								<p className="mb-0 pt-2">Phantom</p>
							</div>
						</div>
					</div>
					<div className="col-3">
						<div className="card rounded-5 h-100">
							<div className="card-body d-flex justify-content-center flex-column align-items-center">
								<div>
									<img src={GnosisLogo} width={40} />
								</div>
								<p className="mb-0 pt-2">Gnosis</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	);
}
