<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
  public function showRegisterForm() {
    return view('auth.register');
  }

  public function register(Request $request) {

    $validator = Validator::make($request->all(), [
      'username' => 'required|unique:users',
      'password' => 'required|min:8|max:32',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput()
      ->with('error', 'Registration failed. Password must be between 8 and 32 characters.');
    }

    User::create([
      'name' => $request->name,
      'username' => $request->username,
      'password' => bcrypt($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Registration successful. Please login.');
  }

  public function showLoginForm() {
    return view('auth.login');
  }

  public function login(Request $request) {
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->intended('dashboard');
    }

    return back()->withErrors([
      'username' => 'The provided credentials do not match our records.',
    ])->withInput();
  }

  public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
  }
}
