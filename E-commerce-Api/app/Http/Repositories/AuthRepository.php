<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use function response;

class AuthRepository implements AuthInterface
{
	public function register(Request $request)
	{
		// check if user exists
		$user = User::where('email', $request->email)->first();
		if ($user) {
			return response()->json([
				'status'  => 'error',
				'message' => 'User already exists',
			]);
		}
		// validate request
		$request->validate([
			'name'     => 'required|string|max:255',
			'email'    => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
		]);
		// create user  and return token
		$user = User::create([
			'name'     => $request->name,
			'email'    => $request->email,
			'password' => Hash::make($request->password),
		]);
		$token = Auth::login($user);
		return response()->json([
			'status'        => 'success',
			'message'       => 'User created successfully',
			'user'          => $user,
			'authorisation' => [
				'token' => $token,
				'type'  => 'bearer',
			],
		]);

	}

	public function login(Request $request)
	{
		$request->validate([
			'email'    => 'required|string|email',
			'password' => 'required|string',
		]);
		$credentials = $request->only('email', 'password');

		$token = Auth::attempt($credentials);
		if (!$token) {
			return response()->json([
				'status'  => 'error',
				'message' => 'Unauthorized',
			], 401);
		}

		$user = Auth::user();
		return response()->json([
			'status'        => 'success',
			'user'          => $user,
			'authorisation' => [
				'token' => $token,
				'type'  => 'bearer',
			],
		]);
	}

	//	public function logout()
	//	{
	//		Auth::logout();
	//		return response()->json([
	//			'status'  => 'success',
	//			'message' => 'Successfully logged out',
	//		]);
	//	}

	//	public function refresh()
	//	{
	//		return response()->json([
	//			'status'        => 'success',
	//			'user'          => Auth::user(),
	//			'authorisation' => [
	//				'token' => Auth::refresh(),
	//				'type'  => 'bearer',
	//			],
	//		]);
	//	}

}