<?php

namespace App\Http\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Rules\StockValdation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function response;

class CartRepository implements \App\Http\Interfaces\CartInterface
{

	public function userCart()
	{
		$carts = Cart::where('user_id', auth()->user()->id)
			->get();
		return response()->json([
			'status' => true,
			'data'   => $carts,
		], 200);

	}

	public function addToCart(Request $request)
	{
		$validations = Validator::make($request->all(), [
			'product_id' => 'required|exists:products,id',
			'count'      => ['required', 'min:1', new StockValdation],
		]);
		if ($validations->fails()) {
			return response()->json([
				'status'  => false,
				'message' => $validations->errors()->first(),
			], 200);
		}
		// Check if product already exists in cart
		$cart = Cart::where([
			['user_id', auth()->user()->id],
			['product_id', $request->product_id],
		])->first();
		if ($cart) {
			$cart->update([
				'count' => $cart->count + $request->count,
			]);
			return response()->json([
				'status'  => true,
				'message' => 'Product added to cart successfully',
			], 200);
		}
		Cart::create([
			'user_id'    => auth()->user()->id,
			'product_id' => $request->product_id,
			'count'      => $request->count,
		]);
		return response()->json([
			'status'  => 'true',
			'message' => 'Product added to cart successfully',
		], 200);
	}

	public function deleteFromCart(Request $request)
	{
		$validations = Validator::make($request->all(), [
			'product_id' => 'required|exists:products,id',
		]);

		if ($validations->fails()) {
			return response()->json([
				'status'  => false,
				'message' => $validations->errors()->first(),
			], 200);
		}
		$cart = Cart::where([
			['user_id', auth()->user()->id],
			['product_id', $request->product_id],
		])->first();
		if ($cart) {
			$cart->delete();
			return response()->json([
				'status'  => true,
				'message' => 'Product deleted from cart successfully',
			], 200);
		}
		return response()->json([
			'status'  => false,
			'message' => 'Product not found in cart',
		], 200);
	}

	public function updateCart(Request $request)
	{
		$validations = Validator::make($request->all(), [
			'product_id' => 'required|exists:products,id',
			'count'      => ['required', 'min:1', new StockValdation],
		]);
		if ($validations->fails()) {
			return response()->json([
				'status'  => false,
				'message' => $validations->errors()->first(),
			], 200);
		}
		$cart = Cart::where([
			['user_id', auth()->user()->id],
			['product_id', $request->product_id],
		])->first();
		if ($cart) {
			$cart->update([
				'count' => $request->count,
			]);
			return response()->json([
				'status'  => true,
				'message' => 'Cart updated successfully',
			], 200);
		}
		return response()->json([
			'status'  => false,
			'message' => 'Product not found in cart',
		], 200);
	}
}