import { Link } from "react-router-dom";
import Logo from "./Logo";

export default function Navbar() {
    return (
        <nav className="flex items-center justify-around w-full p-3 bg-slate-100">
            <div className="w-1/2">
                <Logo/>
            </div>
            <ul className="flex justify-around w-1/4 list-none">
                <li className="font-mono text-lg font-bold text-sky-500 hover:text-sky-700"><Link to="/">Home</Link></li>
                <li className="font-mono text-lg font-bold text-sky-500 hover:text-sky-700"><Link to="/about">About</Link></li>
                <li className="font-mono text-lg font-bold text-red-500 hover:text-red-700"><Link to="/about"><i className="bi bi-person-dash"></i></Link></li>
            </ul>
        </nav>
    )
}