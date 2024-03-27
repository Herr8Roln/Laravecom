<?php
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\GoogleController;
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


route::get('/', [HomeController::class,'index'])->name('/');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/redirect', [HomeController::class, 'redirect'])
    ->name('redirect')
    ->middleware(['auth', 'verified']);

});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Check for admin user based on 'usertype' attribute
    Route::group(['middleware' => function ($request, $next) {
        if (auth()->user()->usertype == 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }], function () {
        // Categories CRUD
        Route::resource('categories', CategoryController::class);
        Route::resource('/subcategories', SubcategoryController::class);
        Route::resource('users', UserController::class);


       // Products CRUD
        Route::resource('products', ProductController::class);
        // Order CRUD
        Route::resource('orders', OrderController::class);
        Route::put('/delivered/{id}', [OrderController::class, 'delivered'])->name('orders.delivered');
        Route::get('/print_pdf/{id}', [OrderController::class, 'print_pdf'])->name('print_pdf');
        Route::get('/send_email/{id}', [OrderController::class, 'send_email'])->name('send_email');
        Route::post('/send_user_email/{id}', [OrderController::class, 'send_user_email'])->name('send_user_email');
        Route::get('/order_search', [OrderController::class, 'datasearch'])->name('order_search');
        Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    });
});

Route::resource('carts', CartController::class)->middleware('auth')->except('store');
Route::resource('order', UserOrderController::class)->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');
Route::get('/product_details/{id}', [HomeController::class, 'product_details'])->name('product.details');
Route::post('carts/{product}', [CartController::class, 'store'])->name('carts.store')->middleware('auth');
Route::post('/add_comment', [HomeController::class,'add_comment'])->name('add_comment');
Route::post('/add_reply', [HomeController::class,'add_reply'])->name('add_reply');
Route::get('/product_search', [HomeController::class,'product_search'])->name('product_search');
Route::get('/search_product', [HomeController::class,'search_product'])->name('search_product');
Route::get('/product', [HomeController::class,'product'])->name('product');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/filter-products', [HomeController::class, 'filterProducts'])->name('filter.products');



Route::controller(HomeController::class)->group(function() {
    Route::get('/cash_order', 'cash_order')->name('cash.order')->middleware('auth');

    Route::get('/stripe/{totalPrice}', 'stripe')->name('stripe')->middleware('auth');
    Route::post('stripe/{totalPrice}','stripePost')->name('stripe.post')->middleware('auth');
    route::get('auth/google', [GoogleController::class, 'googlepage'])->name('auth_google');
    route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);
    route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);
    route::get('auth/google/callback/store', [GoogleController::class, 'store'])->name('google.store');
});
