<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminOperations\RatingController\RatingController;
use App\Http\Controllers\Backend\AdminOperations\Brands\BrandController;
use App\Http\Controllers\Backend\AdminOperations\Banners\BannerController;
use App\Http\Controllers\Backend\AdminOperations\Filters\FilterController;
use App\Http\Controllers\Backend\AdminOperations\Sections\SectionController;
use App\Http\Controllers\Backend\AdminOperations\Categories\CategoryController;
use App\Http\Controllers\Backend\AdminOperations\AdminController\AdminController;
use App\Http\Controllers\Backend\AdminOperations\AdminOrders\AdminOrderController;

use App\Http\Controllers\Backend\AdminOperations\AdminCoupons\AdminCouponController;
use App\Http\Controllers\Backend\AdminOperations\AdminProducts\AdminProductController;
use App\Http\Controllers\Backend\AdminOperations\ShippingCharges\ShippingChargeController;
use App\Http\Controllers\Backend\AdminOperations\AdminAuthenticationSystem\AdminAuthenticationController;

/*
|--------------------------------------------------------------------------
| Admin Routes
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


// Auth::routes(['verify' => true]);
// Auth::routes();

Route::group(['middleware' => 'admin.guest', 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('login', [AdminAuthenticationController::class, 'login'])->name('login');
    Route::get('register', [AdminAuthenticationController::class, 'register'])->name('register');
    Route::post('register', [AdminAuthenticationController::class, 'store'])->name('store');
    Route::post('login', [AdminAuthenticationController::class, 'check'])->name('authenticate');
});

Route::group(['middleware' => 'admin.auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {

    // Admin Dashboard //
    Route::post('logout', [AdminAuthenticationController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    //-------------------//

    //Admin Role Routes//
    Route::match(['get','post'],'admin-role/{id}', [AdminController::class,'updateAdminRole'])->name('admin-role');

    // Seller Operation //
    Route::get('all-sellers', [AdminController::class, 'allSellers'])->name('all-sellers');
    Route::get('view-seller-details/{id}', [AdminController::class, 'viewSellerDetails'])->name('view_seller_details');
    Route::post('update-sellers-status', [AdminController::class, 'update_sellers_status']);
    Route::get('delete-seller/{id}', [AdminController::class, 'delete_seller'])->name('delete_seller');
    Route::get('approve-seller/{id}', [AdminController::class, 'approve_seller'])->name('approve_seller');
    Route::delete('delete-sellers', [AdminController::class, 'deleteAllSellers'])->name('bulk-delete-sellers');
    Route::post('update-sellers-comissions', [AdminController::class, 'update_sellers_comisions'])->name('seller-comissions');
    //-------------------//

    // User Operation //
    Route::get('all-users', [AdminController::class, 'allUsers'])->name('all-users');
    Route::post('update-users-status', [AdminController::class, 'update_users_status']);
    Route::get('delete-user/{id}', [AdminController::class, 'delete_user'])->name('delete_user');
    Route::delete('delete-users', [AdminController::class, 'deleteAllUsers'])->name('bulk-delete-users');
    //-------------------//

    



    // Section Operation //

    Route::get('section-index', [SectionController::class, 'section_index'])->name('section_index');
    Route::match(['get', 'post'], 'add-edit-sections/{id?}', [SectionController::class, 'Add_Edit_Sections'])->name('section_store');
    Route::post('delete-section/{id}', [SectionController::class, 'delete_section'])->name('delete_section');
    Route::post('update-section-status', [SectionController::class, 'updatesectionstatus']);
    Route::delete('delete-section', [SectionController::class, 'deleteAllSection'])->name('bulk-delete-section');


    //---------------------//




    // Brand Operation //

    Route::get('brands-index', [BrandController::class, 'brand_index'])->name('brand_index');
    Route::match(['get', 'post'], 'add-edit-brands/{id?}', [BrandController::class, 'Add_Edit_Brand'])->name('brand_store');
    Route::post('delete-brand/{id}', [BrandController::class, 'delete_brand'])->name('delete_brand');
    Route::post('update-brand-status', [BrandController::class, 'updatebrandstatus']);
    Route::post('update-brand-popular', [BrandController::class, 'updatebrandpopular']);
    Route::delete('deleteallbrand', [BrandController::class, 'deleteallbrand'])->name('bulk-delete-brands');




    //----------------------//



    // Category Operation //

    Route::get('category-index', [CategoryController::class, 'category_index'])->name('category_index');
    Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'Add_Edit_Categories'])->name('category_store');
    Route::post('delete-category/{id}', [CategoryController::class, 'delete_category'])->name('delete_category');
    Route::post('update-category-status', [CategoryController::class, 'updatecategorystatus']);
    Route::post('update-category-popular', [CategoryController::class, 'updatecategorypopular']);
    Route::get('append-categories-level', [CategoryController::class, 'appendCategoryLevel']);
    Route::delete('deleteallcategories', [CategoryController::class, 'deleteallcategories'])->name('bulk-delete-categories');


    //---------------------//


    // Banner Operation //
    Route::get('banner-index', [BannerController::class, 'banner_index'])->name('banner_index');
    Route::match(['get', 'post'], 'add-edit-banners/{id?}', [BannerController::class, 'Add_Edit_Banners'])->name('banner_store');
    Route::post('delete-banner/{id}', [BannerController::class, 'delete_banner'])->name('delete_banner');
    Route::post('update-banner-status', [BannerController::class, 'updatebannerstatus']);
    Route::delete('deleteallbanners', [BannerController::class, 'deleteallbanners'])->name('bulk-delete-banners');

    // ----------------------------//



    // Filter Operation //
    Route::get('filter-index', [FilterController::class, 'filter_index'])->name('filter_index');
    Route::get('filter-value-index', [FilterController::class, 'filter_values_index'])->name('filter_values_index');
    Route::match(['get', 'post'], 'add-edit-filter/{id?}', [FilterController::class, 'Add_Edit_Filter'])->name('filter_store');
    Route::match(['get', 'post'], 'add-edit-filter-values/{id?}', [FilterController::class, 'Add_Edit_Filter_Values'])->name('filter_values_store');
    Route::post('delete-filter/{id}', [FilterController::class, 'delete_filter'])->name('delete_filter');
    Route::delete('deleteallfilter', [FilterController::class, 'deleteallfilter'])->name('bulk-delete-filters');
    Route::post('delete-filter-values/{id}', [FilterController::class, 'delete_filter_values'])->name('delete_filter_values');
    Route::delete('deleteallfiltervalues', [FilterController::class, 'deleteallfiltervalues'])->name('bulk-delete-filters-values');

    Route::post('update-filter-status', [FilterController::class, 'updatefiterstatus']);
    Route::post('update-filter-value-status', [FilterController::class, 'updatefiltervaluestatus']);
    //---------------------------------//



    // Products Operation //
    Route::get('product-index', [AdminProductController::class, 'product_index'])->name('product_index');

    Route::match(['get', 'post'], 'add-edit-products/{id?}', [AdminProductController::class, 'Add_Edit_product'])->name('product_store');

    Route::post('delete-product/{id}', [AdminProductController::class, 'delete_product'])->name('delete_product');

    Route::post('update-product-status', [AdminProductController::class, 'updateproductstatus']);
    Route::post('category-filters', [FilterController::class, 'categoryFilters']);
    Route::match(['get', 'post'], 'add-edit-attributes/{id}', [AdminProductController::class, 'Add_Edit_Attributes'])->name('add_edit_attributes'); //ADD_EDIT IN ONE TEMPLATE URL //
    Route::post('update-attribute-status', [AdminProductController::class, 'updateattributestatus']);
    Route::post('edit-attributes/{id}', [AdminProductController::class, 'editattributes'])->name('edit_attributes');
    Route::post('delete-attribute/{id}', [AdminProductController::class, 'delete_attribute'])->name('delete_attribute');
    Route::delete('deleteallproducts', [AdminProductController::class, 'deleteallproducts'])->name('bulk-delete-products');
    Route::delete('deleteallattributes', [AdminProductController::class, 'deleteallattributes'])->name('bulk-delete-attributes');
    // Route::post('delete-attribute/{id}', [AdminProductController::class, 'delete_attribute'])->name('delete_attribute');

    Route::post('category-filter',[FilterController::class, 'categoryFilters']);




    //---------------------//

    //Multiple Images//
    Route::match(['get', 'post'], 'add-multiple-images/{id}', [AdminProductController::class, 'AddMultipleImages'])->name('add_multiple_images');
    Route::post('update-multiple-images-status', [AdminProductController::class, 'updatemultipleimagesstatus']);
    Route::post('delete-multiple-images/{id}', [AdminProductController::class, 'delete_multiple_images'])->name('delete_multiple_images');


    //-----------------------//

    // Coupons Routes //
    Route::get('coupons-index', [AdminCouponController::class, 'coupon_index'])->name('coupon_index');
    Route::match(['get', 'post'], 'add-edit-coupons/{id?}', [AdminCouponController::class, 'Add_Edit_Coupons'])->name('coupon_store');

    Route::post('delete-coupons/{id}', [AdminCouponController::class, 'delete_coupons'])->name('delete_coupons');
    Route::post('update-coupons-status', [AdminCouponController::class, 'updatecouponstatus']);
    Route::delete('deleteallcoupons', [AdminCouponController::class, 'deleteallcoupons'])->name('bulk-delete-coupons');

    //Orders //
    Route::get('orders', [AdminOrderController::class, 'orders'])->name('orders');
    Route::get('orders/{id}', [AdminOrderController::class, 'orderDetails'])->name('order-details');
    Route::post('update-order-status', [AdminOrderController::class, 'updateOrderStatus'])->name('update-order-status');
    Route::post('update-item-order-status', [AdminOrderController::class, 'updateOrderItemStatus'])->name('update-order-item-status');

    //Return/Exchange Request //
    Route::get('return-requests',[AdminOrderController::class,'returnRequests'])->name('return-requests');
    Route::post('return-requests/update',[AdminOrderController::class,'returnRequestsUpdate'])->name('return-requests-update');
    Route::get('exchange-requests',[AdminOrderController::class,'exchangeRequests'])->name('exchange-requests');
    Route::post('exchange-requests/update',[AdminOrderController::class,'exchangeRequestsUpdate'])->name('exchange-requests-update');

    //Order Invoice //
    Route::get('order/inovice/{id}', [AdminOrderController::class, 'viewOrderInvoice'])->name('order_invoice');
    Route::get('order/inovice/pdf/{id}', [AdminOrderController::class, 'viewOrderPdfInvoice'])->name('pdf_order_invoice');


    //Rating And Reviews//
    Route::get('rating',[RatingController::class,'rating_index'])->name('rating_index');
    
    Route::post('update-rating-status',[RatingController::class,'updateratingstatus']);
    //Shipping Charges operation//

    Route::get('shipping-charges-index', [ShippingChargeController::class, 'shippingchargeindex'])->name('shipping-charges');
    Route::match(['get', 'post'], 'add-edit-shipping-charges/{id}', [ShippingChargeController::class, 'AddEditShippingChargesImages'])->name('add-edit-shipping-charges');
    Route::post('update-shipping-charge-status', [ShippingChargeController::class, 'updateShippingChargestatus']);
    Route::post('delete-charge/{id}', [ShippingChargeController::class, 'delete_shipping_charge'])->name('delete_charge');

    // All Admin Relates Details //
    Route::match(['get', 'post'], 'add_edit_all_admin_details/{id?}', [AdminController::class, 'add_edit_All_Admin_Details'])->name('add_edit_all_admin_details');
    // Route::get('{type?}', [AdminController::class, 'admins'])->name('all_admins');
    Route::get('all-admins', [AdminController::class, 'admins'])->name('all_admins');
    Route::post('update-admins-status', [AdminController::class, 'update_all_admins_status']);
    Route::post('delete-admins/{id}', [AdminController::class, 'delete_admins'])->name('delete_admins');
    Route::match(['get','post'],'update-role/{id}', [AdminController::class, 'updateAdminRole'])->name('update-role');
});
