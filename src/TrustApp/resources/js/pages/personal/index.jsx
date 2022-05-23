import { Routes, Route } from 'react-router-dom';
import Layout from '../../Layout';
import PersonalHome from './Home';
import PersonalWallet from './Wallet';

export default function PersonalDashboard() {
	return (
		<Layout presentLocation="/personal">
			<Routes>
				<Route path="/dashboard" element={<PersonalHome />} />
				<Route path="/wallet" element={<PersonalWallet />} />
			</Routes>
		</Layout>
	);
}
