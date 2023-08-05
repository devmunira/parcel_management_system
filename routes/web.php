<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DeliverymanController;
use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\UserRoleController;
use App\Http\Controllers\Backend\AdminLoginController;
use App\Http\Controllers\Backend\AdminPasswordController;
use App\Http\Controllers\Backend\GeneralSettingsController;
use App\Http\Controllers\PDFController;

// Order View Route
Route::get('/order_invoice/{order_number}/{id}' , [OrderController::class , 'orderinvoice'])->name('order.view');

// Route::post('/print/{id}', function($id) {
//     return view('print' , compact('id'));
// });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/download/{id}' , [OrderController::class , 'download'])->name('download');
    Route::get('/print/{id}' , [OrderController::class , 'print'])->name('print');
    Route::get('/login' , [AdminLoginController::class , 'loginView']);
    Route::get('/email' , [AdminLoginController::class , 'emailView'])->name('email');
    Route::post('/email' ,  [AdminLoginController::class , 'codeSend'])->name('code');
    Route::get('/email/code' ,  [AdminLoginController::class , 'codeView'])->name('code.view');
    Route::get('/reset' ,  [AdminLoginController::class , 'resetView'])->name('reset.view');
    Route::post('/reset' ,  [AdminLoginController::class , 'resetPassword'])->name('reset');
    Route::post('/email/code/verify' ,  [AdminLoginController::class , 'codeVerify'])->name('code.verify');
    Route::post('/login' ,  [AdminLoginController::class , 'adminLogin'])->name('login');

    Route::middleware(['admin'])->group(function(){
        Route::get('/' , [BackendController::class, 'index'])->name('home');
        Route::get('/password/change' , [AdminPasswordController::class, 'passwordChangeView'])->name('password.change');
        Route::post('/password/update' , [AdminPasswordController::class, 'passwordChange'])->name('password.update');
        Route::get('/profile' , [AdminPasswordController::class, 'profile'])->name('profile');
        Route::post('/profile/update' , [AdminPasswordController::class, 'profileUpdate'])->name('profile.update');
        Route::post('/logout' ,  [AdminLoginController::class , 'logout'])->name('logout');
        Route::get('/our_backup_database', [GeneralSettingsController::class, 'our_backup_database'])->name('our_backup_database');
        Route::get('/signature', [GeneralSettingsController::class, 'signatureindex'])->name('signature');
        Route::post('/signaturestore', [GeneralSettingsController::class, 'signaturestore'])->name('signaturestore');
        Route::get('/cache-clear' , [GeneralSettingsController::class , 'cache'])->name('cache');




        Route::name('role.')->prefix('/user')->group(function(){
            Route::get('/' , [UserRoleController::class , 'index'])->name('index');
            Route::post('/' , [UserRoleController::class , 'store'])->name('store');
            Route::post('/delete' , [UserRoleController::class , 'destroy'])->name('delete');
            Route::get('/{id}' , [UserRoleController::class , 'edit'])->name('edit');
            Route::post('/update' , [UserRoleController::class , 'update'])->name('update');
        });

        Route::get('/report/search' , [OrderController::class , 'report'])->name('report.search');
        Route::get('/report/daily' , [OrderController::class , 'daily'])->name('report.index.daily');
        Route::get('/report' , [OrderController::class , 'reportindex'])->name('report.index');
        Route::get('/print_all' , [OrderController::class , 'printall'])->name('print.all.view');

        Route::name('delivery.man.')->prefix('/delivery_man')->group(function(){
            Route::get('/' , [DeliverymanController::class , 'index'])->name('index');
            Route::post('/' , [DeliverymanController::class , 'store'])->name('store');
            Route::post('/delete' , [DeliverymanController::class , 'destroy'])->name('delete');
            Route::get('/{id}' , [DeliverymanController::class , 'edit'])->name('edit');
            Route::post('/update' , [DeliverymanController::class , 'update'])->name('update');
        });

        Route::name('delivery.method.')->prefix('/delivery_method')->group(function(){
            Route::get('/' , [DeliveryMethodController::class , 'index'])->name('index');
            Route::post('/' , [DeliveryMethodController::class , 'store'])->name('store');
            Route::post('/delete' , [DeliveryMethodController::class , 'destroy'])->name('delete');
            Route::get('/{id}' , [DeliveryMethodController::class , 'edit'])->name('edit');
            Route::post('/update' , [DeliveryMethodController::class , 'update'])->name('update');
        });

        Route::name('order.')->prefix('/order')->group(function(){
            Route::get('/' , [OrderController::class , 'index'])->name('index');
            Route::get('/trash' , [OrderController::class , 'trash'])->name('trash.index');
            Route::get('/export' , [OrderController::class , 'export'])->name('export');
            Route::get('/csv' , [OrderController::class , 'csv'])->name('csv');
            Route::get('/export/trash' , [OrderController::class , 'exporttrash'])->name('trash.export');
            Route::get('/csv/trash' , [OrderController::class , 'csvtrash'])->name('trash.csv');
            Route::post('/forcedelete' , [OrderController::class , 'forcedelete'])->name('forcedelete');
            Route::post('/restore' , [OrderController::class , 'restore'])->name('restore');
            Route::get('/create' , [OrderController::class , 'create'])->name('create');
            Route::get('/search' , [OrderController::class , 'search'])->name('search');
            Route::get('/trash/search' , [OrderController::class , 'trashsearch'])->name('trash.search');
            Route::post('/' , [OrderController::class , 'store'])->name('store');
            Route::post('/delete' , [OrderController::class , 'destroy'])->name('delete');
            Route::get('/{id}' , [OrderController::class , 'edit'])->name('edit');
            Route::post('/status/{id}/{status}' , [OrderController::class , 'status'])->name('status');
            Route::post('/update' , [OrderController::class , 'update'])->name('update');
            Route::get('/phone/serach/{phone}' , [OrderController::class , 'phoneserch'])->name('phoneserch');
        });
    });
});

