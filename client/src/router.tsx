import {
    BrowserRouter as Router,
    Routes,
    Route,
    useLocation,
    Navigate
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
    const token = localStorage.getItem('token');
    
    let showNavbar = true;

    // Ensure Navbar is not shown on login, register, or resetPassword routes
    if (location.pathname === '/login' || location.pathname === '/register' || location.pathname === '/resetPassword') {
        showNavbar = false;
    }

    return (
        <>
            {showNavbar && <Navbar />}
            <Routes>
                {!token ? (
                    // Exibe apenas a rota de login quando não houver token
                    <Route path="/login" element={<Login />} />
                ) : (
                    // Exibe todas as outras rotas quando houver token
                    <>
                        <Route path="/" element={<Home />} />
                        <Route path="/about" element={<About />} />
                        <Route path="/testPage" element={<TestPage />} />
                        <Route path="/register" element={<Login />} />  {/* Supondo que o componente Login é usado para registro */}
                        <Route path="/resetPassword" element={<Login />} />  {/* Supondo que o componente Login é usado para redefinição de senha */}
                        {/* Redireciona para a Home se a rota for "/login" e o usuário estiver autenticado */}
                        <Route path="/login" element={<Navigate to="/" />} />
                    </>
                )}
            </Routes>
        </>
    );
};

export default AppRouter;
