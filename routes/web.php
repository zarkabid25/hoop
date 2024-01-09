<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    $products = \App\Models\Product::with('category')->get();

    return view('frontend.index', compact('products'));
});
Route::get('/product_details/{id}', function ($id){
    $product = \App\Models\Product::where('id', $id)->first();
    return view('frontend.product_detail', compact('product'));
})->name('product.details');

Route::get('/contact', [\App\Http\Controllers\Contact\ContactController::class, 'create'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\Contact\ContactController::class, 'store'])->name('contact.store');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function (){

    Route::get('/dashboard', function (){
        return view('portal.admin.dashboard');
    })->name('dashboard.admin');

    Route::resources([
        'user_management' => \App\Http\Controllers\Admin\UserManagement::class,
        'category' => \App\Http\Controllers\Admin\CategoryController::class,
        'product' => \App\Http\Controllers\Admin\ProductController::class,
        'order' => \App\Http\Controllers\Admin\OrderController::class
    ]);

    Route::get('/order_status/update', [\App\Http\Controllers\Admin\OrderController::class, 'statusUpdate'])->name('order-status-update');
    Route::get('/order/assign/{devId}/{orderId}/{status}', [\App\Http\Controllers\Admin\OrderController::class, 'assignOrder'])->name('order-assign');
});

Route::group(['middleware' => 'auth',], function(){

    Route::resource('order', \App\Http\Controllers\Admin\OrderController::class);

    Route::get('/profile', [\App\Http\Controllers\UserProfile\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/{id}', [\App\Http\Controllers\UserProfile\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change_password/{id}', [\App\Http\Controllers\UserProfile\ProfileController::class, 'changePassword'])->name('profile.change_passowrd');
    Route::post('/profile/password_update/{id}', [\App\Http\Controllers\UserProfile\ProfileController::class, 'updatePassword'])->name('profile.password-update');

    Route::post('/comment', [\App\Http\Controllers\Comment\CommentController::class, 'store'])->name('comment.store');
    Route::post('/order_status', [\App\Http\Controllers\Admin\OrderController::class, 'orderStatus'])->name('order.status');

});

Route::group(['middleware' => 'auth', 'prefix' => 'orders'], function(){
    Route::get('/dashboard', function (){
        return view('portal.order.dashboard');
    })->name('dashboard.order');
});

Route::group(['middleware' => 'auth', 'prefix' => 'customer'], function(){
    Route::get('/dashboard', function (){
        return view('portal.customer.dashboard');
    })->name('dashboard.customer');

    Route::resource('quote', \App\Http\Controllers\Customer\QuotesController::class);
    Route::get('/invoices', [\App\Http\Controllers\Customer\InvoiceController::class, 'invoices'])->name('invoices');
    Route::get('/invoice_download/{id}', [\App\Http\Controllers\Customer\InvoiceController::class,'downloadInvoice'])->name('invoice-download');
    Route::get('/filter_invoices', [\App\Http\Controllers\Customer\InvoiceController::class, 'filterInvoiceData'])->name('filter-invoices');
});

Route::group(['middleware' => 'auth', 'prefix' => 'developer'], function(){

    Route::get('/dashboard', function (){
        return view('portal.developer.dashboard');
    })->name('dashboard.developer');

});

Route::group(['middleware' => 'auth', 'prefix' => 'sales'], function(){

    Route::get('/dashboard', function (){
        return view('portal.developer.dashboard');
    })->name('dashboard.sales');

    Route::get('/rewards', [\App\Http\Controllers\Reward\RewardController::class, 'index'])->name('reward.index');
    Route::get('/order_notification/{id}', [\App\Http\Controllers\Reward\RewardController::class, 'notificationOrder'])->name('reward.notification.order');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
