<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\backend\ProductController;
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

Route::get('/', function () {
    return view('frontend.index');
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(AdminController::class)->group(function(){

        Route::get('/admin/dashboard','dashboard')->name('admin.dashboard');
        Route::get('/admin/profile/setup','profileSetup')->name('admin.profile.setup');
        Route::post('admin/profile/store','adminProfileStore')->name('admin.profile.store');
        Route::get('/admin/logout','adminLogout')->name('admin.logout');
        Route::get('/admin/add/agency','addAgency')->name('add.agency');
        Route::get('/edit/agency','adminLogout')->name('edit.agency');
        Route::get('/delete/agency','adminLogout')->name('delete.agency');
        Route::get('/admin/all/agencies','adminAllAgencies')->name('admin.all.agencies.display');
    });
});
Route::middleware(['auth','role:agency'])->group(function(){
    Route::controller(AgencyController::class)->group(function(){

        Route::get('/agency/dashboard','dashboard')->name('agency.dashboard');
    });
    
    
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/products','allProducts')->name('agency.all.products');
        Route::get('/add/product','addProduct')->name('agency.add.product');
        Route::post('/store/product','storeProduct')->name('store.product');

});
});





Route::get('/dashboard', function () {
    return view('frontend.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
