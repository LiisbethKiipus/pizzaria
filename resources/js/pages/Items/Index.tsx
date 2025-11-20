import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { can } from '@/lib/can';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Menu',
        href: '/items()',
    },
];

export default function Index({ items }: { items: Array<{ id: number; name: string; description: string, price: number, category: string }>,  }) {

    function handleDelete(id: number){
        if (confirm("Are you sure you want to remove this?")) {
            router.delete(route('items.destroy', id));
        }
    }
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="items" />
            <div>
                <div className="p-3">
                    {can('items.create') && <Link
                        href={route('items.create')}
                        className="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Create
                    </Link>}
                    <div className="overflow-x-auto mt-3">
                        <table className="w-full text-sm text-left text-gray-700">
                            <thead className="text-xs uppercase bg-gray-50 text-gray-700">
                            <tr>
                                <th scope="col" className="px-6 py-3">ID</th>
                                <th scope="col" className="px-6 py-3">Name</th>
                                <th scope="col" className="px-6 py-3">Description</th>
                                <th scope="col" className="px-6 py-3">Price</th>
                                <th scope="col" className="px-6 py-3">Category</th>
                                <th scope="col" className="px-6 py-3 w-70">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            {items.map(({ id, name, category, price, description }) =>
                            <tr key={id} className="odd:bg-white even:bg-gray-50 border-b border-gray-200">
                                <td className="px-6 py-2 font-medium text-gray-900">{id}</td>
                                <td className="px-6 py-2 text-gray-700">{name}</td>
                                <td className="px-6 py-2 text-gray-700">{description}</td>
                                <td className="px-6 py-2 text-gray-700">{price}</td>
                                <td className="px-6 py-2 text-gray-700">{category}</td>
                                <td className="px-6 py-2 space-x-1">
                                    <Link 
                                        href={route('items.show', id)}
                                        className="mr-1 cursor-pointer px-3 py-2 text-xs font-medium text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                        Show
                                    </Link>
                                    {can('items.edit') && <Link 
                                        href={route('items.edit', id)}
                                        className="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                        Edit
                                    </Link>}
                                    {can('items.delete') && <button
                                        onClick={() => handleDelete(id)}
                                        className="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                        Delete
                                    </button>}
                                </td>
                            </tr>
                            )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
