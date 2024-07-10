<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class userController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function add()
    {
        return view('admin.user.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:owner,pegawai',
        ];

        $messages = [
            'username.required' => '*Username harus diisi',
            'username.string' => '*Username harus berupa string',
            'username.max' => '*Username maksimal 255 karakter',
            'email.required' => '*Email harus diisi',
            'email.string' => '*Email harus berupa string',
            'email.email' => '*Format email tidak valid',
            'email.max' => '*Email maksimal 255 karakter',
            'email.unique' => '*Email sudah digunakan',
            'password.required' => '*Password harus diisi',
            'password.string' => '*Password harus berupa string',
            'password.min' => '*Password minimal 8 karakter',
            'role.required' => '*Role harus diisi',
            'role.in' => '*Role harus salah satu dari: owner, pegawai',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $editData = User::findOrFail($id);
        return view('admin.user.edit', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|nullable|string|min:8',
            'role' => 'required|in:owner,pegawai',
        ];

        $messages = [
            'username.required' => '*Username harus diisi',
            'username.string' => '*Username harus berupa string',
            'username.max' => '*Username maksimal 255 karakter',
            'email.required' => '*Email harus diisi',
            'email.string' => '*Email harus berupa string',
            'email.email' => '*Format email tidak valid',
            'email.max' => '*Email maksimal 255 karakter',
            'email.unique' => '*Email sudah digunakan',
            'password.min' => '*Password minimal 8 karakter',
            'role.required' => '*Role harus diisi',
            'role.in' => '*Role harus salah satu dari: owner, pegawai',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index')->with('success', 'Login berhasil');
        }
    
        return redirect()->back()->with('error', 'Email atau password salah');
    }
    
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
