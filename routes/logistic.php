<?php
use Illuminate\Support\Facades\Route;
use Logistic\TransportInvoices\Infrastructure\Entrypoint\Http\TransportInvoicesController;
use Logistic\TransportInvoices\Domain\Model\ModelTransportInvoices;

Route::group(
    [
        'prefix' => 'hmb/logistic',
        'middleware' => ['auth']
    ],
    function (){
        Route::middleware([
            config('jetstream.auth_session'),
            'verified',
        ])->group(function (){
            Route::group([
                'prefix' => 'transportInvoices',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .ModelTransportInvoices ::class],
                ], function () {
                    Route::get('/transportInvoices', [TransportInvoicesController::class, 'index'])->name('logistic.transportInvoices.index');
                    Route::post('/searchTransportInvoices', [TransportInvoicesController::class, 'searchTransportInvoices'])->name('logistic.transportInvoices.search');
                });
            });
        });
    }
);
