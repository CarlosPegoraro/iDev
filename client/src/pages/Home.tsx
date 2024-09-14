import ClassCard from "../components/ClassCard";
import languageC from '../assets/languageC.png'

export default function Home() {
  return (
    <main className="p-20 flex flex-col">
      <h1 className="text-3xl text-sky-600 uppercase font-mono font-bold mb-10">hello world! Prontos para o futuro?</h1>
      <h1 className="text-xl text-slate-800 font-mono ps-5 mb-10">
        Bem vindos ao <span className="text-sky-500 font-bold text-2xl">iDev</span>, uma plataforma pensada para proporcionar a todos os niveis de desenvolvedores uma nova expericencia em relação a conteudos onlines. Trazendo diversos projetos pensados em colocar o desenvolvedor cara a cara com os mais diversos problemas que sao encontrados no dia a dia.
      </h1>
      <hr className="border-sky-200 border-2"/>
      <ClassCard title="Algoritmo para bebes" subtitle="Que lindo! ele deu os primeiros passos!!" 
        themas="estrutura inicial/variaveis/tipagem basica"
        href="https://buscalog.com.br/login" image={languageC}>
        Parece que ta nascendo um pequeno dev, e como todo mundo, o primeiro passo é dar o primeiro passo. Nessa aula o desenvolvedor Carlos Lopes vai ensinar um pouco sobre o inicio dessa jornada.
      </ClassCard>
    </main>
  )
}