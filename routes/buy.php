<?php
use Buy\CreateArticle\Domain\Model\CreateArticleModel;
use Buy\CreateArticle\Infrastructure\Entrypoint\Http\CreateArticleController;
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
        });
    }
);
