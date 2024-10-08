import {
    BrowserRouter as Router,
    Routes,
    Route,
    useLocation,
    Navigate,
    useNavigate
} from 'react-router-dom';

import Home from './pages/Home';
import Navbar from './components/Navbar';
import About from './pages/About';
import TestPage from './pages/TestPage';
import Login from './pages/Login';
import Register from './pages/Register';
import { useEffect } from 'react';

const AppRouter = () => {
    return (
        <Router>
            <RouteContainer />
        </Router>
    );
};

const RouteContainer = () => {
    const location = useLocation();
    const token = localStorage.getItem('authToken');
    const navigate = useNavigate();

    let showNavbar = true;

    // Ensure Navbar is not shown on login, register, or resetPassword routes
    if (location.pathname === '/login' || location.pathname === '/register' || location.pathname === '/resetPassword') {
        showNavbar = false;
    }

    useEffect(() => {
        if (!token && showNavbar) {
            navigate('/login');
        }
    }, [token, navigate, showNavbar])

    return (
        <>
            {showNavbar && <Navbar />}
            <Routes>
                {!token ? (
                    <>
                        <Route path="/login" element={<Login />} />
                        <Route path="/register" element={<Register />} />
                        {/* <Route path="*" element={<Navigate to="/login" />} /> */}
                        <Route path="/resetPassword" element={<Login />} />
                    </>
                ) : (
                    <>
                        <Route path="/" element={<Home />} />
                        <Route path="/about" element={<About />} />
                        <Route path="/testPage" element={<TestPage />} />
                        <Route path="/login" element={<Navigate to="/" />} />
                    </>
                )}
            </Routes>
        </>
    );
};

export default AppRouter;
