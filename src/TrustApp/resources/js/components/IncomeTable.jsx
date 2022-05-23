export default function IncomeTable() {
	return (
		<div>
			<table class="table">
				<thead>
					<tr className="table_head">
						<th scope="col">Company Name</th>
						<th scope="col">Avg. Monthly Income</th>
						<th scope="col">Streaming</th>
						<th scope="col">Unrealized Return</th>
						<th scope="col">Change</th>
						<th scope="col">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr className="table_item fw-light">
						<td className="fw-normal">FWB</td>
						<td>$1,000</td>
						<td>20%</td>
						<td>$320</td>
						<td>+320</td>
						<td><i class="bi bi-three-dots" /></td>
					</tr>
					<tr className="table_item fw-light">
						<td className="fw-normal">Amazon</td>
						<td>$50,000</td>
						<td>5%</td>
						<td>$4,550</td>
						<td>+200%</td>
						<td><i class="bi bi-three-dots" /></td>
					</tr>
					<tr className="table_item fw-light">
						<td className="fw-normal">Developer DAO</td>
						<td>$25,500</td>
						<td>20%</td>
						<td>$150</td>
						<td>+150</td>
						<td><i class="bi bi-three-dots" /></td>
					</tr>	
				</tbody>
			</table>
		</div>
	);
}
