<?php

namespace App\Rules;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use function dd;
use function request;

class StockValdation implements Rule
{
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed   $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		$product = Product::where([['id', request('product_id')], ['stock', '>=', $value]])
			->first();
		if ($product) {
			$cart = Cart::where([
				['user_id', auth()->user()->id],
				['product_id', request('product_id')],
			])->first();
			if ($cart) {
				if ($cart->count + $value <= $product->stock ) {
					return true;
				}
				return false;
			}
			return true;
		}
		return false;

	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return 'The :attribute must be greater than 0 and less than or equal to the stock.';
	}
}
