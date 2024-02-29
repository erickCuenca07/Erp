<?php
use Illuminate\Support\Facades\Route;
use Products\ListProducts\Domain\Model\ListProductsModel;
use Products\ListProducts\Infrastructure\Entrypoint\Http\ListProductsController;

Route::group(
    [
        'prefix' => 'hmb/products',
        'middleware' => ['auth']
    ],
    function (){
        Route::middleware([
            config('jetstream.auth_session'),
            'verified',
        ])->group(function (){
            Route::group([
                'prefix' => 'products',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .ListProductsModel ::class],
                ], function () {
                    Route::get('/', [ListProductsController::class, 'index'])->name('products.index');

                });
            });
        });
    }
);
