<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CheckoutRequestController;
use Illuminate\Support\Facades\Route;

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

// Public routes
Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
Route::get('/items/{item}', [LandingPageController::class, 'show'])->name('landing.show');

// Auth routes
require __DIR__.'/auth.php';

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // Check if user is NOT admin, redirect to landing page
        if (stripos(auth()->user()->email, 'admin') === false) {
            return redirect()->route('landing.index');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout routes - available to all authenticated users
    Route::post('/checkout', [CheckoutRequestController::class, 'store'])->name('checkout.store');
    Route::get('/checkout', [LandingPageController::class, 'checkout'])->name('checkout');

    // Admin routes with manual admin check
    Route::prefix('admin')->name('admin.')->group(function () {
        // Items routes
        Route::get('/items', function() {
            // Check if user is admin
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(ItemController::class)->index();
        })->name('items.index');
        
        Route::get('/items/create', function() {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(ItemController::class)->create();
        })->name('items.create');
        
        Route::post('/items', function(Illuminate\Http\Request $request) {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(ItemController::class)->store($request);
        })->name('items.store');
        
        Route::get('/items/{item}', function($item) {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(ItemController::class)->show(\App\Models\Item::findOrFail($item));
        })->name('items.show');
        
        Route::get('/items/{item}/edit', function($item) {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(ItemController::class)->edit(\App\Models\Item::findOrFail($item));
        })->name('items.edit');
        
        Route::put('/items/{item}', function(\Illuminate\Http\Request $request, $item) {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(ItemController::class)->update($request, \App\Models\Item::findOrFail($item));
        })->name('items.update');
        
        Route::delete('/items/{item}', function($item) {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(ItemController::class)->destroy(\App\Models\Item::findOrFail($item));
        })->name('items.destroy');
        
        // Checkout request routes
        Route::get('/checkout-requests', function() {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(CheckoutRequestController::class)->index();
        })->name('checkout.index');
        
        Route::get('/checkout-requests/create', function() {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(CheckoutRequestController::class)->create();
        })->name('checkout.create');
        
        Route::post('/checkout-requests', function(\Illuminate\Http\Request $request) {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(CheckoutRequestController::class)->store($request);
        })->name('checkout.store');
        
        Route::post('/checkout-requests/{checkoutRequest}/approve', function($checkoutRequest) {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(CheckoutRequestController::class)->approve(\App\Models\CheckoutRequest::findOrFail($checkoutRequest));
        })->name('checkout.approve');
        
        Route::post('/checkout-requests/{checkoutRequest}/reject', function($checkoutRequest) {
            if (stripos(auth()->user()->email, 'admin') === false) {
                return redirect()->route('landing.index')
                    ->with('error', 'You do not have permission to access this area.');
            }
            return app(CheckoutRequestController::class)->reject(\App\Models\CheckoutRequest::findOrFail($checkoutRequest));
        })->name('checkout.reject');
    });
});
