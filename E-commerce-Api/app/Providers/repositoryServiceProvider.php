<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class repositoryServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			\App\Http\Interfaces\AuthInterface::class,
			\App\Http\Repositories\AuthRepository::class
		);
		$this->app->bind(
			\App\Http\Interfaces\ProductsInterface::class,
			\App\Http\Repositories\ProductsRepository::class
		);
		$this->app->bind(
			\App\Http\Interfaces\CartInterface::class,
			\App\Http\Repositories\CartRepository::class
		);
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}
}
