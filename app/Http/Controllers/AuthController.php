<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $rules = [
            'name' => 'required|string|min:4|max:30',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|digits_between:8,15',
            'password' => 'required|string|min:8|max:30|confirmed',
            'password_confirmation' => 'required|string|min:8|max:30',
        ];
        $validator = Validator::make($request->post(), $rules);
        if ($validator->fails()) {

            $err = $validator->getMessageBag()->toArray();
            foreach ($err as $v) {
                $err[] = $v;
            }
            return response()->json([
                'code' => 201,
                'message' => $err[0],
            ]);
        }

        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]
        );
        return response()->json([
            'code' => 200,
            'message' => 'Pendaftaran berhasil',
        ]);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
        $validator = Validator::make($request->post(), $rules);
        if ($validator->fails()) {
            $err = $validator->getMessageBag()->toArray();
            foreach ($err as $v) {
                $err[] = $v;
            }
            return apiResponse(201, [], $err[0][0]);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                Auth::loginUsingId($user->id);
                return apiResponse(200, [], "Login berhasil");
            }

            return apiResponse(201, [], "Password salah, bro!");
        }
        return apiResponse(201, [], "Email tidak terdaftar");
    }
}
