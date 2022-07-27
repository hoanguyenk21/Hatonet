<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Private\AuthController;
use App\Http\Controllers\Private\PostController;
use App\Http\Controllers\Private\TermController;
use App\Http\Controllers\Private\MediaController;
use App\Http\Controllers\Private\OrderController;
use App\Http\Controllers\Private\OptionController;
use App\Http\Controllers\Private\TicketController;
use App\Http\Controllers\Private\AccountController;
use App\Http\Controllers\Private\ApplyController;
use App\Http\Controllers\Private\FollowController;
use App\Http\Controllers\Private\NotifyController;
use App\Http\Controllers\Private\PackageController;
use App\Http\Controllers\Private\ProductController;
use App\Http\Controllers\Private\ServiceController;
use App\Http\Controllers\Private\TaxonomyController;
use App\Http\Controllers\Private\ContactController;
use App\Http\Controllers\Private\UserController;
use App\Http\Controllers\Private\ReviewController;
use App\Http\Controllers\Private\CustomReviewController;

Route::middleware('auth:sanctum')->prefix("admin")->group(function () {
    /**
     * Authtication
     */
    Route::controller(AuthController::class)
        ->prefix("auth")
        ->group(function () {
            Route::post('logout', 'logout');
            Route::get('user', 'user');
        });


    Route::controller(AccountController::class)
        ->prefix("accounts")
        ->group(function () {
            Route::get("/users", "getUsers");
            Route::post("/password", "changePassword");
            Route::post("/verify-sms", "verifySms");
        });
    Route::resource('accounts', AccountController::class);
    Route::resource('mailregister', ContactController::class);

    /**
     * Taxonomy
     */
    Route::resource('taxonomies', TaxonomyController::class);

    Route::controller(TaxonomyController::class)
        ->prefix("taxonomies")
        ->group(function () {
            Route::post("/ticket", "createTicket");
            Route::post("/product", "createProduct");
            Route::post("/post", "createCategory");
        });

    /**
     * File
     */
    Route::resource('media', MediaController::class);

    Route::controller(MediaController::class)
        ->prefix("media")
        ->group(function () {
            Route::post("/upload", "upload");
            Route::post("/remove/{file}", "remove");
        });

    /**
     * Post
     */
    Route::resource('posts', PostController::class);
    Route::post('/posts/{id}', [PostController::class, 'update']);

    /**
     * Notify
     */
    Route::resource('notifies', NotifyController::class);

    /**
     * Option
     */
    Route::resource('options', OptionController::class);

    /**
     * Order
     */
    Route::resource('orders', OrderController::class);

    /**
     * Package
     */
    Route::resource('packages', PackageController::class);
    Route::post('package/vnpay-payment', [PackageController::class, 'vnpayPayment']);

    /**
     * Service
     */
    Route::resource('services', ServiceController::class);

    /**
     * Product
     */
    Route::resource('products', ProductController::class);


    /**
     * Term
     */
    Route::resource('terms', TermController::class);
    /**
     * Ticket
     */
    Route::resource('tickets', TicketController::class);

    /**
     * User
     */
    Route::resource('user', UserController::class);
    Route::post('/user/{id}', [UserController::class, 'update']);
    /**
     * Review
     */
    Route::resource('reviews', ReviewController::class);
    /**
     * Follow
     */
    Route::resource('follow', FollowController::class);
    /**
     * custom_review
     */
    Route::resource('custom_review', CustomReviewController::class);
    /**
     * apply
     */
    Route::resource('apply', ApplyController::class);
});
