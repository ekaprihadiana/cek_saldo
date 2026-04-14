<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD

class AuthController extends Controller
{
     public function showLogin()
=======
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
>>>>>>> b66c4fcd402bf8fe48b69164ba75aa7c991b9709
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
=======
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
>>>>>>> b66c4fcd402bf8fe48b69164ba75aa7c991b9709
    }

    public function logout()
    {
<<<<<<< HEAD
        Auth::logout();
        return redirect('/login');
    }
}
=======
        session()->flush();
        return redirect('/login');
    }
}
>>>>>>> b66c4fcd402bf8fe48b69164ba75aa7c991b9709
