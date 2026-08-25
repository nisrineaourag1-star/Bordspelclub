<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfilePageController extends Controller
{
    public function show(User $user)
    {
        return view('profile-page', [
            'profileUser' => $user,
        ]);
    }
}