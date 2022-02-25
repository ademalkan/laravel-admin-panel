<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('admin/login', function () {
    return view("backend.login");
})->name('login');



// Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
// {
//     //All the routes that belongs to the group goes here
//     Route::get('dashboard', function() {} );
// });
Route::group(['prefix' => 'admin', 'name' => "admin"], function () {
    //All the routes that belongs to the group goes here
    Route::resource("dashboard", BackendController::class);

    // Slider Route Start
    Route::group(['prefix' => 'slider', 'as' => 'slider.'], function () {
        Route::get("archive", [SliderController::class, "archive"])->name("archive");

        Route::post("order", [SliderController::class, "orderChangeHandler"])->name("orderChangeHandler");
        Route::post("status", [SliderController::class, "statusChangeHandler"])->name("statusChangeHandler");

        Route::post("archive/status", [SliderController::class, "statusArchiveChangeHandler"])->name("statusArchiveChangeHandler");
        Route::post("archive/order", [SliderController::class, "orderArchiveChangeHandler"])->name("orderArchiveChangeHandler");

        Route::delete("archive/delete/{id}", [SliderController::class, "archiveDelete"])->name("archiveDelete")->whereNumber("id");
        Route::post("archive/restore/{id}", [SliderController::class, "archiveRestore"])->name("archiveRestore")->whereNumber("id");


        Route::post("{id}/delete-image", [SliderController::class, "deleteImage"])->name("deleteImage")->whereNumber("id");
    });
    Route::resource("slider", SliderController::class);
    // Slider Route End


    // Page Route Start
    Route::group(['prefix' => 'page', 'as' => 'page.'], function () {
        Route::get("archive", [PageController::class, "archive"])->name("archive");

        Route::post("order", [PageController::class, "orderChangeHandler"])->name("orderChangeHandler");
        Route::post("status", [PageController::class, "statusChangeHandler"])->name("statusChangeHandler");

        Route::post("archive/status", [PageController::class, "statusArchiveChangeHandler"])->name("statusArchiveChangeHandler");
        Route::post("archive/order", [PageController::class, "orderArchiveChangeHandler"])->name("orderArchiveChangeHandler");

        Route::delete("archive/delete/{id}", [PageController::class, "archiveDelete"])->name("archiveDelete")->whereNumber("id");
        Route::post("archive/restore/{id}", [PageController::class, "archiveRestore"])->name("archiveRestore")->whereNumber("id");


        Route::post("{id}/delete-image", [PageController::class, "deleteImage"])->name("deleteImage")->whereNumber("id");
    });
    Route::resource("page", PageController::class);
    // Page Route End



    // Blogs Route Start
    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
        Route::get("archive", [BlogController::class, "archive"])->name("archive");

        Route::post("order", [BlogController::class, "orderChangeHandler"])->name("orderChangeHandler");
        Route::post("status", [BlogController::class, "statusChangeHandler"])->name("statusChangeHandler");

        Route::post("archive/status", [BlogController::class, "statusArchiveChangeHandler"])->name("statusArchiveChangeHandler");
        Route::post("archive/order", [BlogController::class, "orderArchiveChangeHandler"])->name("orderArchiveChangeHandler");

        Route::delete("archive/delete/{id}", [BlogController::class, "archiveDelete"])->name("archiveDelete")->whereNumber("id");
        Route::post("archive/restore/{id}", [BlogController::class, "archiveRestore"])->name("archiveRestore")->whereNumber("id");


        Route::post("{id}/delete-image", [BlogController::class, "deleteImage"])->name("deleteImage")->whereNumber("id");


        Route::delete("category/delete/{id}", [CategoryController::class, "destroy"])->name("categoryDelete")->whereNumber("id");
        Route::patch("category/update/{id}", [CategoryController::class, "update"])->name("categoryUpdate")->whereNumber("id");
    });
    Route::resource("blog", BlogController::class);
    Route::resource("category", CategoryController::class);
    // Blogs Route End




    // Settings Route Start
    Route::resource("settings", SettingController::class);
    // Settings Route End



});
