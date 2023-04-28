<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarControlller extends Controller
{
    public function update(UpdateAvatarRequest $request){


        $path = Storage::disk('public')->put('avatars', $request->file('avatar'));

        if($oldAvatar = $request->user()->avatar){
            Storage::disk('public')->delete($oldAvatar);
        }

        auth()->user()->update([
            'avatar' => $path
        ]);

        return back()->with(['message' => 'Avatar Updated']);
    }
}
