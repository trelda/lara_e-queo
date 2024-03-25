<?php

namespace App\Http\Controllers\User;

use App\Models\User;

class EditController extends BaseController
{
    public function __invoke(User $user)
    {
        $user = User::find(Auth()->user()->id);
        return view('user.edit', compact('user'));
    }
}