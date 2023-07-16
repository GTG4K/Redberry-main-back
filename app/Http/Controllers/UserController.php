<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Resources\UserResource;
use App\Mail\verifyEmailChangeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function user(Request $request)
    {
        return $request->user();
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $request->validate([
            'password' => 'confirmed|min:8',
            'email' => 'email',
        ]);

        if ($request['name']) {
            $user->name = $request['name'];
        }

        if ($request['password']) {
            $user->password = $request['password'];
        }

        if ($request['email']) {
            Mail::to($request['email'])->send(new verifyEmailChangeRequest($user->id, $user->name, $request['email']));
            return response()->json(['message' => 'email verification message sent'], 201);
        }

        if ($request['profile_picture']) {
            $path = $request['profile_picture']->store('img/pfp');
            $user->profile_picture = $path;
        }

        $user->save();

        return response()->json(['message' => 'user changed success'], 202);
    }

    public function verifyEmailChange($id, Request $request)
    {
        $user = User::find($id);

        if ($request['email']) {
            $user->email = $request['email'];
        }

        $user->save();

        return Redirect::to(env('FRONTEND_URL'));
    }

    public function sendMessage(Request $request){
        $textmessage = $request->validate([
            'text' => 'string'
        ]);

        event(new MessageSent($textmessage));
    }
}
