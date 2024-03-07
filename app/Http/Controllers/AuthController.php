<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        return view('Auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ], [
            'email.exist' => 'email belum tersedia',
            'password.exist' => 'password belum tersedia'
        ]);
        $user = $request->only('email', 'password');
        if(Auth::attempt($user)) {
            return redirect('/landing');
        } else {
            return redirect()->back()->with('gagalLogin', 'gagal login silahkan cek kembali');
        }
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required:email:dns',
            'nis' => 'required',
            'password' => 'required',
        ]);
        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'nis' => $request->nis,
            'password' => $request->password
        ]);
        return redirect('/')->with('successregister', 'sukses menambah akun! silahkan login!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Auth $auth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auth $auth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auth $auth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auth $auth)
    {
        //
    }
}
