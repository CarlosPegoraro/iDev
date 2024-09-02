export default function Label({children}, color : string = "zinc-200") {
    const classData = "font-mono text-" + color;
    return (
        <label className={classData}>{children}</label>
    )
}