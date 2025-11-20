import React from "react";
import {
    Pizza,
    Heart,
    Award,
    Clock,
    MapPin,
    Phone,
    Mail,
} from "lucide-react";
import { usePage } from '@inertiajs/react';
import { type SharedData } from '@/types';

type Item = {
    id: number;
    name: string;
    description: string;
    price: number;
    category: string;
};

export default function Index({ items }: { items: Item[] }) {
    const { auth } = usePage<SharedData>().props;
    const grouped = items.reduce<Record<string, Item[]>>((acc, item) => {
        if (!acc[item.category]) acc[item.category] = [];
        acc[item.category].push(item);
        return acc;
    }, {});

    return (
        <div className="min-h-screen bg-white">
            {/* NAVBAR */}
            <nav className="fixed top-0 left-0 right-0 bg-red-900 text-white shadow-lg z-50">
                <div className="container mx-auto px-4 py-4 flex items-center justify-between">
                    <div className="flex items-center gap-2">
                        <Pizza className="size-8" />
                        <span className="text-xl">Whiskers Pizzeria</span>
                    </div>

                    <ul className="flex gap-6">
                        {auth.user ? (
                            <li>
                                <a href="/items" className="hover:text-amber-300">
                                    Staff panel
                                </a>
                            </li>
                        ): ''}
                        <li>
                            <button className="hover:text-amber-300" onClick={() => scrollToSection("menu")}>
                            Menu
                            </button>
                        </li>
                        <li>
                            <button className="hover:text-amber-300" onClick={() => scrollToSection("about")}>
                            About
                            </button>
                        </li>
                        <li>
                            <button className="hover:text-amber-300" onClick={() => scrollToSection("contact")}>
                            Contact
                            </button>
                        </li>
                    </ul>
                </div>
            </nav>

            {/* HERO */}
            <section
                id="home"
                className="pt-20 min-h-screen flex items-center bg-linear-to-b from-red-50 to-white relative overflow-hidden"
            >
                {/* Floating emoji */}
                <div className="absolute inset-0 opacity-5">
                        <div className="absolute top-20 left-10 text-8xl">🍕</div>
                        <div className="absolute top-40 right-20 text-6xl">🍕</div>
                        <div className="absolute bottom-40 left-1/4 text-7xl">🍕</div>
                        <div className="absolute bottom-20 right-1/3 text-9xl">🍕</div>
                </div>

                <div className="container mx-auto px-4 py-16 relative z-10">
                    <div className="grid md:grid-cols-2 gap-12 items-center">

                        <div>
                            <h1 className="text-6xl mb-6 text-red-900">Whiskers Pizzeria</h1>
                            <p className="text-2xl mb-4 text-gray-800">Authentic Italian Pizza</p>
                            <p className="text-xl mb-8 text-gray-600">
                                Hand-tossed dough, fresh ingredients, and recipes passed down through generations
                            </p>
                            <button className="h-10 rounded-md px-6 bg-red-600 hover:bg-red-700 text-white" onClick={() => scrollToSection("menu")}>
                                View Menu
                            </button>
                        </div>

                        {/* Right image */}
                        <div className="flex justify-center items-center">
                            <div className="relative w-full max-w-md">
                                <div className="absolute -inset-4 bg-linear-to-r from-red-400 to-orange-400 rounded-full blur-2xl opacity-20 animate-pulse"></div>
                                <img
                                    src="/landing_page/quality_expert.png"
                                    alt="Chef Whiskers"
                                    className="relative rounded-3xl shadow-2xl w-full h-auto"
                                />
                                <div className="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-white px-6 py-3 rounded-full shadow-lg">
                                    <p className="text-gray-800">Quality Expert</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {/* MENU (DYNAMIC FROM PROPS) */}
            <section id="menu" className="py-20 bg-white">
                <div className="container mx-auto px-4">
                    <h2 className="text-5xl text-center mb-4 text-red-900">Our Menu</h2>
                    <div className="max-w-5xl mx-auto space-y-16">
                        {Object.entries(grouped).map(([category, list]) => (
                            <div key={category}>
                                <h3 className="text-4xl mb-8 text-red-800 border-b-2 border-red-300 pb-3">
                                    {category}
                                </h3>

                                <div className="grid gap-6">
                                    {list.map((item) => (
                                        <div
                                            key={item.id}
                                            className="bg-red-50 p-6 rounded-lg shadow-md hover:shadow-lg border border-red-100 transition-shadow"
                                        >
                                            <div className="flex justify-between items-start mb-2">
                                                <h4 className="text-2xl text-red-900">{item.name}</h4>
                                                <span className="text-2xl text-red-700">
                                                    ${item.price.toFixed(2)}
                                                </span>
                                            </div>
                                            <p className="text-gray-600">{item.description}</p>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        ))}
                    </div>

                </div>
            </section>

            {/* ABOUT */}
            <section id="about" className="py-20 bg-red-50">
                <div className="container mx-auto px-4">
                    <h2 className="text-5xl text-center mb-12 text-red-900">About Whiskers Pizzeria</h2>

                    <div className="max-w-3xl mx-auto mb-16 text-center text-xl text-gray-700 space-y-6">
                        <p>
                            Founded in 2010, our pizzeria has been serving the community with
                            the finest artisanal pizzas for over a decade.
                        </p>
                        <p>
                            We use only the freshest ingredients, sourced locally whenever possible.
                            Every pizza is crafted with love and baked to perfection.
                        </p>
                    </div>

                    {/* About Cards */}
                    <div className="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                        <FeatureCard icon={<Heart className="size-12 mx-auto mb-4 text-red-600" />} title="Made with Love" text="Every dish is prepared with passion" />
                        <FeatureCard icon={<Award className="size-12 mx-auto mb-4 text-red-600" />} title="Award Winning" text="Best Pizza in Town — 3 years running" />
                        <FeatureCard icon={<Clock className="size-12 mx-auto mb-4 text-red-600" />} title="Always Fresh" text="Dough made daily and ingredients delivered each morning" />
                    </div>
                </div>
            </section>

            {/* CONTACT */}
            <section id="contact" className="py-20 bg-red-50">
                <div className="container mx-auto px-4">
                    <h2 className="text-5xl text-center mb-12 text-red-900">Contact Us</h2>

                    <div className="grid md:grid-cols-2 gap-12 max-w-4xl mx-auto">

                        <div className="space-y-8">
                            <ContactItem icon={<MapPin className="size-6 text-red-600" />} title="Location">
                                123 Catnip Lane<br />Meowville, CA 90210
                            </ContactItem>

                            <ContactItem icon={<Phone className="size-6 text-red-600" />} title="Phone">
                                (555) CAT-PIZZA<br />(555) 228-7499
                            </ContactItem>

                            <ContactItem icon={<Mail className="size-6 text-red-600" />} title="Email">
                                meow@whiskerspizzeria.com
                            </ContactItem>
                        </div>

                        <ContactItem icon={<Clock className="size-6 text-red-600" />} title="Hours">
                            <div className="space-y-2">
                                <Row label="Mon - Thu" value="11:00 AM - 10:00 PM" />
                                <Row label="Fri - Sat" value="11:00 AM - 11:00 PM" />
                                <Row label="Sunday" value="12:00 PM - 9:00 PM" />
                            </div>
                        </ContactItem>

                    </div>
                </div>
            </section>

            {/* FOOTER */}
            <footer className="bg-red-900 text-white py-8 text-center">
                <p>© 2025 Whiskers Pizzeria. All rights reserved.</p>
            </footer>
        </div>
    );
}

/* ——————————————————————————————
     SMALL REUSABLE COMPONENTS
—————————————————————————————— */

function FeatureCard({
    icon,
    title,
    text,
}: {
    icon: React.ReactNode;
    title: string;
    text: string;
}) {
    return (
        <div className="text-center p-6 bg-white rounded-lg shadow-md">
            {icon}
            <h3 className="text-2xl mb-3 text-red-900">{title}</h3>
            <p className="text-gray-700">{text}</p>
        </div>
    );
}

function ContactItem({
    icon,
    title,
    children,
}: {
    icon: React.ReactNode;
    title: string;
    children: React.ReactNode;
}) {
    return (
        <div className="flex gap-4">
            <div className="mt-1 shrink-0">{icon}</div>
            <div>
                <h3 className="text-2xl mb-2 text-red-900">{title}</h3>
                <p className="text-gray-700">{children}</p>
            </div>
        </div>
    );
}

function Row({ label, value }: { label: string; value: string }) {
    return (
        <div className="flex justify-between gap-8 text-gray-700">
            <span>{label}</span>
            <span>{value}</span>
        </div>
    );
}

const scrollToSection = (id: string) => {
    const element = document.getElementById(id);
    if (element) {
        const navbarHeight = 80; // adjust if your navbar height changes
        const elementPosition = element.offsetTop - navbarHeight;
        window.scrollTo({ top: elementPosition, behavior: "smooth" });
    }
};
