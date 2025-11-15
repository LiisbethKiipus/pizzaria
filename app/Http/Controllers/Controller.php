<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

abstract class Controller
{
    protected static function user(Request $request, ?string $guard = null): ?User
    {
        /** @var ?User */
        $user = $request->user($guard);
        return $user;
    }
}
