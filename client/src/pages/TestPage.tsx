import axios from "axios";
import ButtonPrimary from "../components/Button";
import TeacherInterface from "../interfaces/TeacherInterface";

interface ResponseData {
    teachers: {
        name: string
    } | null
}

export default function TestPage() {
    const token = localStorage.getItem('authToken');
    // const [data, setData] = useState<ResponseData>({teachers: null});

    const handleSubmit = async (event: React.FormEvent) => {
        event.preventDefault();
        try {
            const response = await axios.post<TeacherInterface>('teacher', null, {
                headers: {
                    'authToken': token
                }
            });
            console.log(response.data)
        } catch(e) {
            console.error(e);
        }
    }

    return (
        <div>
            <form onSubmit={handleSubmit} className="flex flex-col gap-4 p-10 rounded-md shadow-md bg-zinc-100">
                <ButtonPrimary>Testar rota, consultar console</ButtonPrimary>
            </form>
        </div>
    );
}
