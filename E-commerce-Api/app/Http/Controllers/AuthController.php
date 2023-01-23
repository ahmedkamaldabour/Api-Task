<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\AuthInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
	public $authInterface;

	public function __construct(AuthInterface $authInterface)
	{
		$this->authInterface = $authInterface;
		$this->middleware('auth:api', ['except' => ['login', 'register']]);
	}

	public function register(Request $request)
	{
		return $this->authInterface->register($request);
	}

	public function login(Request $request)
	{
		return $this->authInterface->login($request);

	}

//	public function logout()
//	{
//		return $this->authInterface->logout();
//	}
//
//	public function refresh()
//	{
//		return $this->authInterface->refresh();
//	}

}
