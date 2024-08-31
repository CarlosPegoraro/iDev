import {
    BrowserRouter as Router,
    Routes,
    Route
} from 'react-router-dom';

import Home from './pages/Home';
import Navbar from './components/Navbar';
import About from './pages/About';

const AppRouter = () => {
    return (
        <Router>
            <Navbar/>
            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/about" element={<About />} />
            </Routes>
        </Router>
    );
};

export default AppRouter;
