<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'], //Unique in 'email' column from 'users' table
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);

        $employer_attributes = $request->validate([
            'employer' => ['required'],
            'logo' => ['required', File::types(['png', 'jpg'])]
        ]);

        $user = User::create($userAttributes);

        // Get the uploaded logo and store it in the filesystem
        // The type of filesystem is set in the 'FILESYSTEM_DISK' property in .env file, and the available options in config/filesystems.php
        //In this case is set to 'public', which stores it in storage/app/public folder
        $logo_path = $request->logo->store('logos');

        $user->employer()->create([
            'name' => $employer_attributes['employer'],
            'logo' => $logo_path
        ]);

        Auth::login($user);

        redirect('/');
    }

}
