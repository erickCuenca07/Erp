<?php
use Illuminate\Support\Facades\Route;
use Orders\OrdersPendingService\Domain\Model\OrdersPendingServiceModel;
use Orders\OrdersPendingService\Infrastructure\Entrypoint\Http\OrdersPendingServiceController;
Route::group(
    [
        'prefix' => 'hmb/orders',
        'middleware' => ['auth']
    ],
    function (){
        Route::middleware([
            config('jetstream.auth_session'),
            'verified',
        ])->group(function (){
            Route::group([
                'prefix' => 'listPendingOrders',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .OrdersPendingServiceModel ::class],
                ], function () {
                    Route::get('/', [OrdersPendingServiceController::class, 'index'])->name('orders.listOrdersPendingService.index');
                    Route::post('getData', [OrdersPendingServiceController::class, 'getData'])->name('orders.listOrdersPendingService.getData');
                });
            });

        });
    }
);
