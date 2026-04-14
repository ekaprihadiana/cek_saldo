<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = DB::table('useradmin')
            ->where('username', $request->username)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {

            session([
                'login' => true,
                'user' => $user
            ]);

            return redirect('/dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}