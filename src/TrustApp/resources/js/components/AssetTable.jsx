export default function AssetTable() {
	return (
		<div>
			<table class="table">
				<thead>
					<tr className="table_head">
						<th scope="col">Wallet</th>
						<th scope="col">Holdings</th>
						<th scope="col">Unrealized Returns</th>
						<th scope="col">Change</th>
						<th scope="col">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr className="table_item fw-light">
						<td className="fw-normal">Coinbase</td>
						<td>$40,000</td>
						<td>20%</td>
						<td>+320</td>
						<td><i class="bi bi-three-dots" /></td>
					</tr>
					<tr className="table_item fw-light">
						<td className="fw-normal">Metamask</td>
						<td>$50,000</td>
						<td>$4,550</td>
						<td>+200%</td>
						<td><i class="bi bi-three-dots" /></td>
					</tr>
					<tr className="table_item fw-light">
						<td className="fw-normal">Phantom</td>
						<td>$25,500</td>
						<td>$500</td>
						<td>+150</td>
						<td><i class="bi bi-three-dots" /></td>
					</tr>	
				</tbody>
			</table>
		</div>
	);
}
