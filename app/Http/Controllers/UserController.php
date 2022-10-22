<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function dashboard()
    {
        return view('dashboard');
    }
    public function login()
    {
        return view('login');
    }
    public function logout()
    {
        auth()->logout();
        return redirect("/");
    }
    public function register()
    {
        return view('register');
    }
    public function store(Request $request)
    {

        // $request->validate([
        //     'name' => "String | required",
        //     'mobile' => "Integer | required | max:10 | unique:users",
        //     'email' => "String | required | email | unique:users",
        //     'password' => "String | required | min:6",

        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,

        ]);
        if ($user) {
            return redirect(route('login'))->with("success", "registered successfully");
        }
    }
    public function authenticate(Request $request)
    {
        // $request->validate([

        //     'email' => "string | required | email | unique:users",
        //     'password' => "string | required | min:6",

        // ]);
        $user = Auth::attempt($request->only(['email', 'password']));
        if ($user) {
            return redirect(route('dashboard'))->with("success", "Logged In");
        } else {
            return redirect()->back()->with("errore", "Invalid Credentials");
        }
    }

    function check(Request $request)
    {
        $user = User::where("mobile", $request->mobile)->first();
        if ($user) {
            return ['success' => true, "name" => $user->name];
        }
        return ['success' => false, "name" => null];
    }
}
