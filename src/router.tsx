import {
    BrowserRouter as Router,
    Routes,
    Route,
    useLocation
} from 'react-router-dom';

import Home from './pages/Home';
import Navbar from './components/Navbar';
import About from './pages/About';
import TestPage from './pages/TestPage';
import Login from './pages/Login';

const AppRouter = () => {
    return (
        <Router>
            <RouteContainer />
        </Router>
    );
};

const RouteContainer = () => {
    const location = useLocation();
    let showNavbar = true;

    // Ensure Navbar is not shown on login, register, or resetPassword routes
    if (location.pathname === '/login' || location.pathname === '/register' || location.pathname === '/resetPassword') {
        showNavbar = false;
    }

    return (
        <>
            {showNavbar && <Navbar />}
            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/about" element={<About />} />
                <Route path="/testPage" element={<TestPage />} />
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Login />} />  // Assuming Login component is used for registration
                <Route path="/resetPassword" element={<Login />} />  // Assuming Login component is used for resetting password
            </Routes>
        </>
    );
};

export default AppRouter;
