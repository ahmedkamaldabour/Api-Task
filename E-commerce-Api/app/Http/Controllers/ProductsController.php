<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProductsInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
	public $ProductsInterface;

	public function __construct(ProductsInterface $ProductsInterface,)
	{
		$this->ProductsInterface = $ProductsInterface;
		$this->middleware('auth:api');
	}

	public function index()
	{
		return $this->ProductsInterface->index();
	}

	public function show($id)
	{
		return $this->ProductsInterface->show($id);
	}

	public function store(Request $request)
	{
		return $this->ProductsInterface->store($request);
	}

	public function update(Request $request, $id)
	{
		return $this->ProductsInterface->update($request, $id);
	}

	public function destroy($id)
	{
		return $this->ProductsInterface->destroy($id);
	}

}
