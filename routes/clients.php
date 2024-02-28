<?php
use Illuminate\Support\Facades\Route;
use Clients\ListClients\Domain\Model\ListClientsModel;
use Clients\ListClients\Infrastructure\Entrypoint\Http\ListClientsController;


Route::group(
    [
        'prefix' => 'hmb/clients',
        'middleware' => ['auth']
    ],
    function (){
        Route::middleware([
            config('jetstream.auth_session'),
            'verified',
        ])->group(function (){
            Route::group([
                'prefix' => 'clients',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .ListClientsModel ::class],
                ], function () {
                    Route::get('/', [ListClientsController::class, 'index'])->name('clients.index');

                });
            });
        });
    }
);
