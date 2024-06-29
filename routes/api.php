<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/dashboard')->group(function () {
    Route::post('/pie-chart', '\App\Http\Controllers\DashboardController@pieChart');
    Route::post('/line-chart', '\App\Http\Controllers\DashboardController@lineChart');
});

Route::prefix('/auth')->group(function () {
    Route::post('/authenticate', '\App\Http\Controllers\AuthController@authenticate');
    Route::post('/forgot-password-check', '\App\Http\Controllers\AuthController@forgotPasswordCheck');
    Route::post('/reset-password', '\App\Http\Controllers\AuthController@resetPassword');
    Route::post('/update-password', '\App\Http\Controllers\AuthController@updatePassword');
    Route::post('/update-account-settings', '\App\Http\Controllers\AuthController@updateAccountSettings');

    Route::post('/logout', '\App\Http\Controllers\AuthController@logout');
});

Route::prefix('/users')->group(function () {
    Route::post('/store', '\App\Http\Controllers\UserController@store');
    Route::post('/update', '\App\Http\Controllers\UserController@update');
    Route::post('/delete', '\App\Http\Controllers\UserController@destroy');
});


Route::prefix('/payments')->group(function () {
    Route::post('/store', '\App\Http\Controllers\PaymentController@store');
    Route::post('/update', '\App\Http\Controllers\PaymentController@update');
    Route::post('/delete', '\App\Http\Controllers\PaymentController@destroy');
});


Route::prefix('/students')->group(function () {
    Route::post('/store', '\App\Http\Controllers\UserController@store');
    Route::post('/update', '\App\Http\Controllers\UserController@update');
    Route::post('/delete', '\App\Http\Controllers\UserController@destroy');
});

Route::prefix('/batches')->group(function () {
    Route::post('/store', '\App\Http\Controllers\BatchController@store');
    Route::post('/update', '\App\Http\Controllers\BatchController@update');
    Route::post('/delete', '\App\Http\Controllers\BatchController@destroy');
});

Route::prefix('/dogs')->group(function () {
    Route::post('/store', '\App\Http\Controllers\DogController@store');
    Route::post('/update', '\App\Http\Controllers\DogController@update');
    Route::post('/delete', '\App\Http\Controllers\DogController@destroy');
});

Route::prefix('/support')->group(function () {
    Route::prefix('/terms-and-conditions')->group(function () {
        Route::post('/update', '\App\Http\Controllers\SupportController@updateTermsAndConditions');
    });

    Route::prefix('/privacy-policy')->group(function () {
        Route::post('/update', '\App\Http\Controllers\SupportController@updatePrivacyPolicy');
    });
});

Route::prefix('/permissions')->group(function () {
    Route::post('/update', '\App\Http\Controllers\PermissionController@update');
});


Route::prefix('/app')->group(function () {
    Route::post('/register', '\App\Http\Controllers\MobileApiController@register');
    Route::post('/verify-otp', '\App\Http\Controllers\MobileApiController@verifyOpt');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('/app')->group(function () {
        Route::post('/update-profile', '\App\Http\Controllers\MobileApiController@updateProfile');
        Route::post('/store-dog-and-owner-name', '\App\Http\Controllers\MobileApiController@storeDogAndOwnerName');
        Route::post('/store-dog-and-owner-image', '\App\Http\Controllers\MobileApiController@storeDogAndOwnerImage');
        Route::post('/store-dog-age', '\App\Http\Controllers\MobileApiController@storeDogAge');
        Route::post('/store-dog-gender', '\App\Http\Controllers\MobileApiController@storeDogGender');
        Route::post('/store-dog-breed', '\App\Http\Controllers\MobileApiController@storeDogBreed');
        Route::post('/store-dog-preference', '\App\Http\Controllers\MobileApiController@storeDogPreference');
        Route::post('/store-lat-and-long', '\App\Http\Controllers\MobileApiController@storeLatLong');
        Route::post('/get-matches-dog-list', '\App\Http\Controllers\MobileApiController@getDogMatchesList');

        Route::post('add-to-favourites', '\App\Http\Controllers\MobileApiController@addToFavourites');
        Route::post('remove-from-favourites', '\App\Http\Controllers\MobileApiController@removeFromFavourites');


        Route::prefix('/chats/')->group(function () {
            Route::post('get-users-for-chat', [\App\Http\Controllers\ChatController::class, 'getAcceptedUserForChat']);
            Route::post('send-request/{user_id}', [\App\Http\Controllers\ChatController::class, 'initiateChat']);
            Route::post('accept-or-reject', [\App\Http\Controllers\ChatController::class, 'acceptOrRejectChat']);
            Route::post('send-chat-request', [\App\Http\Controllers\ChatController::class, 'initiateChat']);
            Route::post('send-message', [\App\Http\Controllers\ChatController::class, 'sendMessage']);
            Route::get('get-new-messages', [\App\Http\Controllers\ChatController::class, 'getNewMessages']);
            Route::post('mark-as-read', [\App\Http\Controllers\ChatController::class, 'markMessagesAsRead']);
        });
    });
});

