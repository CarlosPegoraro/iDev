import { Link } from "react-router-dom";
import Logo from "./Logo";
import axios from "axios";
import { useNavigate } from "react-router-dom";

interface LogoutData {
    message: string;
}

export default function Navbar() {
    const token = localStorage.getItem('authToken');
    const navigate = useNavigate();

    const handleLogout = async () => {
        try {
            const response = await axios.post<LogoutData>('logout', null, {
                headers: {
                    'authToken': token
                }
            });
            const message = response.data.message;
            if (message === 'Logout sucessful') {
                localStorage.removeItem('authToken');
                navigate('/login');
            }
        } catch (error) {
            console.error(error);
        }
    };

    return (
        <nav className="flex items-center justify-around w-full p-3 bg-slate-100">
            <div className="w-1/2">
                <Logo />
            </div>
            <ul className="flex items-center justify-around w-1/4 list-none">
                <li className="font-mono text-lg font-bold text-sky-500 hover:text-sky-700"><Link to="/">Home</Link></li>
                <li className="font-mono text-lg font-bold text-sky-500 hover:text-sky-700"><Link to="/about">Sobre</Link></li>
                <li className="font-mono text-2xl font-bold text-red-500 hover:text-red-700">
                    <button onClick={handleLogout}>
                        <i className="bi bi-person-dash"></i>
                    </button>
                </li>
            </ul>
        </nav>
    );
}
