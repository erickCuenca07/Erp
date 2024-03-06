<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Admin\Users\Domain\Model\UserModel;
use Admin\Users\Infrastructure\Entrypoint\Http\UsersController;
use Admin\Permissions\Infrastructure\Entrypoint\PermissionsController;

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
                    Route::get('/', [UsersController::class, 'index'])->name('admin.users.index');
                });
            });
            Route::group([
                'prefix' => 'permissions',
            ],
                function (){
                    Route::group([
                        'middleware' => ['can:view,' . UserModel::class],
                    ], function () {
                        Route::get('/', [PermissionsController::class, 'index'])->name('admin.permissions.index');
                        Route::get('/editGroupRole{id}', [PermissionsController::class, 'editGroupRole'])->name('admin.permissions.editGroupRole');
                        Route::post('/create', [PermissionsController::class, 'permissionCreate'])->name('admin.permissions.create');
                    });
                });
        });
    }
);
