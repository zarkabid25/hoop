<?php

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";

});

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
Route::get('/getChartData', [\App\Http\Controllers\Chart\ChartController::class, 'getSalesChartData']);
Route::get('/order-chart-data', [\App\Http\Controllers\Chart\ChartController::class, 'getOrderChartData']);
Route::get('/download-image/{filename}', [\App\Http\Controllers\FileController::class, 'downloadImage'])->name('image.download');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function (){

    Route::get('/dashboard', function (){
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $monthOrders = Order::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $monthQuotes = \App\Models\Quote::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $allOrders = Order::with('customer')->orderBy('id', 'DESC')->get();
        $orders = $allOrders->where('order_status', 0);
        $outStandingsCount = $orders->count();
//        $filteredOrders = $allOrders->filter(function ($order) {
//            return $order->where('order_status', 0);
//        });

//        $filteredOrdersCollection = collect($filteredOrders);
//        $orders = $filteredOrdersCollection->values();

        $allOrders = $allOrders->count();

        $cancelledOrders = Order::where('order_status', '2')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        return view('portal.admin.dashboard', compact('monthQuotes', 'monthOrders', 'allOrders', 'orders', 'cancelledOrders', 'outStandingsCount'));
    })->name('dashboard.admin');

    Route::resources([
        'user_management' => \App\Http\Controllers\Admin\UserManagement::class,
        'category' => \App\Http\Controllers\Admin\CategoryController::class,
        'product' => \App\Http\Controllers\Admin\ProductController::class,
        'order' => \App\Http\Controllers\Admin\OrderController::class,
        // 'company_details' => \App\Http\Controllers\Admin\OrderController::class,
    ]);

    Route::get('/order_status/update', [\App\Http\Controllers\Admin\OrderController::class, 'statusUpdate'])->name('order-status-update');
    Route::get('/order/assign/{devId}/{orderId}/{status}', [\App\Http\Controllers\Admin\OrderController::class, 'assignOrder'])->name('order-assign');
    Route::get('/company_details_create', [\App\Http\Controllers\CompanyDetails\CompanyDetailController::class, 'create'])->name('company-details-create');
    Route::post('/company_details_store', [\App\Http\Controllers\CompanyDetails\CompanyDetailController::class, 'store'])->name('company-details.store');
    Route::get('/company_details/{id}/edit', [\App\Http\Controllers\CompanyDetails\CompanyDetailController::class, 'edit'])->name('company-details.edit');
    Route::get('/company_details', [\App\Http\Controllers\CompanyDetails\CompanyDetailController::class, 'index'])->name('company-details');
    Route::post('/company_details_update/{id}', [\App\Http\Controllers\CompanyDetails\CompanyDetailController::class, 'update'])->name('company-details.update');
    Route::get('/company_details/{id}/delete', [\App\Http\Controllers\CompanyDetails\CompanyDetailController::class, 'delete'])->name('company-details.delete');
    Route::post('/placement_prices/update', [\App\Http\Controllers\Admin\UserManagement::class, 'placementPriceUpdate'])->name('placement-price-update');

});

