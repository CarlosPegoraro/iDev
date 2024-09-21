interface LabelProps {
    children: any
}

export default function Label({children} : LabelProps) {
    const classData = "font-mono text-zinc-800";
    return (
        <label className={classData}>{children}</label>
    )
}