<?php
use Buy\CreateArticle\Domain\Model\CreateArticleModel;
use Buy\CreateArticle\Infrastructure\Entrypoint\Http\CreateArticleController;
use Buy\Scandal\Domain\Model\ScandalModel;
use Buy\Scandal\Infrastructure\Entrypoint\Http\ScandalController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'hmb/buy',
        'middleware' => ['auth']
    ],
    function (){
        Route::middleware([
            config('jetstream.auth_session'),
            'verified',
        ])->group(function (){
            Route::group([
                'prefix' => 'createArticle',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .CreateArticleModel ::class],
                ], function () {
                    Route::get('/createArticle', [CreateArticleController::class, 'createArticle'])->name('createArticle.index');
                    Route::post('/searchArticle', [CreateArticleController::class, 'searchArticle'])->name('createArticle.search.article');
                });
            });
            Route::group([
                'prefix' => 'scandal',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .ScandalModel ::class],
                ], function () {
                    Route::get('/createScandal', [ScandalController::class, 'index'])->name('createScandal.index');
                    Route::post('/searchSupplier', [ScandalController::class, 'searchSupplier'])->name('createScandal.searchSupplier');
                    Route::post('/searchArticle', [ScandalController::class, 'searchArticle'])->name('createScandal.searchArticle');
                });
            });
        });
    }
);
