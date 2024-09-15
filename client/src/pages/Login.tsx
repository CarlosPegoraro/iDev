import { useState } from "react";
import AuthLayout from "../components/AuthLayout";
import axios from "axios";
import ButtonPrimary from "../components/Button";
import Label from "../components/Label";

interface LoginForm {
    email: string;
    password: string;
}

interface UserData {
    id: number;
    name: string;
}

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8001';

export default function Login() {
    const [loginForm, setLoginForm] = useState<LoginForm>({ email: '', password: '' });
    const [, setUserData] = useState<UserData | null>(null);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const { name, value } = event.target;
        setLoginForm(prev => ({ ...prev, [name]: value }));
    };

    const handleSubmit = async (event: React.FormEvent) => {
        event.preventDefault();
        const response = await axios.post<UserData>('/login', loginForm, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        });
        console.log('Login bem-sucedido:', response.data);
        setUserData(response.data);
    };

    return (
        <AuthLayout>
            <form onSubmit={handleSubmit} className="flex flex-col gap-4 p-10 rounded-md bg-zinc-600">
                <div className="flex flex-col">
                    <Label>Email:</Label>
                    <input
                        type="email"
                        className="border rounded-md border-sm border-slate-700"
                        name="email"
                        value={loginForm.email}
                        onChange={handleInputChange}
                    />
                </div>
                <div className="flex flex-col">
                    <Label>Password:</Label>
                    <input
                        type="password"
                        className="border rounded-md border-sm border-slate-700"
                        name="password"
                        value={loginForm.password}
                        onChange={handleInputChange}
                    />
                </div>
                <ButtonPrimary>Logar</ButtonPrimary>
            </form>
        </AuthLayout>
    );
}
