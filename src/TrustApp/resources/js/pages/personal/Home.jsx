import PersonalNav from '../../PersonalNav';
import AssetTable from '../../AssetTable';
import IncomeTable from '../../IncomeTable';

export default function PersonalHome() {
	return (
    <>
      <PersonalNav />
      <section className="m-4">
        <div class="row">
          <div class="col-8">
            <div className="row">
              <div className="col">
                <div class="card border-0 card_shadow bg-primary">
                  <div class="card-body p-4 text-white">
                    <div className="mb-3">Total Income Value <span className="ms-3 text-info"><i class="bi bi-caret-down-fill"></i></span></div>
                    <div><i class="bi bi-arrow-up-right"></i> +3.49%</div>
                    <p className="h3 fw-normal mt-2 mb-2">$15,000</p>
                  </div>
                </div>
              </div>
              <div className="col">
                <div class="card border-0 card_shadow">
                  <div class="card-body p-4 text-dark">
                    <div className="mb-3">Your Returns  <span className="ms-3 text-info"><i class="bi bi-caret-down-fill"></i></span></div>
                    <p className="mb-0 text-primary"><i class="bi bi-arrow-up-right"></i> +2.75%</p>
                    <p className="h3 fw-normal mt-2 mb-2">$2,500</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card border-0 card_shadow mt-4">
              <div class="card-body">
                <div className="row">
                  <div className="d-flex">
                    <p>Your Income Source</p>
                    <div className="ms-auto d-flex align-items-center">
                      <p className="text-primary fw-semibold text-nowrap mb-0">Download Reports <i class="bi bi-download"></i></p>
                      <select class="form-select ms-4 border-0" aria-label="timeline">
                        <option selected>Week</option>
                        <option value="month">Month</option>
                        <option value="year">Year</option>
                      </select>
                    </div>
                  </div>
                  <div>
                    <IncomeTable />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card border-0 card_shadow h-100">
              <div class="card-body p-4 text-dark">
                <div>Create or Edit Income Yield</div>
                <div className="d-flex flex-column gap-3">
                  <input type="text" className="form-control border border-2 border-primary" id="selectWallet" placeholder="Select wallet or income stream source" />
                  <input type="text" className="form-control border border-2 border-primary" id="selectProtocol" placeholder="Select yield protocol: Aave, APWINE" />
                  <div className="d-flex gap-4 justify-content-between">
                    <input type="text" className="form-control border border-2 border-primary" id="selectProtocol" placeholder="%Allocation" />
                    <select className="form-select border border-2 border-primary" aria-label="Default select example">
                      <option selected>Frequency  Daily</option>
                      <option value="1">Weekly</option>
                      <option value="2">Monthly</option>
                      <option value="3">Annually</option>
                    </select>
                  </div>
                  <input type="text" className="form-control border border-2 border-primary" id="selectProtocol" placeholder="Currency: USDC, DAI, USDT" />
                </div>
                <div className="d-flex flex-column mx-auto w-75 gap-2 mt-4">
                  <button type="button" className="btn btn-primary px-3 text-white">
                    Start
                  </button>
                  <button type="button" className="btn btn-primary px-3 text-white">
                    Update
                  </button>
                  <button type="button" className="btn btn-primary px-3 text-white">
                    Pause
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        {/* CREATE AN INVOICE  */}
        <div class="row mt-4">
          <div className="col-8">
            <div class="card border-0 card_shadow">
              <div class="card-body">
                <div className="row">
                  <p>Your Asset</p>
                  <div className="col-2"></div>
                  <div>
                    <AssetTable />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="col-4">
            <div className="card border-0 h-100">
              <div className="card-body card_shadow">
                <p>Loan Market</p>
                <div className="d-flex justify-content-between align-items-center mb-3">
                  <p className="mb-0">Open Loan Position</p>
                  <button type="button" className="btn btn-primary px-3 text-white">
                    Buy Stream
                  </button>
                </div>
                <p className="text-primary">15</p>
                <hr />
                <div className="d-flex justify-content-between">
                  <button type="button" className="btn btn-primary px-3 text-white">
                    Sell Stream
                  </button>
                  <button type="button" className="btn btn-primary px-3 text-white">
                    Stop Stream
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
	);
}
