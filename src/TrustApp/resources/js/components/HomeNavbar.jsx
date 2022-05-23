import Logo from "../assets/logo.png"

export default function HomeNavbar() {
	return (
		<nav className="navbar bg-white">
			<div className="container-fluid">
				<a className="navbar-brand ms-3">
					<img src={Logo} width={100} />
				</a>
				<div className="d-flex">
          <div className="d-flex align-items-center">
            <p className="me-3">Login</p>
            <p className="me-3">Sign Up</p>
          </div>
        </div>
			</div>
		</nav>
	);
}
