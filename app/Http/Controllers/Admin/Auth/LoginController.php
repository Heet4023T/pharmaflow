<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'User Login';
        $authPortal = 'user';

        return view('admin.auth.login', compact('title', 'authPortal'));
    }

    public function adminIndex()
    {
        $title = 'Admin Login';
        $authPortal = 'admin';

        return view('admin.auth.login', compact('title', 'authPortal'));
    }

    public function login(Request $request)
    {
        return $this->authenticate($request, false);
    }

    public function adminLogin(Request $request)
    {
        return $this->authenticate($request, true);
    }

    /**
     * Authenticate with Laravel's existing password verification, then
     * enforce portal access using Spatie roles.
     */
    protected function authenticate(Request $request, bool $adminPortal)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()
                ->with('login_error', 'Invalid email or password.')
                ->withInput($request->only('email'));
        }

        $user = auth()->user();

        if ($adminPortal && !$user->isAdministrator()) {
            auth()->logout();

            return back()
                ->with('login_error', 'This account is not authorized for administrator access. Please use User Login.')
                ->withInput($request->only('email'));
        }

        if (!$adminPortal && $user->isAdministrator()) {
            auth()->logout();

            return back()
                ->with('login_error', 'This account is an administrator account. Please use Admin Login.')
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}
