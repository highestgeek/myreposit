    <?php

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\PayPalController;
    use App\Http\Controllers\ProductController;

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

    Route::redirect('/', '/home');
    Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Product routes (assuming you have implemented ProductController)
    Route::resource('/products', ProductController::class)->middleware('auth');
    Route::get('/products/create', [ProductController::class , 'create'])->name('create.product');


    Route::get('/add-to-cart/{product}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
    Route::get('/cart/destroy/{itemId}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');
    Route::get('/cart/update/{rowId}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');

    Route::resource('/orders', OrderController::class)->middleware('auth');
    Route::post('/orders/update-status/{order}', [OrderController::class, 'updateStatus'])->name('update-status')->middleware('auth');

    Route::get('paypal/checkout/{order}', [PayPalController::class, 'getExpressCheckout'])->name('paypal.checkout');
    Route::get('paypal/checkout-success/{order}', [PayPalController::class, 'getExpressCheckoutSuccess'])->name('paypal.success');
    Route::get('paypal/checkout-cancel', [PayPalController::class, 'cancelPage'])->name('paypal.cancel');
