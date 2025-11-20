<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;

abstract class Controller
{
    protected static function getUser(Request $request): ?User
    {
        /** @var ?User */
        $user = $request->user();
        return $user;
    }
}
