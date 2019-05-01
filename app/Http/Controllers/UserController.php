<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function update(\App\Http\Requests\Users\Put $request, $userId)
    {
        $input = $request->only(['bio', 'emoji_set']);
        $user = \App\User::find($userId);
        $user->fill($input)->save();
        return response($user, 200);
    }
}
