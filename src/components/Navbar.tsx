import { Link } from "react-router-dom";
import Logo from "./Logo";

export default function Navbar() {
    return (
        <nav className="bg-slate-100 w-full flex justify-around items-center p-3">
            <div className="w-1/2">
                <Logo/>
            </div>
            <ul className="list-none flex justify-around w-1/4">
                <li className="text-sky-500 hover:text-sky-700 font-mono font-bold text-lg"><Link to="/">Home</Link></li>
                <li className="text-sky-500 hover:text-sky-700 font-mono font-bold text-lg"><Link to="/about">About</Link></li>
            </ul>
        </nav>
    )
}