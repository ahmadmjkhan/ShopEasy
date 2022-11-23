<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontend\FrontendController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/quick-view/{id}', [FrontendController::class, 'quickmodalview'])->name('product_show');

$caturl = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
foreach ($caturl as $key => $url) {
    Route::match(['get', 'post'], '/' . $url, [FrontendController::class, 'productlisting']);
}
Route::get('/product-detail/{id}', [FrontendController::class, 'product_details_page'])->name('product_deatail');


Route::post('/get-attribute-price',[FrontendController::class,'getAttributePrice']);

// User Route //
Route::prefix('user')->name('user.')->group(function () {

    Route::middleware(['guest:web'])->group(function () {


        Route::get('/register-page', [FrontendController::class, 'register_page'])->name('register_index');
        Route::post('/register', [FrontendController::class, 'create'])->name('create');
        Route::post('/check', [FrontendController::class, 'check'])->name('check');
      
        
    });


    Route::middleware(['auth:web'])->group(function () {
        Route::get('/home', [FrontendController::class, 'index'])->name('home');
        Route::post('/logout', [FrontendController::class, 'logout'])->name('logout');

        //Cart Operation //

        Route::post('cart/Add',[CartController::class,'cartAdd'])->name('cart_add');
        Route::get('shop-cart',[CartController::class,'shopCartPage'])->name('shop_cart_page');
        Route::post('delete-cart-item',[CartController::class,'delete_item'])->name('cart.delete');
        Route::get('load-cart-data',[CartController::class,'cart_count'])->name('cart.count');
        Route::post('cart-update',[CartController::class,'cartUpdate'])->name('cart.update');
    });
});


// Admin Route //
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin'])->group(function () {

        Route::get('/login', [AdminController::class, 'login_index'])->name('login');
        Route::get('/register', [AdminController::class, 'register_index'])->name('register');
        Route::post('/register', [AdminController::class, 'create'])->name('create');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
        Route::match(['get', 'post'], 'forgot-admin-password', [AdminController::class, 'ForgotPasswordCreate'])->name('forgot_password_create');
    });


    Route::middleware(['auth:admin'])->group(function () {
        Route::get('index', [AdminController::class, 'index'])->name('home');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::match(['get', 'post'], 'update-admin-password', [AdminController::class, 'UpdateAdminPassword'])->name('update-password');
        Route::match(['get', 'post'], 'update-admin-details', [AdminController::class, 'UpdateAdminDetails'])->name('update-details');

        Route::get('all-seller', [AdminController::class, 'Seller_details'])->name('seller_index');
        Route::post('update-sellers-status', [AdminController::class, 'update_sellers_status']);
        Route::get('all-users', [AdminController::class, 'User_details'])->name('user_index');
        Route::post('update-users-status', [AdminController::class, 'update_users_status']);
        

        // Banner Operation //
        Route::get('banner-index', [BannerController::class, 'banner_index'])->name('banner_index');
        Route::match(['get', 'post'], 'add-edit-banners/{id?}', [BannerController::class, 'Add_Edit_Banners'])->name('banner_store');
        Route::post('delete-banner/{id}', [BannerController::class, 'delete_banner'])->name('delete_banner');
        Route::post('update-banner-status', [BannerController::class, 'updatebannerstatus']);

        // Section Operation //
        Route::get('section-index', [SectionController::class, 'section_index'])->name('section_index');
        Route::match(['get', 'post'], 'add-edit-sections/{id?}', [SectionController::class, 'Add_Edit_Sections'])->name('section_store');
        Route::post('delete-section/{id}', [SectionController::class, 'delete_section'])->name('delete_section');
        Route::post('update-section-status', [SectionController::class, 'updatesectionstatus']);

        // Category Operation //
        Route::get('category-index', [CategoryController::class, 'category_index'])->name('category_index');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'Add_Edit_Categories'])->name('category_store');
        Route::post('delete-category/{id}', [CategoryController::class, 'delete_category'])->name('delete_category');
        Route::post('update-category-status', [CategoryController::class, 'updatecategorystatus']);
        Route::post('update-category-popular', [CategoryController::class, 'updatecategorypopular']);
        Route::get('append-categories-level', [CategoryController::class, 'appendCategoryLevel']);

        // Brand Operation //
        Route::get('brand-index', [BrandsController::class, 'brand_index'])->name('brand_index');
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', [BrandsController::class, 'Add_Edit_Brands'])->name('brand_store');
        Route::post('delete-brand/{id}', [BrandsController::class, 'delete_brand'])->name('delete_brand');
        Route::post('update-brand-status', [BrandsController::class, 'updatebrandstatus']);
        Route::post('update-brand-popular', [BrandsController::class, 'updatebrandpopular']);

        // Filter Operation //
        Route::get('filter-index', [FilterController::class, 'filter_index'])->name('filter_index');
        Route::get('filter-value-index', [FilterController::class, 'filter_values_index'])->name('filter_values_index');
        Route::match(['get', 'post'], 'add-edit-filter/{id?}', [FilterController::class, 'Add_Edit_Filter'])->name('filter_store');
        Route::match(['get', 'post'], 'add-edit-filter-values/{id?}', [FilterController::class, 'Add_Edit_Filter_Values'])->name('filter_values_store');
        Route::post('delete-filter/{id}', [FilterController::class, 'delete_filter'])->name('delete_filter');
        Route::post('delete-filter-values/{id}', [FilterController::class, 'delete_filter_values'])->name('delete_filter_values');
        Route::post('update-filter-status', [FilterController::class, 'updatefiterstatus']);
        Route::post('update-filter-value-status', [FilterController::class, 'updatefiltervaluestatus']);

        // Products Operation //
        Route::get('product-index', [ProductsController::class, 'product_index'])->name('product_index');

        Route::match(['get', 'post'], 'add-edit-products/{id?}', [ProductsController::class, 'Add_Edit_product'])->name('product_store');

        Route::post('delete-product/{id}', [ProductsController::class, 'delete_product'])->name('delete_product');

        Route::post('update-product-status', [ProductsController::class, 'updatefiterstatus']);
        Route::post('category-filters', [FilterController::class, 'categoryFilters']);
        Route::match(['get', 'post'], 'add-edit-attributes/{id}', [ProductsController::class, 'Add_Edit_Attributes'])->name('add_edit_attributes'); //ADD_EDIT IN ONE TEMPLATE URL //
        Route::post('update-attribute-status', [ProductsController::class, 'updateattributestatus']);
        Route::post('edit-attributes/{id}', [ProductsController::class, 'editattributes'])->name('edit_attributes');

        //Multiple Images//
        Route::match(['get', 'post'], 'add-multiple-images/{id}', [ProductsController::class, 'AddMultipleImages'])->name('add_multiple_images');
        Route::post('update-multiple-images-status', [ProductsController::class, 'updatemultipleimagesstatus']);


        // All Admin Relates Details //
        Route::match(['get', 'post'], 'add_edit_all_admin_details/{id?}', [AdminController::class, 'add_edit_All_Admin_Details'])->name('add_edit_all_admin_details');
        Route::get('{type?}', [AdminController::class, 'admins'])->name('all_admins');
        Route::post('update-admins-status', [AdminController::class, 'update_all_admins_status']);
        Route::post('delete-admins/{id}', [AdminController::class, 'delete_admins'])->name('delete_admins');
    });
});


