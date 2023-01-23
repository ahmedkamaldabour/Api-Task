<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CartInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
	public $CartInterface;

	public function __construct(CartInterface $CartInterface)
	{
		$this->CartInterface = $CartInterface;
		$this->middleware('auth:api');
	}

	public function userCart()
	{
		return $this->CartInterface->userCart();
	}

	public function addToCart(Request $request)
	{
		return $this->CartInterface->addToCart($request);
	}

	public function deleteFromCart(Request $request)
	{
		return $this->CartInterface->deleteFromCart($request);
	}

	public function updateCart(Request $request)
	{
		return $this->CartInterface->updateCart($request);
	}
}
