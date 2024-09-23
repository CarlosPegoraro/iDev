import { useState } from "react";
import AuthLayout from "../components/AuthLayout";
import axios from "axios";
import ButtonPrimary from "../components/Button";
import Label from "../components/Label";
import { useNavigate } from "react-router-dom";
import { Link } from "react-router-dom";

interface LoginForm {
    name: string;
    email: string;
    password: string;
    confirm_password: string;
}

interface LoginData {
    token: string,
    user: {
        id: number;
        name: string;
    }
}

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8000/api/';

export default function Register() {
    const [loginForm, setLoginForm] = useState<LoginForm>({ email: '', name: '', password: '' , confirm_password: ''});
    const [error, setError] = useState<string | null>(null);
    const navigate = useNavigate();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const { name, value } = event.target;
    
        setLoginForm(prev => ({
            ...prev, [name]: value  
        }));
    };
    

    const handleSubmit = async (event: React.FormEvent) => {
        event.preventDefault();
        try {
            if (loginForm.password == loginForm.confirm_password) {
                const response = await axios.post<LoginData>('register', loginForm);
                const token = response.data.token;
                const user = response.data.user;
                localStorage.setItem('authToken', token);
                localStorage.setItem('user', JSON.stringify(user));
                navigate('/');
            }
        } catch {
            setError('Erro ao registrar')
        }
    };

    return (
        <AuthLayout>
            <form onSubmit={handleSubmit} className="flex flex-col gap-4 p-10 rounded-md shadow-md bg-zinc-100">
                {error ? <p className="text-red-500">{error}</p> : ''}
                <div className="flex flex-col">
                    <Label>Name:</Label>
                    <input
                        type="string"
                        className="px-2 py-1 text-blue-600 bg-transparent border rounded-lg border-sm border-sky-700"
                        name="name"
                        value={loginForm.name}
                        onChange={handleInputChange}
                    />
                </div>
                <div className="flex flex-col">
                    <Label>Email:</Label>
                    <input
                        type="email"
                        className="px-2 py-1 text-blue-600 bg-transparent border rounded-lg border-sm border-sky-700"
                        name="email"
                        value={loginForm.email}
                        onChange={handleInputChange}
                    />
                </div>
                <div className="flex flex-col">
                    <Label>Senha:</Label>
                    <input
                        type="password"
                        className="px-2 py-1 text-blue-600 bg-transparent border rounded-lg border-sm border-sky-700"
                        name="password"
                        value={loginForm.password}
                        onChange={handleInputChange}
                    />
                </div>
                <div className="flex flex-col">
                    <Label>Confirmar Senha:</Label>
                    <input
                        type="password"
                        className="px-2 py-1 text-blue-600 bg-transparent border rounded-lg border-sm border-sky-700"
                        name="confirm_password"
                        value={loginForm.confirm_password}
                        onChange={handleInputChange}
                    />
                </div>
                <ButtonPrimary>Registrar</ButtonPrimary>
                <Link className="underline text-sky-500 hover:text-sky-600" to={'/login'}>Já tem uma conta? Logar-se!</Link>
            </form>
        </AuthLayout>
    );
}
