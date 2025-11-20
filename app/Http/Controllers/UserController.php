<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Users/Index', [
            "users" => User::with("roles")->get()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render("Users/Create", [
            "roles" => Role::pluck("name")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request -> validate([
            "name" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        /**
         * @var array{name: string, email: string, password: string, roles: string[]} $contents
         */
        $contents = $request->json()->all();

        $user = User::factory()->create([
            'email' => $contents['email'],
            'name' => $contents['name'],
            'password' => Hash::make($contents['password']),
        ]);
        $user->syncRoles($contents['roles']);
        return to_route("users.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return Inertia::render("Users/Show", [
            "roles" => Role::pluck("name")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $user = User::find($id);
        if (!$user) {
            throw new NotFoundHttpException('User not found');
        }
        return Inertia::render("Users/Edit", [
            "user" => $user,
            "userRoles" => $user->roles()->pluck("name"),
            "roles" => Role::pluck("name")
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            "name" => "required",
            "email" => "required"
        ]);
        $user = User::Find($id);
        if (!$user) {
            throw new NotFoundHttpException('User not found');
        }

        /**
         * @var array{name: string, email: string, password?: string, roles: string[]} $contents
         */
        $contents = $request->json()->all();

        $user->name = $contents['name'];
        $user->email = $contents['email'];

        $pwd = $contents['password'] ?? null;
        if ($pwd) {
            $user->password = Hash::make($pwd);
        }
        $user->save();
        $user->syncRoles($contents['roles']);
        return to_route("users.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = User::Find($id);
        if (!$user) {
            throw new NotFoundHttpException('User not found');
        }

        $user->delete();
        return to_route("users.index");
    }
}
