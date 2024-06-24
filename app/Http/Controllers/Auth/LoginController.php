<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Other methods like showLoginForm, etc.

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.index'); // Adjust the route name as needed
        }

        return redirect('/dashboard'); // Default redirect for non-admin users
    }
}
