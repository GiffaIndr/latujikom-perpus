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

    public function user()
    {
        $user = User::all();
        return view('admin.user', compact('user'));
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
        if (Auth::attempt($user)) {
            return redirect('/landing');
        } else {
            return redirect()->back()->with('gagalLogin', 'gagal login silahkan cek kembali');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required:email:dns',
            'nis' => 'required',
            'address' => 'required',
            'password' => 'required',
        ]);
        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'nis' => $request->nis,
            'address' => $request->address,
            'password' => $request->password
        ]);
        return redirect('/')->with('successregister', 'sukses menambah akun! silahkan login!');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email:dns',
            'username' => 'required',
            'nis' => 'required',
            'address' => 'required',
            'role' => 'required'
        ]);
        User::create([
            'name' => $request->name,
            'password' => $request->password,
            'email' => $request->email,
            'nis' => $request->nis,
            'username' => $request->username,
            'address' => $request->address,
            'role' => $request->role
        ]);
        return redirect('/dashboard/user')->with('successUser', 'sukses menambah user');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email:dns',
            'username' => 'required',
            'address' => 'required',
            'nis' => 'required',
        ]);
        User::where('id', $id)->update([
            'name' => $request->name,
            'password' => $request->password,
            'email' => $request->email,
            'nis' => $request->nis,
            'address' => $request->address,
            'username' => $request->username,
        ]);
        return redirect('/dashboard/user')->with('successRegsiter', 'sukses register, silahkan login');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        user::find($id)->delete();
        return redirect('/dashboard/user')->with('successDelete', 'sukses delete user');
    }
}
