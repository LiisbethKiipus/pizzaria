<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Item;
use Illuminate\Contracts\Support\Renderable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Items/Index', [
            "items" => Item::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render("Items/Create", [
            "categories" => array_map(fn($case) => $case->value, Category::cases())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => "required",
            "category" => "required"
        ]);

        /**
         * @var array{name: string, description: string, category: string, price: float} $contents
         */
        $contents = $request->json()->all();
        Item::factory()->create([
            'name' => $contents['name'],
            'description' => $contents['description'],
            'category' => $contents['category'],
            'price' => $contents['price'],
        ]);
        return to_route("items.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        $item = Item::find($id);
        if (!$item) {
            throw new NotFoundHttpException('item not found');
        }
        return Inertia::render("Items/Show", [
            "item" => $item ,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $item = Item::find($id);
        if (!$item) {
            throw new NotFoundHttpException('item not found');
        }
        return Inertia::render("Items/Edit", [
            "categories" => array_map(fn($case) => $case->value, Category::cases()),
            "item" => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => "required",
            "category" => "required"
        ]);
        $item = Item::find($id);
        if (!$item) {
            throw new NotFoundHttpException('item not found');
        }
        /**
         * @var array{name: string, description: string, category: string, price: float} $contents
         */
        $contents = $request->json()->all();
        $item->name = $contents['name'];
        $item->description = $contents['description'];
        $item->price = $contents['price'];
        $item->category = $contents['category'];
        $item->save();
        return to_route("items.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $item = Item::Find($id);
        if (!$item) {
            throw new NotFoundHttpException('Food not found');
        }

        $item->delete();
        return to_route("items.index");
    }
}
