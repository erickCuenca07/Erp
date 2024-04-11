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
                'prefix' => 'scandal',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .CreateArticleModel ::class],
                ], function () {
                    Route::get('/createArticle', [CreateArticleController::class, 'createArticle'])->name('scandal.create.view.article');
                });
            });
        });
    }
);
