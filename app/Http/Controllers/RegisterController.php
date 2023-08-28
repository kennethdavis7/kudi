<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view("loginRegister.register", [
            "title" => "Register"
        ]);
    }

    public function store(Request $request){
        $validationData = $request->validate([
            'name' => ['required', "max:20"],
            'email' => ['required', 'email:dns', "unique:users"],
            'password' => ['required', "min:8"],
        ]);

        $validationData["password"] = Hash::make($validationData["password"]);

        User::create($validationData);

        // session()->flash("success", "Registration Succesful");

        return redirect("/register")->with("success", "Registration Succesful");
    }
}
