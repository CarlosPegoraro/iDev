type ClassCardProps = {
    children: string,
    title: string,
    subtitle: string,
    image: string,
    themas: string,
    href: string,
}

export default function ClassCard({ children, title, subtitle, themas, image, href }: ClassCardProps) {
    return (
        <div className="shadow-md flex w-full">
            <img src={image} className="w-1/4" style={{ maxHeight: "15rem", maxWidth: "15rem" }} />
            <div className="flex flex-col w-3/4 py-5 px-10">
                <h1 className="text-sky-500 font-bold font-sans text-3xl mb-3">Curso: {title}</h1>
                <h1 className="text-slate-700 font-bold font-sans text-xl mb-3">Aula: {subtitle}</h1>
                <h1 className="text-slate-700 font-mono mb-3">{children}</h1>
                <div className="flex justify-between">
                    <a href={href} target="__blank" className="text-sky-500 font-bold font-sans">Clique aqui pra assistir a aula</a>
                    <h1 className="text-sky-700 font-bold font-sans text-sm">Temas Abordados: {themas}</h1>

                </div>
            </div>
        </div>
    )
}