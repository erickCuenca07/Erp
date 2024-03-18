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
                    Route::get('/createUser', [UsersController::class, 'createIndex'])->name('admin.users.create');
                    Route::post('/insert', [UsersController::class, 'insert'])->name('admin.users.insert');
                    Route::post('/delete', [UsersController::class, 'delete'])->name('admin.users.delete');
                    Route::get('/edit{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
                    Route::post('/update', [UsersController::class, 'update'])->name('admin.users.update');
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
