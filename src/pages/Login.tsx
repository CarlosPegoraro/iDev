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
    id: number,
    name: string,
}

export default function Login() {
    const [loginForm, setLoginForm] = useState<LoginForm>({ email: '', password: '' });
    const [csrfToken, setCsrfToken] = useState<string>('');

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const { name, value } = event.target;
        setLoginForm(prev => ({ ...prev, [name]: value }));
    };

    const handleSubmit = (event: React.FormEvent) => {
        event.preventDefault();
        axios.get<string>('http://localhost:8000/sanctum/csrf-cookie')
            .then(response => {
                console.log(response.data)
                localStorage.setItem('csrf-token', response.data);
            })
            .catch(error => {
                console.error(error);
            });
        axios.post<UserData>('http://localhost:8000/testPost', loginForm)
            .then(response => {
                setCsrfToken(response.data);
                localStorage.setItem('csrf-token', csrfToken);
            })
            .catch(error => {
                console.error(error);
            });
    };

    return (
        <AuthLayout>
            <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                <div className="flex flex-col">
                    <Label>Email:</Label>
                    <input type="email" className="border rounded-md border-sm border-slate-700"
                        name="email" value={loginForm.email} onChange={handleInputChange} />

                </div>
                <div className="flex flex-col">
                    <Label>Password: </Label>
                    <input type="password" className="border rounded-md border-sm border-slate-700"
                        name="password" value={loginForm.password} onChange={handleInputChange} />

                </div>
                <ButtonPrimary>Logar</ButtonPrimary>
            </form>
        </AuthLayout>
    );
}
