<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\frontend\TourController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

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


Route::get('/',[UserController::class,'dashboard']);

Route::get('/dashboard',[UserController::class,'dashboard'])->middleware(['auth', 'verified',"role:user"])->name('dashboard');

Route::controller(IndexController::class)->group(function(){
    Route::post("/product/search","ProductSearch")->name("product.search");
    Route::get("/view/tour/by/agency/{agency_id}","viewTourByAgency")->name("view.tour.by.agency");
});


/// admin middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {

        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
        Route::get('/admin/profile/setup', 'profileSetup')->name('admin.profile.setup');
        Route::post('admin/profile/store', 'adminProfileStore')->name('admin.profile.store');
        Route::get('/admin/logout', 'adminLogout')->name('admin.logout');
        Route::get('/admin/add/agency', 'addAgency')->name('add.agency');
        Route::get('/edit/agency', 'adminLogout')->name('edit.agency');
        Route::get('/delete/agency', 'adminLogout')->name('delete.agency');
        Route::get('/admin/all/agencies', 'adminAllAgencies')->name('admin.all.agencies.display');
    });
    //Category controller
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/categories', 'allCategories')->name('admin.all.categories');
        Route::get('/add/category', 'addCategory')->name('admin.add.category');
        Route::get('/edit/category', 'editCategory')->name('edit.category');
        Route::get('/delete/category', 'deleteCategory')->name('delete.category');
        Route::post('/store/category', 'storeCategory')->name('store.category');
    });
    //end


});
// Agency middleware
Route::middleware(['auth', 'role:agency'])->group(function () {
    //Agency controller
    Route::controller(AgencyController::class)->group(function () {
        Route::get('/agency/logout', "agencyLogout")->name('agency.logout');
        Route::get('/agency/dashboard', 'dashboard')->name('agency.dashboard');
    });
    //end






    //Product controller
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/products', 'allProducts')->name('agency.all.products');
        Route::get('/add/product', 'addProduct')->name('agency.add.product');
        Route::get('/edit/product/{id}', 'editProduct')->name('edit.product');
        Route::get('/delete/product/multiimg/{id}', 'deleteMultiImg')->name('product.multiimg.delete');
        Route::get('/delete/product/{id}', 'deleteProduct')->name('delete.product');
        Route::get('/all/joined/tours/agency','joinedTours')->name('agency.joined.tours');

        Route::get('/activate/product/{id}', 'productActive')->name('product.active');
        Route::get('/inactivate/product/{id}', 'productInactive')->name('product.inactive');

        Route::post('/store/product', 'storeProduct')->name('store.product');
        Route::post('/update/product', 'updateProduct')->name('update.product');
        Route::post('/update/product/multiimage', 'updateProductMultiImage')->name('update.product.multiimage');
        Route::post('/update/product/thumbnail', 'updateProductThambnail')->name('update.product.thambnail');
    });
    //end




});
// End Agency middleware






//user middleware
Route::middleware('auth')->group(function () {
    //Tour controller
    Route::controller(TourController::class)->group(function () {
        Route::post('/join/room', 'joinRoom')->name('join.tour');
        Route::post('/leave/room', 'leaveRoom')->name('leave.tour');
        Route::get('/get/all/tours', 'getTours')->name('get.all.tours');
        Route::get('/all/joined/tours', 'allJoinedTours')->name('all.joined.tours');
        Route::get('/view/single/tour/{id}/{slug}', 'getTour')->name('view.single.tour');
        Route::get('/view/specific/tours/{categoryid}', 'getSpecificTours')->name('view.specific.tours');
    });
    //end

    Route::get('/user/logout', [UserController::class, 'UserDestroy'])->name('user.logout');
    Route::get('/user/profile/setup', [UserController::class, 'userProfile'])->name('user.profile.setup');
    Route::post('/user/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users/login', [UserController::class, 'Login'])->name('all.login');
// ->middleware(RedirectIfAuthenticated::class);
Route::post('/user/login', [UserController::class, 'loginUser'])->name('login.user');
require __DIR__ . '/auth.php';
