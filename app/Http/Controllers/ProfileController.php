<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('dashboard.profile', [
            'title' => 'Profile',
            'active' => "",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validationData = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email:dns',
        ]);

        if ($request->image !== null) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
            ]);

            $validationData["image"] = $request->image->store("public/images/users");
        }

        if ($request->password !== null) {
            $request->validate([
                'password' => 'min:8'
            ]);

            $validationData["password"] = Hash::make($request->password);
        }

        User::where('id', auth()->user()->id)->update($validationData);

        return redirect("/profile")->with("success", "Data has been changed succesfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
