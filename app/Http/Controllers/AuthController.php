<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\ForgotPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Notifications\VerifyEmail;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = User::create([...$validated, 'profile_picture' => 'storage/img/pfp/rem.jpg']);
        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Registration successful'], 201);
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $remember = $request->has('remember');

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ],403);
        }

        Auth::login($user, $remember);
        session()->regenerate();

        return response()->json(['message' => 'logged in successfully'],201);
    }

    public function logout(): JsonResponse
    {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return response()->json(['message' => 'Logout successful'], 200);
    }

    public function forgotPassword(Request $request)
    {
        $token = Str::random(64);
        PasswordReset::create([
            'email' => $request['email'],
            'token' => $token,
        ]);

        Mail::to($request['email'])->send(new ForgotPassword($token, $request['email']));
    }

    public function recoverPassword(Request $request)
    {
        $check_token = PasswordReset::where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$check_token) {
            return redirect()->to(env('FRONTEND_URL'));
        } else {
            return redirect()->to(env('FRONTEND_URL') . "?dialog=reset_password&email=" . $request->email . "&token=" . $request->token);
        }
    }

    public function resetPassword(Request $request)
    {

        $check_token = PasswordReset::where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$check_token) {
            return response()->json(['message'=>'check token not found :('],400);
        } else {
            User::where('email', $request->email)->update([
                'password' => bcrypt($request->password)
            ]);
            PasswordReset::where([
                'email' => $request->email
            ])->delete();
            return response()->json(['message'=>'password changed :)'],202);
        }
    }
}
