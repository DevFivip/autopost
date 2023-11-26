<?php

use App\Http\Controllers\ProfileController;
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

Route::middleware('splade')->group(function () {
    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});

Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
    Route::get('admin/customers/api', [App\Http\Controllers\Admin\CustomerController::class, 'api'])->name('customers.api');
    Route::get('admin/customers/create', [App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('customers.create');
    Route::post('admin/customers', [App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customers.store');
    Route::get('admin/customers/{model}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customers.show');
    Route::get('admin/customers/{model}/edit', [App\Http\Controllers\Admin\CustomerController::class, 'edit'])->name('customers.edit');
    Route::get('admin/customers/{model}/assingsubreddit', [App\Http\Controllers\Admin\CustomerController::class, 'assingsubreddit'])->name('customers.assingsubreddit');
    Route::post('admin/customers/{model}', [App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('customers.update');
    Route::delete('admin/customers/{model}', [App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('customers.destroy');
});

Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/subreddits', [App\Http\Controllers\Admin\SubredditController::class, 'index'])->name('subreddits.index');
    Route::get('admin/subreddits/api', [App\Http\Controllers\Admin\SubredditController::class, 'api'])->name('subreddits.api');
    Route::get('admin/subreddits/create', [App\Http\Controllers\Admin\SubredditController::class, 'create'])->name('subreddits.create');
    Route::post('admin/subreddits', [App\Http\Controllers\Admin\SubredditController::class, 'store'])->name('subreddits.store');
    Route::get('admin/subreddits/{model}', [App\Http\Controllers\Admin\SubredditController::class, 'show'])->name('subreddits.show');
    Route::get('admin/subreddits/{model}/edit', [App\Http\Controllers\Admin\SubredditController::class, 'edit'])->name('subreddits.edit');
    Route::post('admin/subreddits/{model}', [App\Http\Controllers\Admin\SubredditController::class, 'update'])->name('subreddits.update');
    Route::delete('admin/subreddits/{model}', [App\Http\Controllers\Admin\SubredditController::class, 'destroy'])->name('subreddits.destroy');
});
