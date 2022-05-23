import { Link } from "react-router-dom";
import LoginBg from "../assets/images/login_bg.png";

export default function BusinessRegistration() {
	return (
		<div className="container-fluid h-100">
			<div className="row bg-primary full_height">
				<div className="col bg-white rounded-end justify-content-center d-flex align-items-center">
					<div className="my-5 w-75">
						<div className="mx-5 px-5">
							<h3 className="display-5 fw-bold">Sign Up to get started</h3>
							<div className="mt-2">
								<p>Enter your details to proceed further</p>
							</div>
              <div className="mt-3">
                <div>
                  <label for="fullName" className="form-label fw-semibold">Company Name</label>
                  <div className="input-group mb-3">
                    <input
                      type="text"
                      id="companyName"
                      className="form-control rounded-0 border-top-0 border-start-0 border-end-0"
                      placeholder="eg. John Smith Industries"
                      aria-label="Enter Company Name"
                    />
                    <span className="input-group-text rounded-0 bg-white border border-top-0 border-end-0 border-start-0" id="basic-addon2">
                    <i className="bi-building"></i>
                    </span>
                  </div>
                </div>
                <div>
                  <label for="fullName" className="form-label fw-semibold">Role</label>
                  <div className="input-group mb-3">
                    <input
                      type="text"
                      id="fullName"
                      className="form-control rounded-0 border-top-0 border-start-0 border-end-0"
                      placeholder="eg. Managing Director"
                      aria-label="Enter role"
                    />
                    <span className="input-group-text rounded-0 bg-white border border-top-0 border-end-0 border-start-0" id="basic-addon2">
                    <i className="bi-file-earmark-person"></i>
                    </span>
                  </div>
                </div>
                <div>
                  <label for="loginEmail" className="form-label fw-semibold">Email address</label>
                  <div className="input-group mb-3">
                    <input
                      type="email"
                      id="loginEmail"
                      className="form-control rounded-0 border-top-0 border-start-0 border-end-0"
                      placeholder="someone@example.com"
                      aria-label="Enter email"
                    />
                    <span className="input-group-text rounded-0 bg-white border border-top-0 border-end-0 border-start-0" id="basic-addon2">
                    <i className="bi-person"></i>
                    </span>
                  </div>
                </div>
                <div>
                  <label for="loginPassword" className="form-label fw-semibold">Password</label>
                  <div className="input-group mb-3">
                    <input
                      id="loginPassword"
                      type="password"
                      className="form-control rounded-0 border-top-0 border-start-0 border-end-0"
                      placeholder="***********"
                      aria-label="Enter password"
                    />
                    <span className="input-group-text rounded-0 bg-white border border-top-0 border-end-0 border-start-0" id="basic-addon2">
                      <i className="bi-lock"></i>
                    </span>
                  </div>
                </div>
                <div class="form-check my-4">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault">
                    I Agree to the terms and conditions
                  </label>
                </div>
                <div className="d-flex justify-content-between">
                  <Link to="/business/dashboard">
                    <button type="button" className="btn btn-primary btn-lg px-4">Sign Up</button>
                  </Link>
                  <Link to="/login">
                    <button type="button" className="btn btn-link">Sign In</button>
                  </Link>
                </div>
                <div className="text-center mt-3">
                  <Link to="/">
                    <button type="button" class="btn btn-link">Back to Homepage</button>
                  </Link>
                </div>
              </div>
						</div>
					</div>
				</div>
				<div className="col">
          <div className="h-100 d-flex justify-content-center align-items-center">
            <img src={LoginBg} height="500" />
          </div>
        </div>
			</div>
		</div>
	);
}
