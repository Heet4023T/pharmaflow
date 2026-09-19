<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index(){
        $isAdmin = auth()->check() && auth()->user()->isAdministrator();
        auth()->logout();
        return redirect()->route($isAdmin ? 'admin.login' : 'login');
    }
}
