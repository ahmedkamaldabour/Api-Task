<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function response;

interface AuthInterface
{
	public function register(Request $request);

	public function login(Request $request);


//	public function logout();
//
//	public function refresh();
}