<?php

namespace App\Http\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;

use function dd;
use function response;

class ProductsRepository implements \App\Http\Interfaces\ProductsInterface
{

	public function index()
	{
		$products = Product::get();

		if ($products->count() > 0) {
			return response()->json([
				'status' => 'success',
				'data'   => $products,
			], 200);
		}
		return response()->json([
			'status'  => 'error',
			'message' => 'No products found',
		], 404);

	}

	public function show($id)
	{
		$validation = Validator::make(['id' => $id], [
			'id' => 'required|exists:products,id',
		]);

		if ($validation->fails()) {
			return response()->json([
				'status'  => 'error',
				'message' => $validation->errors()->first(),
			], 400);
		}

		$product = Product::find($id);
		return response()->json([
			'status' => 'success',
			'data'   => $product,
		], 200);

	}

	public function store($request)
	{
		$validation = Validator::make($request->all(), [
			'name'  => 'required|min:3|max:100|unique:products,name',
			'price' => 'required|numeric',
			'stock' => 'required|numeric|min:1',
		]);

		if ($validation->fails()) {
			return response()->json([
				'status'  => 'error',
				'message' => $validation->errors()->first(),
			], 400);
		}

		Product::create([
			'name'  => $request->name,
			'price' => $request->price,
			'stock' => $request->stock,
		]);

		return response()->json([
			'status'  => 'success',
			'message' => 'Product created successfully',
		], 200);
	}

	public function update($request, $id)
	{
		$validation = Validator::make($request->all(), [
			'name'  => 'required|min:3|max:100|unique:products,name,' . $id,
			'price' => 'required|numeric',
			'stock' => 'required|numeric|min:1',
		]);

		if ($validation->fails()) {
			return response()->json([
				'status'  => 'error',
				'message' => $validation->errors()->first(),
			], 400);
		}

		$product = Product::find($id);
		$product->update([
			'name'  => $request->name,
			'price' => $request->price,
			'stock' => $request->stock,
		]);

		return response()->json([
			'status'  => 'success',
			'message' => 'Product updated successfully',
		], 200);
	}

	public function destroy($id)
	{
		$vlaidation = Validator::make(['id' => $id], [
			'id' => 'required|exists:products,id',
		]);
		if ($vlaidation->fails()) {
			return response()->json([
				'status'  => 'error',
				'message' => $vlaidation->errors()->first(),
			], 400);
		}
		$product = Product::find($id);
		$productName = $product->name;
		$product->delete();
		return response()->json([
			'status'  => 'success',
			'message' => 'Product'.$productName.'deleted successfully',
		], 200);
	}
}