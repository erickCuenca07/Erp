<?php
use Illuminate\Support\Facades\Route;
use Api\DelSol\Infrastructure\Entrypoint\Http\ApiDelSolController;
use Api\DelSol\Domain\Model\ApiDelSol;


Route::group(
    [
        'prefix' => 'hmb/apis',
        'middleware' => ['auth']
    ],
    function (){
        Route::middleware([
            config('jetstream.auth_session'),
            'verified',
        ])->group(function (){
            Route::group([
                'prefix' => 'delSol',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .ApiDelSol ::class],
                ], function () {
                    Route::get('/', [ApiDelSolController::class, 'index'])->name('apis.delSol.index');

                });
            });
        });
    }
);
