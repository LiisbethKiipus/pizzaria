<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use function React\Promise\all;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render("Roles/Index", [
            "roles" => Role::with("permissions")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render("Roles/Create", [
            "permissions" => Permission::pluck("name"),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "name" => "required",
            "permissions" => "required"
        ]);

        /**
         * @var array{permissions: string[], name: string} $contents
         */
        $contents = $request->json()->all();
        $role = Role::create(["name" => $contents['name']]);
        $role->syncPermissions($contents['permissions']);
        return to_route("roles.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        $role = Role::find($id);
        if (!$role) {
            throw new NotFoundHttpException('Role not found');
        }
        return Inertia::render("Roles/Show", [
            "role" => $role,
            "permissions" => $role->permissions()->pluck("name")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $role = Role::find($id);
        if (!$role) {
            throw new NotFoundHttpException('Role not found');
        }
        return Inertia::render("Roles/Edit", [
            "role" => $role,
            "rolePermissions" => $role->permissions()->pluck("name"),
            "permissions" => Permission::pluck("name")
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            "name" => "required",
            "permissions" => "required"
        ]);

        /**
         * @var array{permissions: string[], name: string} $contents
         */
        $contents = $request->json()->all();

        $role = Role::find($id);
        if (!$role) {
            throw new NotFoundHttpException('Role not found');
        }
        $role->name = $contents['name'];
        $role->save();
        $role->syncPermissions($contents['permissions']);
        return to_route("roles.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Role::destroy($id);
        return to_route("roles.index");
    }
}
