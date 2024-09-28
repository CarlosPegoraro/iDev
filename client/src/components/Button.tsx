import { ReactNode } from 'react';

interface ButtonPrimaryProps {
  children: ReactNode;
}

export default function ButtonPrimary({children} : ButtonPrimaryProps) {
    return (
        <button className="px-2 py-3 rounded-md bg-sky-500 hover:bg-sky-600 text-slate-100" type="submit">{children}</button>
    )
}