<?php
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
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

    route::get('/redirect', [HomeController::class,'redirect'])->name('redirect');

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

        // Products CRUD
        Route::resource('products', ProductController::class);
        // Order CRUD
        Route::resource('orders', OrderController::class);
        Route::put('/delivered/{id}', [OrderController::class, 'delivered'])->name('orders.delivered');
        Route::get('/print_pdf/{id}', [OrderController::class, 'print_pdf'])->name('print_pdf');
    });
});

Route::resource('carts', CartController::class)->middleware('auth');
Route::get('/product_details/{id}', [HomeController::class, 'product_details'])->name('product.details');
Route::post('carts/{product}', [CartController::class, 'store'])->name('carts.store')->middleware('auth');


Route::controller(HomeController::class)->group(function() {
    Route::get('/cash_order', 'cash_order')->name('cash.order')->middleware('auth');
    Route::get('/stripe/{totalPrice}', 'stripe')->name('stripe')->middleware('auth');
    Route::post('stripe/{totalPrice}','stripePost')->name('stripe.post')->middleware('auth');
});
