<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;

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
//frontend
Route::get('/', [MyController::class, 'welcome'])->name('frontend.index');
Route::post('/getSize', [MyController::class, 'getSize']);
Route::get('/product/details/{product_id}', [MyController::class, 'product_details'])->name('product.details');





Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//user
Route::get('/user/delete/{user_id}', [HomeController::class,'delete'])->name('del');

//category
Route::get('/category',[CategoryController::class,'category'])->name('category.index');
Route::post('/category/insert',[CategoryController::class,'insert'])->name('insert');
Route::get('/category/delete/{category_id}',[CategoryController::class, 'delete'])->name('delete');
Route::get('/category/restore/{category_id}',[CategoryController::class, 'restore'])->name('restore');
Route::get('/category/force_delete/{category_id}',[CategoryController::class, 'force_delete'])->name('force_delete');
Route::get('/category/edit/{category_id}',[CategoryController::class, 'edit'])->name('edit');
Route::post('/category/update',[CategoryController::class,'update'])->name('update');
Route::post('/category/markdel',[CategoryController::class,'markdel'])->name('markdel');
Route::get('/category/markrestore/{category_id}',[CategoryController::class,'markrestore'])->name('markrestore');

//subcategory
Route::get('/subcategory',[SubcategoryController::class,'subcategory'])->name('subcategory.index');
Route::post('/subcategory/insert',[SubcategoryController::class,'insert'])->name('subcategory.insert');
Route::get('/subcategory/delete/{subcategory_id}',[SubcategoryController::class,'delete'])->name('subcategory.delete');
Route::get('/subcategory/edit/{subcategory_id}',[SubcategoryController::class,'edit'])->name('subcategory.edit');
Route::post('/subcategory/update',[SubcategoryController::class,'update'])->name('subcategory.update');

//dashboard
Route::get('/dashboard',[MyController::class,'dashboard'])->name('dashboard');

//profile
Route::get('/profile',[ProfileController::class,'profile'])->name('profile.index');
Route::post('/profile/change',[ProfileController::class,'profile_change'])->name('profile.change');

//product
Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::post('/getCategory',[ProductController::class,'ajax']);
Route::post('/product/insert',[ProductController::class,'insert']);
//inventory
Route::get('/product/inventory/{product_id}',[InventoryController::class,'index'])->name('inventory.index');
Route::post('/add/inventory',[InventoryController::class,'inventory']);
Route::get('/product/delete/{product_id}',[InventoryController::class,'delete'])->name('delete.index');
Route::get('/product/inventory/delete/{inventory_id}',[InventoryController::class,'delete_inventory'])->name('inventory.delete.index');



Route::get('/product/color',[InventoryController::class,'color'])->name('color.index');
Route::post('/add/color',[InventoryController::class,'add_color']);
Route::get('/product/size',[InventoryController::class,'size'])->name('size.index');
Route::post('/add/size',[InventoryController::class,'add_size']);

//customer info
Route::post('/customer/register',[CustomerRegisterController::class,'customer_register']);
Route::get('/customer_register',[CustomerRegisterController::class,'show_register_form'])->name('customer_register');

Route::post('/customer/login/',[CustomerLoginController::class,'customer_login']);
Route::get('/customer/account/',[AccountController::class,'account'])->name('account');
Route::get('/customer/logout/',[AccountController::class,'Customerlogout'])->name('Customerlogout');
Route::get('/customer/email/veirfy/{token}',[AccountController::class,'email_verify'])->name('verify.email');


//cart
Route::post('/cart/insert/',[CartController::class,'cart_insert'])->name('cart_insert');
Route::get('/cart/delete/{cart_id}',[CartController::class,'cart_delete'])->name('cart.delete');
Route::get('/cart',[CartController::class,'cart'])->name('cart');
Route::post('/cart/update',[CartController::class,'cart_update']);

//coupon
Route::get('/coupon',[CouponController::class,'coupon'])->name('Coupon');
Route::post('/coupon/insert',[CouponController::class,'coupon_insert']);
//checkout
Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::post('/getCities',[CheckoutController::class,'get_cities']);
Route::post('/order/placed',[CheckoutController::class,'order_insert']);
Route::get('/order/success',[CheckoutController::class,'order_success'])->name('order.success');


// SSLCOMMERZ Start
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


//stripe payment gateway
Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
//invoice
Route::get('invoice/download/{order_id}', [AccountController::class, 'invoice'])->name('invoice.download');
//customer password reset
Route::get('customer/password/reset/req', [AccountController::class, 'customer_password_reset_req'])->name('customer.password.reset.req');
Route::post('customer/password/reset/store', [AccountController::class, 'customer_password_reset_store'])->name('customer.password.reset.store');
Route::get('customer/password/reset/form/{token}', [AccountController::class, 'customer_password_reset_form'])->name('reset.password.form');
Route::post('customer/password/update', [AccountController::class, 'customer_password_update'])->name('pass_update');
//git hub
Route::get('/github/redirect',[GithubController::class, 'redirectToProvider']);
Route::get('/github/callback',[GithubController::class, 'handleProviderCallback']);
//git hub
Route::get('/google/redirect',[GoogleController::class, 'redirectToProvider']);
Route::get('/google/callback',[GoogleController::class, 'handleProviderCallback']);


//compare products
Route::post('/compare/product',[MyController::class, 'compare_products'])->name('compare.products');






