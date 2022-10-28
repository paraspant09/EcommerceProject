<?php

namespace App\Http\Controllers;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //register form
    public function create(){
        return view("auth.register");
    }

    //store data(register)
    public function store(Request $request){
        $formFields=$request->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:8|max:100|unique:users',
            'phone_num' => 'required|min:10|max:20',
            'address' => 'required|min:8|max:100',
            'password' => 'required|min:6|max:255'
        ]);

        $formFields['password']=Hash::make($formFields['password']);

        //db insert into command
        $expert=User::create($formFields);

        //login
        auth()->login($expert);

        return redirect("/")->with('message','User created and logged In.');
    }

    //login form
    public function login(){
        return view("auth.login");
    }

    //authenticate
    public function authenticate(Request $request){
        $formFields=$request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    //logout
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }
}
