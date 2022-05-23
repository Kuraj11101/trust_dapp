import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import './index.css';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Login from './pages/Login';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import PersonalDashboard from './pages/personal';
import BusinessDashboard from './pages/business';
import Registration from './pages/Registration';
import BusinessRegistration from './pages/BusinessRegistration';

ReactDOM.createRoot(document.getElementById('root')).render(
	<React.StrictMode>
		<BrowserRouter>
			<Routes>
        <Route path="/" element={<App />} />
        <Route path="/login" element={<Login />} />
        <Route path="/registration" element={<Registration />} />
        <Route path="/business-registration" element={<BusinessRegistration />} />
        <Route path="/personal/*" element={<PersonalDashboard />} />
        <Route path="/business/*" element={<BusinessDashboard />} />
			</Routes>
		</BrowserRouter>
	</React.StrictMode>
);
