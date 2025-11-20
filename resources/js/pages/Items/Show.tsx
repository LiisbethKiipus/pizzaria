import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Menu Show',
        href: '/items()',
    },
];

export default function Show({item} : { item: { name: string, description: string, price: number, category: string} }) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="User Show" />
            <div>
                <div className="p-3">
                    <Link 
                        href={route('items.index')}
                        className="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Back
                    </Link>
                    <br/>
                    <br/>
                    <div>
                        <p><strong>Name: </strong>{item.name}</p>
                        <p><strong>Description: </strong>{item.description}</p>
                        <p><strong>Price: </strong>{item.price}</p>
                        <p><strong>Category: </strong>{item.category}</p>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
