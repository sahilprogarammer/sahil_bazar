<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryBoyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clear-cache', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');

    return response()->json([
        'success' => true,
        'message' => 'Laravel cache cleared successfully.'
    ]);
});


//Admin Pannel
Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminController::class, "login"])->name('admin.login');
    Route::post('/login-submit', [AdminController::class, "authenticate"]);
    Route::post('/logout', [AdminController::class, 'logout'])
        ->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, "dashboard"])->name('admin.dashboard');
        Route::get('/category', [CategoryController::class, "category"])->name('admin.category');
        Route::post('/category', [CategoryController::class, 'addCategory'])->name('admin.category.save');

        Route::get('/subcategory', [CategoryController::class, "subcategory"])->name('admin.subcategory');
        Route::post('/subcategory', [CategoryController::class, 'addSubcategory'])->name('admin.subcategory.save');

        Route::get('/product', [ProductController::class, "product"])->name('admin.product');
        Route::get('/add-product', [ProductController::class, "productAdd"])->name('admin.addproduct');
        Route::post('/product', [ProductController::class, 'addproduct'])->name('admin.product.save');

        //Delivery charges
        Route::get('/delivery-charges', [ProductController::class, "deliverycharges"])->name('admin.deliverycharge');
        Route::post('/delivery-charges', [ProductController::class, 'addDeliverycharges'])->name('admin.deliverycharges.save');

        //All orders
        Route::get('/report/order', [ProductController::class, "order"])->name('admin.order');
        Route::post('/report/order', [ProductController::class, 'order'])->name('admin.report.order.filter');

        //Complete Report
        Route::get('/report/completeorder', [ReportController::class, "completeorder"])->name('admin.completeorder');
        Route::post('/report/completeorder', [ReportController::class, 'completeorder'])->name('admin.report.completeorder.filter');

        //cancel report
        Route::get('/report/cancelorder', [ReportController::class, "cancelorder"])->name('admin.cancelorder');
        Route::post('/report/cancelorder', [ReportController::class, 'cancelorder'])->name('admin.report.cancelorder.filter');

        // pending reports
        Route::get('/report/pendingorder', [ReportController::class, "pendingorder"])->name('admin.pendingorder');
        Route::post('/report/pendingorder', [ReportController::class, 'pendingorder'])->name('admin.report.pendingorder.filter');

        //product manage
        Route::get('/product/step1', [ProductController::class, 'step1'])->name('product.step1');
        Route::post('/product/step1/save', [ProductController::class, 'step1Save'])->name('product.step1.save');



        // Step 2 
        Route::get('/product/step2/{id}', [ProductController::class, 'step2'])->name('product.step2');
        Route::post('/product/step2/{id}/save', [ProductController::class, 'step2Save'])->name('product.step2.save');
        // Step 3 
        Route::get('/product/step3/{id}', [ProductController::class, 'step3'])->name('product.step3');
        Route::post('/product/step3/{id}/save', [ProductController::class, 'step3Save'])->name('product.step3.save');
        //Step 4 
        Route::get('/product/step4/{id}', [ProductController::class, 'step4'])->name('product.step4');
        // Final Save 
        Route::post('/product/{id}/save', [ProductController::class, 'store'])->name('product.store');
        Route::post('/product/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('product.toggleStatus');
        Route::delete('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');


        //Product availability
        Route::get('/all-unavailability', [ProductController::class, 'allUnavailability'])->name('allunAvailability');
        Route::get('/product-availability/subcategories', [ProductController::class, 'subcategories'])->name('admin.product-availability.subcategories');

        Route::get('/product-availability/products/{subcategory}', [ProductController::class, 'products'])->name('admin.product-availability.products');
        Route::post('/product-availability',[ProductController::class, 'availabilityStore'])->name('admin.product-availability.store');
        Route::delete('/product-availability', [ProductController::class, 'availabilityDestroy'])
    ->name('admin.product-availability.destroy');


        //Delivery boy manage
        Route::get('/add-delivery-boy', [DeliveryBoyController::class, 'addDeliveryBoy'])->name('admin.addDeliveryBoy');
        Route::get('/edit-delivery-boy/{id}', [DeliveryBoyController::class, 'addDeliveryBoy'])->name('admin.addDeliveryBoy.edit');
        Route::post('/save-delivery-boy', [DeliveryBoyController::class, 'saveDeliveryBoy'])->name('admin.addDeliveryBoy.save');


        Route::get('/delivery-boy', [DeliveryBoyController::class, 'deliveryBoy'])->name('admin.deliveryboy');


        Route::post('/delivery-boy/{id}/toggle-status', [DeliveryBoyController::class, 'toggleDeliveryBoyStatus'])->name('admin.deliveryboy.toggleStatus');
        Route::delete('/delivery-boy/{id}/delete', [DeliveryBoyController::class, 'deleteDeliveryBoy'])->name('admin.deliveryboy.delete');
    });
});






// Frontend

Route::post('/login/send-otp', [AuthController::class, 'sendOtp'])->name('login.sendOtp');
Route::post('/login/verify-otp', [AuthController::class, 'verifyOtp'])->name('login.verifyOtp');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/splash', function () {
    return view('frontend.pages.splash');
})->name('splash');

Route::get('/', [HomeController::class, "home"])->name('home');
Route::get('sahil', [HomeController::class, "sahil"])->name('sahil');

Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::post('/checkout', [HomeController::class, 'orderSubmit'])->name('checkout');


//Checkout page for payments
Route::get('/check-out', [HomeController::class, 'checkout'])->name('check-out');
Route::post('/cart/refresh', [HomeController::class, 'refresh'])->name('cart.refresh');

//Make payment
Route::post('/cash-payment', [PaymentController::class, 'orderSubmit'])->name('payment.cash');
Route::post('/payment/create', [PaymentController::class, 'create'])->name('payment.create');


Route::get('/order-success', function () {
    return view('frontend.pages.order-success');
})->name('order.success');


Route::get('/explore', [HomeController::class, 'explore'])->name('explore');
Route::get('/address', [AddressController::class, 'address'])->name('address');
Route::post('/address-submit', [AddressController::class, 'addressStore'])->name('address-store');

//update address
Route::post('/addresses/{address}', [AddressController::class, 'addressUpdate'])
    ->name('address-update');

Route::post('/address/set-default', [AddressController::class, 'setDefault'])->name('address.setDefault');

Route::get('/my-addresses', [AddressController::class, 'getAddresses'])->name('addresses.list');

//cart

//Profile
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/profile-update', [HomeController::class, 'updateProfile'])->name('profile.update');

Route::get('/my-orders', [HomeController::class, 'myOrders'])->name('my-orders');

//order cancel
Route::post('/orders/{id}/cancel', [HomeController::class, 'orderCancel'])->name('orders.cancel');


Route::post('/payment/razorpay/create', [HomeController::class, 'payment'])
    ->name('payment.razorpay.create');


Route::get('/location', [HomeController::class, "location"]);
Route::get('/about-us', [HomeController::class, "aboutUs"])->name('about-us');
Route::get('/help-support', [HomeController::class, "helpSupport"])->name('help-support');


Route::get('/{category:slug}', [HomeController::class, "category"])->name('category');
Route::get('/{category:slug}/{subcategory:slug}', [HomeController::class, 'subcategory'])->name('subcategory');