// Seller Route //
Route::prefix('seller')->name('seller.')->group(function () {

    Route::middleware(['guest:seller'])->group(function () {

        Route::get('/login', [SellerController::class, 'login_index'])->name('login');
        Route::get('/register', [SellerController::class, 'register_index'])->name('register');
        Route::post('/register', [SellerController::class, 'create'])->name('create');
        Route::post('/check', [SellerController::class, 'check'])->name('check');
    });


    Route::middleware(['auth:seller'])->group(function () {
        Route::get('products-index',[SellerController::class,'products_index'])->name('index');
        Route::match(['get', 'post'], 'add_edit_products/{id?}', [SellerController::class, 'add_edit_Products'])->name('add-edit-products');
        Route::post('category-filters', [FilterController::class, 'categoryFilters']);
        Route::post('delete-product/{id}', [SellerController::class, 'delete_product'])->name('delete_product');
        Route::match(['get', 'post'], 'update-seller-password', [SellerController::class, 'UpdateSellerPassword'])->name('update-password');
        Route::match(['get', 'post'], 'update-seller-details', [SellerController::class, 'UpdateSellerDetails'])->name('update-details');
        Route::match(['get', 'post'], 'update-seller-bank-details/{id?}', [SellerController::class, 'AddSellerBankDetails'])->name('update-bank-details');
        Route::match(['get', 'post'], 'update-seller-bussiness-details/{id?}', [SellerController::class, 'AddSellerBussinessDetails'])->name('update-bussiness-details');

       
        

        Route::match(['get', 'post'], 'add-edit-attributes/{id}', [SellerController::class, 'Add_Edit_Attributes'])->name('add_edit_attributes'); //ADD_EDIT IN ONE TEMPLATE URL //
        Route::post('update-attribute-status', [SellerController::class, 'updateattributestatus']);
        Route::post('edit-attributes/{id}', [SellerController::class, 'editattributes'])->name('edit_attributes');

        //Multiple Images//
        Route::match(['get', 'post'], 'add-multiple-images/{id}', [SellerController::class, 'AddMultipleImages'])->name('add_multiple_images');
        Route::post('update-multiple-images-status', [SellerController::class, 'updatemultipleimagesstatus']);
        Route::post('delete-multiple-images/{id}', [SellerController::class, 'delete_multiple_images'])->name('delete_multiple_images');
       
        Route::get('sellerindex', [SellerController::class, 'seller_index'])->name('home');
        Route::post('/logout', [SellerController::class, 'logout'])->name('logout');

        
    });
});
