import { Link } from "react-router-dom";
import Logo from "../assets/logo.png"

export default function Layout({ children, presentLocation }) {
  return (
    <div className="d-flex">
      <div className="d-flex flex-column flex-shrink-0 p-3 text-white bg-primary custom_sidebar">
        <a href="/" className="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <span className="fs-4">
            {/* <img src={Logo} width={100} /> */}
            Trust
          </span>
        </a>
        <hr />
        <ul className="nav nav-pills flex-column mb-auto">
          <Link to={`${presentLocation}/dashboard`} className="text-decoration-none">
            <li className="nav-item">
              <a href={`${presentLocation}/dashboard`} className="nav-link my-2 active" aria-current="page">
                <i class="bi bi-grid me-3" />
                Dashboard
              </a>
            </li>
          </Link>
          <Link to={`${presentLocation}/wallet`} className="text-decoration-none">
            <li>
              <a href={`${presentLocation}/wallet`} className="nav-link my-2 text-white">
                <i class="bi bi-wallet me-3" />
                Wallet
              </a>
            </li>
          </Link>
          <li>
            <a href="#" className="nav-link my-2 text-white">
              <i class="bi bi-credit-card me-3" />
              Income
            </a>
          </li>
          <li>
            <a href="#" className="nav-link my-2 text-white">
              <i class="bi bi-cash-coin me-3" />
              Payment
            </a>
          </li>
          <li>
            <a href="#" className="nav-link my-2 text-white">
              <i class="bi bi-credit-card-2-front me-3" />
              Transaction
            </a>
          </li>
          <li>
            <a href="#" className="nav-link my-2 text-white">
              <i class="bi bi-volume-up me-3" />
              Announcement
            </a>
          </li>
        </ul>
        <hr />
        <div className="dropdown">
          <a href="#" className="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" className="rounded-circle me-2" />
            <strong>Satoshi Nakomoto</strong>
          </a>
          <ul className="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a className="dropdown-item" href="#">New project...</a></li>
            <li><a className="dropdown-item" href="#">Settings</a></li>
            <li><a className="dropdown-item" href="#">Profile</a></li>
            <li><hr className="dropdown-divider" /></li>
            <li><a className="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div>
      </div>
      <div className="custom_body">
        {children}
      </div>
    </div>
  )
}
