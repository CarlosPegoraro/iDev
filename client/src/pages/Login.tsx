import { useState } from "react";
import AuthLayout from "../components/AuthLayout";
import axios from "axios";
import ButtonPrimary from "../components/Button";
import Label from "../components/Label";
import { useNavigate } from "react-router-dom";
import { Link } from "react-router-dom";

interface LoginForm {
    email: string;
    password: string;
    remember: boolean;
}

interface LoginData {
    token: string,
    user: {
        id: number;
        name: string;
    }
}

export default function Login() {
    const [loginForm, setLoginForm] = useState<LoginForm>({ email: '', password: '' , remember: false});
    const [error, setError] = useState<string | null>(null);
    const navigate = useNavigate();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const { name, type, value, checked } = event.target;
    
        setLoginForm(prev => ({
            ...prev,
            [name]: type === 'checkbox' ? checked : value  
        }));
    };

    const handleSubmit = async (event: React.FormEvent) => {
        event.preventDefault();
        try {
            const response = await axios.post<LoginData>('login', loginForm);
            const token = response.data.token;
            const user = response.data.user;
            console.log(token)
            localStorage.setItem('authToken', token);
            localStorage.setItem('user', JSON.stringify(user));
            console.log('Token salvo:', localStorage.getItem('authToken')); 
            navigate('/');
        } catch {
            // console.log(error)
            setError('Dados incorretos')
        }
    };

    return (
        <AuthLayout>
            <form onSubmit={handleSubmit} className="flex flex-col gap-4 p-10 rounded-md shadow-md bg-zinc-100">
                {error ? <p className="text-red-500">{error}</p> : ''}
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
                <div className="flex items-center gap-4">
                    <input
                        type="checkbox"
                        className="w-4 h-4 border-2 border-blue-500 rounded-full bg-blue checked:bg-blue-500 checked:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        name="remember"
                        checked={loginForm.remember}
                        onChange={handleInputChange}
                        />
                    <Label>Lembrar Sessão?</Label>
                </div>
                <ButtonPrimary>Logar</ButtonPrimary>
                <Link className="underline text-sky-500 hover:text-sky-600" to={'/register'}>Não tem uma conta? Cadastrar-se!</Link>
            </form>
        </AuthLayout>
    );
}
