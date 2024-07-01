<?php

use App\Http\Controllers\AirportController;
use App\Http\Controllers\HostFamilyController;
use App\Http\Controllers\LocalCoordinatorController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PartnerAbroadController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEB Routes
|--------------------------------------------------------------------------
*/
Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    echo "Hurray! Cache, Config, View Are cleared";
});

Route::fallback('\App\Http\Controllers\HomeController@show404');

Route::get('/', '\App\Http\Controllers\AuthController@login');

Route::prefix('/auth')->group(function () {
    Route::get('/', '\App\Http\Controllers\AuthController@login');
    Route::get('/login', '\App\Http\Controllers\AuthController@login');
    Route::get('/forgot-password', '\App\Http\Controllers\AuthController@forgotPassword');
    Route::get('/reset/{reset_password_token}', '\App\Http\Controllers\AuthController@reset');
    Route::get('/change-password', '\App\Http\Controllers\AuthController@changePassword');
    Route::get('/account-settings', '\App\Http\Controllers\AuthController@accountSettings');
});


Route::get('/student/register', '\App\Http\Controllers\StudentController@registerStudent');


Route::middleware('CheckUser')->group(function () {
    Route::get('/dashboard', '\App\Http\Controllers\DashboardController@index');

    Route::prefix('/permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index']);
        Route::get('/create', [PermissionController::class, 'create']);
        Route::get('/{id}/edit', [PermissionController::class, 'edit']);
    });

    Route::prefix('/default')->group(function () {
        Route::get('/create', function () {
            return view('default.create');
        });

        Route::get('/list', function () {
            return view('default.list');
        });
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', '\App\Http\Controllers\UserController@index');
        Route::get('/dog-list', '\App\Http\Controllers\UserController@dogList');
        Route::get('/create', '\App\Http\Controllers\UserController@create');
        Route::get('/{id}/edit', '\App\Http\Controllers\UserController@edit');
    });

    Route::prefix('/students')->group(function () {
        Route::get('/', '\App\Http\Controllers\UserController@index');
        Route::get('/create', '\App\Http\Controllers\UserController@create');
        Route::get('/{id}/edit', '\App\Http\Controllers\UserController@edit');
        Route::get('/info', '\App\Http\Controllers\UserController@forminfo');
    });

    Route::prefix('/payments')->group(function () {
        Route::get('/', '\App\Http\Controllers\PaymentController@index');
        Route::get('/create', '\App\Http\Controllers\PaymentController@create');
        Route::get('/{id}/edit', '\App\Http\Controllers\PaymentController@edit');
        Route::get('{id}/invoice', '\App\Http\Controllers\PdfController@viewPdf');
    });

    
    Route::prefix('/batches')->group(function () {
        Route::get('/', '\App\Http\Controllers\BatchController@index');
        Route::get('/create', '\App\Http\Controllers\BatchController@create');
        Route::get('/{id}/edit', '\App\Http\Controllers\BatchController@edit');
    });


    Route::prefix('/support')->group(function () {
        Route::prefix('/terms-and-conditions')->group(function () {
            Route::get('/', '\App\Http\Controllers\SupportController@termsAndConditions');
        });

        Route::prefix('/privacy-policy')->group(function () {
            Route::get('/', '\App\Http\Controllers\SupportController@privacyPolicy');
        });

        Route::prefix('/contact-us')->group(function () {
            Route::get('/', '\App\Http\Controllers\SupportController@contactUs');
        });
    });

});


