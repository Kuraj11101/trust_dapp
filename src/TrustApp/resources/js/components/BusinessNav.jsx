import React from 'react';
import { Link } from "react-router-dom";

export default function BusinessNav() {
	return (
		<nav class="navbar navbar-expand-lg bg-white">
			<div class="container-fluid">
				<div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link fw-semibold" aria-current="page" href="#">
								Send Mass Payment
							</a>
						</li>
						<Link to="/" className="text-decoration-none">
							<li class="nav-item">
								<a class="nav-link fw-semibold">
									Money In
								</a>
							</li>
						</Link>
						<li class="nav-item">
							<a class="nav-link fw-semibold">
								Money Out
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-semibold" href="#">
								Invoicing
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-semibold" href="#">
								Transaction
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-semibold" href="#">
								Taxes
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	);
}
