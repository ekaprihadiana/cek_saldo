<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
         dd($request->all());
    }
    

    public function store(Request $request)
    {
      
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'api_token' => Str::random(80),
        ]);

        return redirect()->back()->with('success', 'User berhasil dibuat');
    }
}