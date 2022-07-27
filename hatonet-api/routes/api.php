<?php

use App\Http\Controllers\Publish\AccountPublishController;
use App\Http\Controllers\Publish\AuthPublishController;
use App\Http\Controllers\Publish\CategoryPublishController;
use App\Http\Controllers\Publish\PostPublishController;
use App\Http\Controllers\Publish\ProductPublishController;
use App\Http\Controllers\Publish\OrderPublishController;
use App\Http\Controllers\Publish\ServicePublishController;
use App\Http\Controllers\Publish\UserPublishController;
use App\Http\Controllers\Publish\ContactPublishController;
use App\Http\Controllers\Publish\FollowPublishController;
use App\Http\Controllers\Publish\PackagePublishController;
use App\Http\Controllers\Publish\TermPublishController;
use Illuminate\Support\Facades\Route;

Route::middleware(['cors'])->group(function () {
    /**
     * Jobs
     */
    Route::get('jobs/download', [ProductPublishController::class, 'getDownload']);
    Route::resource('jobs', ProductPublishController::class);
    /**
     * Category
     */
    Route::resource('category', CategoryPublishController::class);
    /**
     * Users
     */
    Route::resource('users', UserPublishController::class);
    /**
     * Posts
     */
    Route::resource('post', PostPublishController::class);
    /**
     * Packages
     */
    Route::resource('package', PackagePublishController::class);
    /**
     * Term
     */
    Route::resource('term', TermPublishController::class);
    /**
     * follow
     */
    Route::resource('follows', FollowPublishController::class);

    /**
     * Action Mail
     */
    Route::controller(ContactPublishController::class)
        ->prefix("mail")
        ->group(function () {
            Route::get('/', 'index');
            Route::post('send', 'sendMail');
            Route::post('recived', 'sendMailRegister');
        });
    /**
     * Auth
     */
    Route::controller(AuthPublishController::class)
    ->prefix("auth")
    ->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('forgot', 'forgot');
        Route::post('reset', 'reset');
        Route::post('change', 'change');
        Route::post('confirm', 'confirm');
        Route::get('social/{provider}', 'social');
    });
    // Route::post('reset', AuthPublishController::class);
    // Route::post('updateLogin', [AuthPublishController::class , 'updates' ]);
});
/*
|--------------------------------------------------------------------------
| Private Api
|--------------------------------------------------------------------------
 */


require_once __DIR__ . "/private.php";
