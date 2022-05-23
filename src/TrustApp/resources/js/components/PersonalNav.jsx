import React from 'react';
import { Link } from "react-router-dom";

export default function PersonalNav() {
	return (
		<nav class="navbar navbar-expand-lg bg-white">
			<div class="container-fluid">
				<div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link fw-semibold" aria-current="page" href="#">
								Add Wallet
							</a>
						</li>
						<Link to="/" className="text-decoration-none">
							<li class="nav-item">
								<a class="nav-link fw-semibold">
									Add Income
								</a>
							</li>
						</Link>
						<li class="nav-item">
							<a class="nav-link fw-semibold">
								Pay or Request
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	);
}
