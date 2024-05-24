<?php
use Illuminate\Support\Facades\Route;
use Families\ListFamilies\Infrastructure\Entrypoint\Http\ListFamiliesController;
use Families\ListFamilies\Domain\Model\ListFamiliesModel;

Route::group(
    [
        'prefix' => 'hmb/families',
        'middleware' => ['auth']
    ],
    function (){
        Route::middleware([
            config('jetstream.auth_session'),
            'verified',
        ])->group(function (){
            Route::group([
                'prefix' => 'listFamilies',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .ListFamiliesModel ::class],
                ], function () {
                    Route::get('/', [ListFamiliesController::class, 'index'])->name('families.listFamilies.index');
                });
            });

        });
    }
);
