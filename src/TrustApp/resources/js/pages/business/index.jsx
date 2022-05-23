import { Routes, Route } from 'react-router-dom';
import Layout from '../../Layout';
import BusinessHome from './Home';
import BusinessWallet from './Wallet';


export default function BusinessDashboard() {
  return (
    <Layout presentLocation="/business">
      <Routes>
        <Route path="/dashboard" element={<BusinessHome />} />
        <Route path="/wallet" element={<BusinessWallet />} />
      </Routes>
    </Layout>
  )
}
