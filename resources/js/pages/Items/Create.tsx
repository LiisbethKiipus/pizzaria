import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/react';
import { FormEvent } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Item Create',
        href: '/items()',
    },
];

export default function Create({categories}: {categories: string[]}) {

    const { data, setData, errors, post } = useForm<{
        name: string;
        description: string;
        category: string;
        price: number|undefined;
    }>({
        name: "",
        description: "",
        category: "",
        price: undefined,
    });

    function submit(e: FormEvent<HTMLFormElement>) {
        e.preventDefault();
        post(route('items.store'));
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Menu Create" />
            <div>
                <div className="p-3">
                    <Link 
                        href={route('items.index')}
                        className="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Back
                    </Link>
                    <form onSubmit={submit} className="space-y-6 mt-4 max-w-md mx-auto">
                        <div className="grid gap-2">
                            <label htmlFor="name" className="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                                Name:
                            </label>
                            <input
                                id="name"
                                value= {data.name}
                                onChange={(e)=> setData('name', e.target.value)}
                                name="name"
                                required={true}
                                className="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Big pizza"
                            />
                            {errors.name && <p className="text-red-500 text-sm mt-1">{errors.name}</p>}
                        </div>
                        <div className="grid gap-2">
                            <label htmlFor="description" className="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                                Description:
                            </label>
                            <input
                                id="description"
                                value= {data.description}
                                onChange={(e)=> setData('description', e.target.value)}
                                required={true}
                                name="description"
                                className="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="18 inch pepperoni pizza"
                            />
                            {errors.description && <p className="text-red-500 text-sm mt-1">{errors.description}</p>}
                        </div>
                        <div className="grid gap-2">
                            <label htmlFor="price" className="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                                Price:
                            </label>
                            <input
                                id="price"
                                value= {data.price}
                                type="number"
                                step="0.01"
                                min="0"
                                onChange={(e)=> setData('price', e.target.value === undefined ? e.target.value : Number(e.target.value))}
                                required={true}
                                name="price"
                                className="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="12.99"
                            />
                            {errors.price && <p className="text-red-500 text-sm mt-1">{errors.price}</p>}
                        </div><div className="grid gap-2">
                        <label
                            htmlFor="category"
                            className="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50"
                        >
                            Category:
                        </label>
                        <select
                            id="category"
                            name="category"
                            value={data.category || ''}
                            onChange={(e) => setData('category', e.target.value)}
                            required
                            className="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="" disabled>Select a category</option>
                            {categories.map((category) => (
                                <option key={category} value={category}>
                                    {category}
                                </option>
                            ))}
                        </select>
                        {errors.category && <p className="text-red-500 text-sm mt-1">{errors.category}</p>}
                    </div>
                        <button
                            type="submit"
                            className="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition"
                        >
                            Submit
                        </button>
                    
                    </form>
                </div>
            </div>
        </AppLayout>
    );
}
