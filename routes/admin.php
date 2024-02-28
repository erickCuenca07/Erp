<?php 
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Admin\Users\Domain\Model\UserModel;
use Admin\Users\Infrastructure\Entrypoint\Http\AdminController;

Route::group(
    [
        'prefix' => 'hmb/admin',
        'middleware' => ['auth']
    ],
    function () {
        Route::middleware([
            config('jetstream.auth_session'),
            'verified',
        ])->group(function () {
            Route::group([
                'prefix' => 'users',
            ],
            function (){
                Route::group([
                    'middleware' => ['can:view,' . UserModel::class],
                ], function () {
                    Route::get('/', [AdminController::class, 'index'])->name('admin.users.index');
                });
            });
        });
    }
);