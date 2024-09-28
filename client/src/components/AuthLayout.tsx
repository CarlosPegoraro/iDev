import Logo from "./Logo";
import { ReactNode } from 'react';

interface AuthLayoutProps {
    children: ReactNode;
  }

export default function AuthLayout({children}: AuthLayoutProps) {
    return (
        <div className="flex items-center justify-around w-full min-h-screen p-10 bg-gradient-to-bl from-slate-100 to-slate-200">
            <div>
                {children}
            </div>
            <div>
                <Logo width={200} height={300}/>
            </div>
        </div>
    )
}