Route::group(['middleware' => 'auth',], function(){

    Route::resource('order', \App\Http\Controllers\Admin\OrderController::class);

    Route::get('/profile', [\App\Http\Controllers\UserProfile\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/{id}', [\App\Http\Controllers\UserProfile\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change_password/{id}', [\App\Http\Controllers\UserProfile\ProfileController::class, 'changePassword'])->name('profile.change_passowrd');
    Route::post('/profile/password_update/{id}', [\App\Http\Controllers\UserProfile\ProfileController::class, 'updatePassword'])->name('profile.password-update');


    Route::post('/comment', [\App\Http\Controllers\Comment\CommentController::class, 'store'])->name('comment.store');
    Route::post('/order_status', [\App\Http\Controllers\Admin\OrderController::class, 'orderStatus'])->name('order.status');
    Route::get('/filter_order', [\App\Http\Controllers\Admin\OrderController::class, 'filterOrder'])->name('filter_order');

    Route::get('/invoices', [\App\Http\Controllers\Customer\InvoiceController::class, 'invoices'])->name('invoices');
    Route::get('/invoice_download/{id}', [\App\Http\Controllers\Customer\InvoiceController::class,'downloadInvoice'])->name('invoice-download');
    Route::post('/manual_generate_invoice', [\App\Http\Controllers\Customer\InvoiceController::class,'manualGenerateInvoice'])->name('manual-invoice-download');
    Route::get('/filter_invoices', [\App\Http\Controllers\Customer\InvoiceController::class, 'filterInvoiceData'])->name('filter-invoices');

});

Route::group(['middleware' => 'auth', 'prefix' => 'orders'], function(){
    Route::get('/dashboard', function (){
        return view('portal.order.dashboard');
    })->name('dashboard.order');
});

Route::group(['middleware' => 'auth', 'prefix' => 'customer'], function(){
    Route::get('/dashboard', function (){
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $userId = auth()->user()->id;

        $monthOrders = Order::where('customer_id', $userId)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $monthQuotes = \App\Models\Quote::where('customer_id', $userId)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $allOrders = Order::with('customer')->where('customer_id', $userId)->orderBy('id', 'DESC')->get();
        $orders = $allOrders->where('order_status', 0);
        $outStandingsCount = $orders->count();
//        $filteredOrders = $allOrders->filter(function ($order) use ($userId) {
//            return $order->customer_id == $userId && Carbon::parse($order->created_at)->isToday();
//        });

//        $filteredOrdersCollection = collect($filteredOrders);
//        $orders = $filteredOrdersCollection->values();

        $totalPrice = $allOrders->sum('price');
        $allOrdersCount = $allOrders->count();

        $cancelledOrders = Order::where('customer_id', $userId)
            ->where('order_status', '2')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        return view('portal.customer.dashboard', compact('monthQuotes', 'monthOrders', 'orders', 'cancelledOrders', 'allOrdersCount', 'totalPrice', 'outStandingsCount'));
    })->name('dashboard.customer');

    Route::resource('quote', \App\Http\Controllers\Customer\QuotesController::class);

});

Route::group(['middleware' => 'auth', 'prefix' => 'developer'], function(){

    Route::get('/dashboard', function (){
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $currentDate = now()->toDateString();
        $userId = auth()->user()->id;

        $monthOrders = \App\Models\AssignOrder::where('developer_id', $userId)
            ->where('status', 'assign')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $orders = \App\Models\AssignOrder::where('developer_id', $userId)
            ->where('status', 'assign')
            ->get();

        $allOrders = \App\Models\AssignOrder::where('developer_id', $userId)
            ->where('status', 'assign')
            ->count();

        return view('portal.developer.dashboard', compact('monthOrders', 'allOrders', 'orders'));
    })->name('dashboard.developer');

});

Route::group(['middleware' => 'auth', 'prefix' => 'sales'], function(){

    Route::get('/dashboard', function () {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $users = User::where('referred', auth()->user()->email)->get(['id']);

        if ($users->isNotEmpty()) {
            $userCount = $users->count();

            $monthOrders = Order::whereIn('customer_id', $users->pluck('id'))
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->count();

            $allOrders = Order::whereIn('customer_id', $users->pluck('id'))->where('order_status', '0')->count();

            $today = Carbon::today();

            $orders = Order::whereIn('customer_id', $users->pluck('id'))
                ->where('created_at', '0')
                ->get();

            return view('portal.sales.dashboard', compact('monthOrders', 'allOrders', 'userCount', 'orders'));
        } else {
            return view('portal.sales.dashboard', [
                'monthOrders' => 0,
                'allOrders' => 0,
                'userCount' => 0,
                'dailyOrdersCount' => 0,
            ]);
        }
    })->name('dashboard.sales');


    Route::get('/rewards', [\App\Http\Controllers\Reward\RewardController::class, 'index'])->name('reward.index');
    Route::get('/order_notification/{id}', [\App\Http\Controllers\Reward\RewardController::class, 'notificationOrder'])->name('reward.notification.order');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
