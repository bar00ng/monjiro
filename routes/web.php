<?php

use Illuminate\Support\Facades\Route;

/*
    GUEST ROUTES
*/

Route::get('/', function () {
    $products = \App\Models\Product::orderBy('created_at', 'desc')->take(4)->get();

    return view('index', [
        'products' => $products
    ]);
});


/*
    ADMIN ROUTES
*/
Route::prefix('admin')
    ->group(function () {
        /*
            AUTHENTICATION REQUIRED
        */
        Route::middleware('auth')
            ->name('admin.')
            ->group(function () {
                /*
                    PRODUCT ROUTES
                        - Create product
                        - Edit Product
                        - Delete Product
                */
                Route::resource('/product', \App\Http\Controllers\ProductController::class)
                    ->except('show');

                /*
                    ADMIN DASHBOARD
                */
                Route::get('/dashboard', function () {
                    $product_count = \App\Models\Product::count();

                    return view('pages.admin-dashboard',[
                        'product_count' => $product_count,
                        'title' => 'Admin Dashboard'
                    ]);
                })->name('dashboard');
            });

        /*
            AUTHENTICATION NOT REQUIRED
        */
        Route::prefix('/auth')
            ->controller(\App\Http\Controllers\AuthController::class)
            ->group(function () {
                /*
                    LOGIN ROUTES
                        - GET login view
                        - POST login action
                */
                Route::get('/', 'login')
                    ->name('login');
                Route::post('/', 'loginAction');

                /*
                    REGISTER ROUTES
                        - GET register view
                        - POST register action
                */
                Route::get('/register', 'register')
                    ->name('register');
                Route::post('/register', 'registerAction');

                /*
                    LOGOUT ROUTES
                */

                Route::post('/logout', 'logout')
                    ->name('logout');
            });
    });

