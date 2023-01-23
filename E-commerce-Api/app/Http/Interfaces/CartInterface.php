<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface CartInterface
{
	public function userCart();

	public function addToCart(Request $request);

	public function deleteFromCart(Request $request);

	public function updateCart(Request $request);

}