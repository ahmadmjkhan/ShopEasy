<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminOperations\Filters\FilterController;
use App\Http\Controllers\Backend\SellerOperations\SellerDetails\SellerController;
use App\Http\Controllers\Backend\SellerOperations\SellerOrders\SellerOrderController;
use App\Http\Controllers\Backend\SellerOperations\SellerCoupons\SellerCouponController;
use App\Http\Controllers\Backend\SellerOperations\SellerProducts\SellerProductController;
use App\Http\Controllers\Backend\SellerOperations\SellerAuthenticationSystem\SellerAuthenticationController;

/*
|--------------------------------------------------------------------------
| Seller Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });




Route::group(['middleware' => 'seller.guest', 'prefix' => 'seller', 'as' => 'seller.'], function () {

    // Seller registration //
    Route::get('login', [SellerAuthenticationController::class, 'login'])->name('login');
    Route::get('register', [SellerAuthenticationController::class, 'register'])->name('register');
    Route::post('register', [SellerAuthenticationController::class, 'store'])->name('store');
    Route::post('login', [SellerAuthenticationController::class, 'check'])->name('check');
    //------------------------//

    // Seller Forgot Password //
    Route::match(['get', 'post'], 'forgot-password', [SellerAuthenticationController::class, 'sellerForgotPassword'])->name('forgot-password');
    //--------------------------//

    //Confirm Vendor Account//
    Route::get('confirm/{code}', [SellerAuthenticationController::class, 'confirmSellerAccount']);
    //-------------------------//
});

Route::group(['middleware' => 'seller.auth', 'prefix' => 'seller', 'as' => 'seller.'], function () {

    // During First Time Registration process //
    Route::get('personal-details', [SellerController::class, 'PersonalDetails'])->name('all-personal-details');
    Route::post('personal-details-store', [SellerController::class, 'personalDetails'])->name('personal-details-store');
    Route::get('bussiness-details', [SellerController::class, 'BussinessDetails'])->name('all-bussiness-details');
    Route::post('bussiness-details-store', [SellerController::class, 'BussinessDetails'])->name('bussiness-details-store');
    Route::get('bank-details', [SellerController::class, 'BankDetails'])->name('all-bank-details');
    Route::post('bank-details-store', [SellerController::class, 'BankDetails'])->name('bank-details-store');

    //--------------------------------------------------//

    // Update data of seller from profile //
    // Route::post('personal-details-store', [SellerController::class, 'personalProfileDetails'])->name('personal-details-update');
    // Route::post('bussiness-details-store', [SellerController::class, 'BussinessProfileDetails'])->name('bussiness-details-update');
    // Route::post('bank-details-store', [SellerController::class, 'BankProfileDetails'])->name('bank-details-update');


    // Seller Dashboard ////

    Route::get('dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
    Route::match(['get', 'post'], 'profile', [SellerController::class, 'updateSellerProfile'])->name('profile');
    Route::match(['get', 'post'], 'change-password', [SellerAuthenticationController::class, 'UpdateSellerPassword'])->name('change-password');
    Route::match(['get', 'post'], 'logout', [SellerAuthenticationController::class, 'logout'])->name('logout');

    //---------------------------------------------------//



    // Product Operation //
    Route::get('products-index', [SellerProductController::class, 'products_index'])->name('product_index');
    Route::match(['get', 'post'], 'add_edit_products/{id?}', [SellerProductController::class, 'add_edit_Products'])->name('add-edit-products');
    Route::post('category-filters', [FilterController::class, 'categoryFilters']);
    Route::post('delete-product/{id}', [SellerProductController::class, 'delete_product'])->name('delete_product');

    //---------------------------------------------------//

    // Products Attributes Operation //
    Route::match(['get', 'post'], 'add-edit-attributes/{id}', [SellerProductController::class, 'Add_Edit_Attributes'])->name('add_edit_attributes'); //ADD_EDIT IN ONE TEMPLATE URL //
    Route::post('update-attribute-status', [SellerProductController::class, 'updateattributestatus']);
    Route::post('edit-attributes/{id}', [SellerProductController::class, 'editattributes'])->name('edit_attributes');
    // Route::post('delete-attribute/{id}', [SellerProductController::class, 'delete_attribute'])->name('delete_attribute');

    //---------------------------------------------------//


    //Multiple Images//
    Route::match(['get', 'post'], 'add-multiple-images/{id}', [SellerProductController::class, 'AddMultipleImages'])->name('add_multiple_images');
    Route::post('update-multiple-images-status', [SellerProductController::class, 'updatemultipleimagesstatus']);
    Route::post('delete-multiple-images/{id}', [SellerProductController::class, 'delete_multiple_images'])->name('delete_multiple_images');

    //---------------------------------------------------//


    // Coupons Routes //

    Route::get('coupons-index', [SellerCouponController::class, 'coupon_index'])->name('seller_coupon_index');
    Route::match(['get', 'post'], 'add-edit-coupons/{id?}', [SellerCouponController::class, 'Add_Edit_Coupons'])->name('seller_coupon_store');

    Route::post('delete-coupons/{id}', [SellerCouponController::class, 'delete_coupons'])->name('seller_delete_coupons');
    Route::post('update-coupons-status', [SellerCouponController::class, 'updatecouponstatus']);

    //Orders //
    Route::get('orders', [SellerOrderController::class, 'orders'])->name('orders');
    Route::get('seller-orders/{id}', [SellerOrderController::class, 'orderSellerDetails'])->name('order-seller-details');
    Route::post('update-item-order-status', [SellerOrderController::class, 'updateOrderItemStatus'])->name('update-order-item-status');
});
