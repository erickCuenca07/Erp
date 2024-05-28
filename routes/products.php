<?php
use Illuminate\Support\Facades\Route;
use Products\HistoryListProducts\Domain\Model\HistoryListProductsModel;
use Products\HistoryListProducts\Infrastructure\Entrypoint\Http\HistoryListProductsController;
use Products\ListProducts\Infrastructure\Entrypoint\Http\ListProductsController;
use Products\ListProducts\Domain\Model\ListProductsModel;
use Products\SearchArticle\Infrastructure\Entrypoint\Http\ControllerSearchArticle;
use Products\SearchArticle\Domain\Model\SearchArticleModel;
use Products\SearchArticleMassive\Domain\Model\SearchArticleMassiveModel;
use Products\SearchArticleMassive\Infrastructure\Entrypoint\Http\ControllerSearchArticleMassive;
use Products\UpdateArticleMassive\Domain\Model\ModelUpdateArticleMassive;
use Products\UpdateArticleMassive\Infrastructure\Entrypoint\Http\ControllerUpdateArticleMassive;

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
                    Route::get('/editProducts/{id}', [ListProductsController::class, 'editProducts'])->name('products.listProducts.editProducts');
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

            Route::group([
                'prefix' => 'searchArticleMassive',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .SearchArticleMassiveModel ::class],
                ], function () {
                    Route::get('/', [ControllerSearchArticleMassive::class, 'index'])->name('products.searchArticleMassive.index');
                    Route::post('/search', [ControllerSearchArticleMassive::class, 'search'])->name('products.searchArticleMassive.search');
                });
            });

            Route::group([
                'prefix' => 'updateProductsMassive',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .ModelUpdateArticleMassive ::class],
                ], function () {
                    Route::get('/', [ControllerUpdateArticleMassive::class, 'index'])->name('products.updateArticleMassive.index');
                    Route::post('/search', [ControllerSearchArticleMassive::class, 'search'])->name('products.searchArticleMassive.search');
                });
            });
        });
    }
);
