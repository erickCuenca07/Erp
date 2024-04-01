<?php
use Illuminate\Support\Facades\Route;
use Products\HistoryListProducts\Domain\Model\HistoryListProductsModel;
use Products\HistoryListProducts\Infrastructure\Entrypoint\Http\HistoryListProductsController;
use Products\ListProducts\Infrastructure\Entrypoint\Http\ListProductsController;
use Products\ListProducts\Domain\Model\ListProductsModel;
use Products\SearchArticle\Infrastructure\Entrypoint\Http\ControllerSearchArticle;
use Products\SearchArticle\Domain\Model\SearchArticleModel;

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
                'prefix' => 'HistoryListProducts',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .HistoryListProductsModel ::class],
                ], function () {
                    Route::get('/', [HistoryListProductsController::class, 'index'])->name('products.historyListProducts.index');

                });
            });

            Route::group([
                'prefix' => 'ListProducts',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .ListProductsModel ::class],
                ], function () {
                    Route::get('/', [ListProductsController::class, 'index'])->name('products.listProducts.index');

                });
            });

            Route::group([
                'prefix' => 'searchArticle',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .SearchArticleModel ::class],
                ], function () {
                    Route::get('/', [ControllerSearchArticle::class, 'index'])->name('products.searchArticle.index');
                    Route::post('/search', [ControllerSearchArticle::class, 'search'])->name('products.searchArticle.search');
                });
            });
        });
    }
);
