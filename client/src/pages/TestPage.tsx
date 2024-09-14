import { useEffect, useState } from "react";
import axios from "axios";

// Interface para os dados recebidos
interface LaravelData {
    Laravel: string;
}
interface PostData {
    resposta: string;
}

export default function TestPage() {
    const [data, setData] = useState<LaravelData | null>(null);
    const [postData, setPostData] = useState<PostData>({ resposta: '' });
    const [apiResponse, setApiResponse] = useState<string>(''); // Estado para guardar a resposta da API
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        axios.get<LaravelData>('http://localhost:8000/api/')
            .then(response => {
                setData(response.data);
                setIsLoading(false);
            })
            .catch(error => {
                console.error(error);
                setError("Failed to load data");
                setIsLoading(false);
            });
    }, []); // Removi [data] para evitar loop infinito, não use estado como dependência se não houver re-fetch necessário

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const { name, value } = event.target;
        setPostData(prev => ({ ...prev, [name]: value }));
    };

    const handleSubmit = (event: React.FormEvent) => {
        event.preventDefault();
        axios.post('http://localhost:8000/testPost', postData)
            .then(response => {
                setApiResponse(response.data.resposta); // Atualizando somente a resposta da API
            })
            .catch(error => {
                console.error(error);
            });
    };

    if (isLoading) return <p>Loading...</p>;
    if (error) return <p>Error: {error}</p>;
    if (!data) return <p>No data available.</p>;

    return (
        <div>
            Laravel version {data.Laravel}
            <form onSubmit={handleSubmit}>
                <label>
                    Resposta:
                    <input
                        type="text"
                        className="border-black border-1"
                        name="resposta"
                        value={postData.resposta}
                        onChange={handleInputChange}
                    />
                </label>
                <button type="submit">Submit</button>
                <br/>
                Test resposta: {apiResponse}  
            </form>
        </div>
    );
}
