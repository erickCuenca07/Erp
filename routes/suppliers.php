<?php
use Illuminate\Support\Facades\Route;
use Suppliers\ListSuppliers\Infrastructure\Entrypoint\Http\ListSuppliersController;
use Suppliers\ListSuppliers\Domain\Model\ListSuppliersModel;
use Suppliers\ListCreditors\Infrastructure\Entrypoint\Http\ListCreditorsController;
use Suppliers\ListCreditors\Domain\Model\ListCreditorsModel;

Route::group(
    [
        'prefix' => 'hmb/suppliers',
        'middleware' => ['auth']
    ],
    function (){
        Route::middleware([
            config('jetstream.auth_session'),
            'verified',
        ])->group(function (){
            Route::group([
                'prefix' => 'listSuppliers',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .ListSuppliersModel ::class],
                ], function () {
                    Route::get('/', [ListSuppliersController::class, 'index'])->name('suppliers.listSuppliers.index');
                });
            });
            Route::group([
                'prefix' => 'listCreditors',
            ], function () {
                Route::group([
                    'middleware' => ['can:view,' .ListCreditorsModel ::class],
                ], function () {
                    Route::get('/', [ListCreditorsController::class, 'index'])->name('suppliers.listCreditors.index');
                });
            });
        });
    }
);
