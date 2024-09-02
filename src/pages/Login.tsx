import { useState } from "react";
import axios from "axios";
import AuthLayout from "../components/AuthLayout";
import ButtonPrimary from "../components/Button";
import Label from "../components/Label";

interface LoginForm {
    email: string;
    password: string;
}

interface UserData {
    data: {
        id: number;
        name: string;
    }
}

export default function Login() {
    const [loginForm, setLoginForm] = useState<LoginForm>({ email: '', password: '' });

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const { name, value } = event.target;
        setLoginForm(prev => ({ ...prev, [name]: value }));
    };

    const handleSubmit = async (event: React.FormEvent) => {
        event.preventDefault();

        axios.get('http://localhost:8000/sanctum/csrf-cookie')
            .then(() => {
                // Agora faça a chamada de login
                axios.post<UserData>('http://localhost:8000/login', loginForm).then(response => {
                    console.log('Logged in!', response);
                    // localStorage.setItem('user-data', JSON.stringify(response.data));
                }).catch(error => {
                    console.error('Login error:', error);
                });
            })
            .catch(error => {
                console.error('CSRF token setup error:', error);
            });

    };

    return (
        <AuthLayout>
            <form onSubmit={handleSubmit} className="flex flex-col gap-4 p-10 rounded-md bg-zinc-600">
                <div className="flex flex-col">
                    <Label>Email:</Label>
                    <input type="email" className="border rounded-md border-sm border-slate-700"
                        name="email" value={loginForm.email} onChange={handleInputChange} />
                </div>
                <div className="flex flex-col">
                    <Label>Password:</Label>
                    <input type="password" className="border rounded-md border-sm border-slate-700"
                        name="password" value={loginForm.password} onChange={handleInputChange} />
                </div>
                <ButtonPrimary>Logar</ButtonPrimary>
            </form>
        </AuthLayout>
    );
}
