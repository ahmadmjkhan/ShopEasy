<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserOperations\UserController;
use App\Http\Controllers\Frontend\CartsController\CartController;
use App\Http\Controllers\Frontend\FrontendController\FrontendController;
use App\Http\Controllers\Frontend\PaymentMethodControllers\Paypal\PaypalController;
use App\Http\Controllers\Frontend\PaymentMethodControllers\RazorPay\RazorPayController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Fetch data of products based on category and sub category-wise //
$caturl = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
foreach ($caturl as $key => $url) {
  Route::match(['get', 'post'], '/' . $url, [FrontendController::class, 'productlisting']);
}
Route::get('/product-detail/{id}', [FrontendController::class, 'product_details_page'])->name('product_details');

Route::get('/quick-view/{id}', [FrontendController::class, 'quickmodalview'])->name('product_show');

Route::post('/get-attribute-price', [FrontendController::class, 'getAttributePrice']);
Route::get('/search-products',[FrontendController::class,'productlisting']);



Route::group(['middleware' => 'guest:web'], function () {
  //index page without Login //
  Route::get('/', [FrontendController::class, 'index'])->name('index');

  Route::get('/search-products',[FrontendController::class,'productlisting']);

 

  //Register user//
  Route::match(['get', 'post'], 'register-user', [UserController::class, 'UserRegister'])->name('user-register');

  //Login User //
  Route::post('check', [UserController::class, 'check'])->name('check-user');

  //confirm User Account //
  Route::get('/confirm/{code}', [UserController::class, 'confirm_account']);

  //User Forgot Password//
  Route::match(['get', 'post'], '/forgot-password', [UserController::class, 'forgot_password'])->name('forgot-password');
});


Route::group(['middleware' => 'auth:web', 'prefix' => 'user', 'as' => 'user.'], function () {
  //index page when user loggedin //
  Route::get('home', [FrontendController::class, 'index'])->name('home');
  
  Route::get('/search-products',[FrontendController::class,'productlisting']);

  // user My account section //
  Route::match(['get', 'post'], 'my-account', [UserController::class, 'userMyAccount'])->name('my-account');

  // Update user Password //
  Route::post('update-password', [UserController::class, 'updateUserPassword'])->name('update-password');

  // logout user //
  Route::post('logout', [UserController::class, 'logout'])->name('logout');

  //Cart Operation //

  Route::post('cart/Add', [CartController::class, 'cartAdd'])->name('cart_add');
  Route::get('shop-cart', [CartController::class, 'shopCartPage'])->name('shop_cart_page');
  Route::post('delete-cart-item', [CartController::class, 'delete_item'])->name('cart.delete');
  Route::get('load-cart-data', [CartController::class, 'cart_count'])->name('cart.count');
  Route::post('cart-update', [CartController::class, 'cartUpdate'])->name('cart.update');

  //Check Pincode//
  Route::post('check-pincode',[FrontendController::class,'checkPincode'])->name('checkPincode');
  // checkout Page //
  Route::match(['get', 'post'], 'checkout-page', [CartController::class, 'checkout_page'])->name('checkout-page');

  // Get Delivery Address //
  Route::post('get-delivery-address', [CartController::class, 'getDeliveryAddress']);
  Route::post('save-delivery-address', [CartController::class, 'saveDeliveryAddress']);
  Route::post('remove-delivery-address', [CartController::class, 'removeDeliveryAddress']);

  //Thanks Page //
  Route::get('thanks', [CartController::class, 'thanks']);

  // Show user Orders on user page //
  Route::get('your-orders/{id?}', [CartController::class, 'orders'])->name('your-orders');


  Route::post('apply-coupon', [FrontendController::class, 'applyCoupon']);

  //Paypal Routes//
  Route::get('paypal',[PaypalController::class,'paypal'])->name('paypal');
  Route::post('paypal',[PaypalController::class,'pay'])->name('pay');
  Route::get('success',[PaypalController::class,'success'])->name('success');
  Route::get('error',[PaypalController::class,'error'])->name('error');

  //RazorPay Routes //
  Route::get('/payment', [RazorPayController::class, 'showPaymentForm'])->name('razorpay');
Route::post('/pay', [RazorPayController::class, 'makePayment'])->name('payment.makePayment');
Route::post('/payment/success', [RazorPayController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/thanks-success', [RazorPayController::class, 'thanks_success'])->name('payment.success.thanks');
Route::get('/payment/failure', [RazorPayController::class, 'paymentFailure'])->name('payment.failure');


  //Wishlist Routes//
  Route::get('wishlist',[FrontendController::class,'wishlist'])->name('wishlist');
  Route::post('update-wishlist',[FrontendController::class,'updateWishlist'])->name('update-wishlist');
  Route::post('delete-wishlist-item',[FrontendController::class,'deleteWishlistItem'])->name('delete-wishlist');

  //Cancel Order Routes//
  Route::match(['get','post'],'/your-orders/{id}/cancel',[CartController::class,'orderCancel'])->name('orderCancel');

  Route::match(['get','post'],'/your-orders/{id}/return',[CartController::class,'orderReturn'])->name('orderReturn');
  Route::post('/get-product-sizes',[CartController::class,'getProductSizes'])->name('getProductSizes');

 //Rating Routes//
  Route::match(['get','post'],'add-rating',[FrontendController::class,'addRating'])->name('add-rating');;
  
});