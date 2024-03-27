<?php

use App\Events\MeetingScheduled;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ExpiryController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Pay_numbersController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/expiry', [ExpiryController::class, 'status_page']);
Route::post('/expiry/post', [ExpiryController::class, 'change_status'])->name('change status');

Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');

Route::group(['middleware' => 'adminauth:admin'], function () {
    Route::get('/', [Controller::class, 'index'])->name('dashboard');

    Route::post('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');

    Route::group(['prefix' => 'admin'], function ($router) {
        Route::group(['controller' => AdminController::class], function () {
            Route::get('/', 'index')->name('show admins');
            Route::get('/create_admin', 'create')->name('create admin');
            Route::post('/store_admin', 'store')->name('store admin');
            Route::get('/edit_admin/{admin}', 'edit')->name('edit admin');
            Route::post('/update_admin/{admin}', 'update')->name('update admin');
            Route::post('/delete_admin/{admin}', 'destroy')->name('delete admin');
        });
    });

    Route::group(['prefix' => 'profession'], function ($router) {
        Route::group(['controller' => ProfessionController::class], function () {
            Route::get('/', 'index')->name('show professions');
            Route::get('/create_profession', 'create')->name('create profession');
            Route::post('/store_profession', 'store')->name('store profession');
            Route::get('/edit_profession/{profession}', 'edit')->name('edit profession');
            Route::post('/update_profession/{profession}', 'update')->name('update profession');
            Route::post('/delete_profession/{profession}', 'destroy')->name('delete profession');
        });
    });

    Route::group(['prefix' => 'partner'], function ($router) {
        Route::group(['controller' => PartnerController::class], function () {
            Route::get('/', 'index')->name('show partners');
            Route::get('/create_partner', 'create')->name('create partner');
            Route::post('/store_partner', 'store')->name('store partner');
            Route::get('/edit_partner/{partner}', 'edit')->name('edit partner');
            Route::post('/update_partner/{partner}', 'update')->name('update partner');
            Route::post('/delete_partner/{partner}', 'destroy')->name('delete partner');
        });
    });

    Route::group(['prefix' => 'tests&xray'], function ($router) {
        Route::group(['controller' => TestController::class], function () {
            Route::get('/', 'index')->name('show tests');
            Route::get('/create_test', 'create')->name('create test');
            Route::post('/store_test', 'store')->name('store test');
            Route::get('/edit_test/{test}', 'edit')->name('edit test');
            Route::post('/update_test/{test}', 'update')->name('update test');
            Route::post('/delete_test/{test}', 'destroy')->name('delete test');
        });
    });

    Route::group(['prefix' => 'hospital'], function ($router) {
        Route::group(['controller' => HospitalController::class], function () {
            Route::get('/', 'index')->name('show hospitals');
            Route::get('/create_hospital', 'create')->name('create hospital');
            Route::post('/store_hospital', 'store')->name('store hospital');
            Route::get('/edit_hospital/{hospital}', 'edit')->name('edit hospital');
            Route::post('/update_hospital/{hospital}', 'update')->name('update hospital');
            Route::post('/delete_hospital/{hospital}', 'destroy')->name('delete hospital');
        });
    });

    Route::group(['prefix' => 'report'], function ($router) {
        Route::group(['controller' => ReportController::class], function () {
            Route::get('/', 'index')->name('show reports');
            Route::get('/answered', 'answered_reports')->name('show answered reports');
            Route::get('/show/{report}', 'show_dashboard')->name('show one report');
            Route::post('/assign_doctor/{report}', 'assign_doctor')->name('assign doctor');
            Route::get('/show_answered/{report}', 'show_answered_dashboard')->name('show answered report');
        });
    });

    Route::group(['prefix' => 'reservation'], function ($router) {
        Route::group(['controller' => ReservationController::class], function () {
            Route::get('/', 'index')->name('show reservations');
            Route::get('/show/{reservation}', 'show_reserved_dashboard')->name('show one reservation');
            Route::post('/reserve/{reservation}', 'reserve')->name('reserve');
        });
    });

    Route::group(['prefix' => 'meeting'], function ($router) {
        Route::group(['controller' => MeetingController::class], function () {
            Route::get('/', 'get_meetings')->name('show meetings');
            Route::get('edit/{meeting}', 'edit')->name('edit meeting');
            Route::post('assign_doctor/{meeting}', 'assign_doctor')->name('assign doctor meeting');
        });
    });

    Route::group(['prefix' => 'reviews'], function ($router) {
        Route::group(['controller' => ReviewController::class], function () {
            Route::get('/', 'dashboard_review')->name('show reviews');
            Route::get('/show_review/{review}', 'update_review')->name('show review');
            Route::post('/delete_review/{review}', 'destroy')->name('delete review');
        });
    });

    Route::group(['prefix' => 'contact'], function ($router) {
        Route::group(['controller' => ContactController::class], function () {
            Route::get('/', 'index')->name('show contact');
            Route::get('/show/{message}', 'show')->name('show contact message');
        });
    });

    Route::group(['prefix' => 'doctors'], function ($router) {
        Route::group(['controller' => DoctorController::class], function () {
            Route::get('/', 'index')->name('show doctors');
            Route::get('/{doctor}', 'show')->name('show doctor');
            Route::post('/delet_doctor/{doctor}', 'destroy')->name('delete doctor');
        });
    });

    Route::group(['prefix' => 'users'], function ($router) {
        Route::group(['controller' => UserController::class], function () {
            Route::get('/', 'index')->name('show users');
            Route::get('/{user}', 'show')->name('show user');
        });
    });

    Route::group(['prefix' => 'pricing'], function ($router) {
        Route::group(['controller' => PriceController::class], function () {
            Route::get('/', 'index')->name('show prices');
            Route::get('/edit/{price}', 'edit')->name('edit price');
            Route::post('/update/{price}', 'update')->name('update price');
        });
    });

    Route::group(['prefix' => 'pay_numbers'], function ($router) {
        Route::group(['controller' => Pay_numbersController::class], function () {
            Route::get('/', 'index')->name('show numbers');
            Route::get('/create', 'create')->name('create numbers');
            Route::post('/store', 'store')->name('store numbers');
            Route::get('/edit/{pay_numbers}', 'edit')->name('edit number');
            Route::post('/update/{pay_numbers}', 'update')->name('update number');
            Route::post('/delete/{pay_numbers}', 'destroy')->name('delete number');
        });
    });

    Route::group(['prefix' => 'blogs'], function ($router) {
        Route::group(['controller' => BlogController::class], function () {
            Route::get('/', 'index')->name('show blogs');
            Route::get('/create', 'create')->name('create blog');
            Route::post('/store', 'store')->name('store blog');
            Route::get('/edit/{blog}', 'edit')->name('edit blog');
            Route::post('/update/{blog}', 'update')->name('update blog');
            Route::post('/delete/{blog}', 'destroy')->name('delete blog');
        });
    });
});
