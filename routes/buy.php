<?php
use Illuminate\Support\Facades\Route;
use Buy\Scandal\Infrastructure\Entrypoint\Http\ScandalController;
use Buy\Scandal\Domain\Model\ScandalModel;

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
                    'middleware' => ['can:view,' .ScandalModel ::class],
                ], function () {
                    Route::get('/', [ScandalController::class, 'index'])->name('scandal.index');
                    Route::get('/createArticle', [ScandalController::class, 'createArticle'])->name('scandal.create.view.article');
                });
            });
        });
    }
);
