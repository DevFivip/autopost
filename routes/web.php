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

Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/customer-subreddits', [App\Http\Controllers\Admin\CustomerSubredditController::class, 'index'])->name('customer-subreddits.index');
    Route::get('admin/customer-subreddits/api', [App\Http\Controllers\Admin\CustomerSubredditController::class, 'api'])->name('customer-subreddits.api');
    Route::get('admin/customer-subreddits/create', [App\Http\Controllers\Admin\CustomerSubredditController::class, 'create'])->name('customer-subreddits.create');
    Route::post('admin/customer-subreddits', [App\Http\Controllers\Admin\CustomerSubredditController::class, 'store'])->name('customer-subreddits.store');
    Route::get('admin/customer-subreddits/{model}', [App\Http\Controllers\Admin\CustomerSubredditController::class, 'show'])->name('customer-subreddits.show');
    Route::get('admin/customer-subreddits/{model}/edit', [App\Http\Controllers\Admin\CustomerSubredditController::class, 'edit'])->name('customer-subreddits.edit');
    Route::post('admin/customer-subreddits/{model}', [App\Http\Controllers\Admin\CustomerSubredditController::class, 'update'])->name('customer-subreddits.update');
    Route::delete('admin/customer-subreddits/{model}', [App\Http\Controllers\Admin\CustomerSubredditController::class, 'destroy'])->name('customer-subreddits.destroy');
});

Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/events', [App\Http\Controllers\Admin\EventController::class, 'index'])->name('events.index');
    Route::get('admin/events/api', [App\Http\Controllers\Admin\EventController::class, 'api'])->name('events.api');
    Route::get('admin/events/create', [App\Http\Controllers\Admin\EventController::class, 'create'])->name('events.create');
    Route::post('admin/events', [App\Http\Controllers\Admin\EventController::class, 'store'])->name('events.store');
    Route::get('admin/events/{model}', [App\Http\Controllers\Admin\EventController::class, 'show'])->name('events.show');
    Route::get('admin/events/{model}/edit', [App\Http\Controllers\Admin\EventController::class, 'edit'])->name('events.edit');
    Route::post('admin/events/{model}', [App\Http\Controllers\Admin\EventController::class, 'update'])->name('events.update');
    Route::delete('admin/events/{model}', [App\Http\Controllers\Admin\EventController::class, 'destroy'])->name('events.destroy');
});

Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/images', [App\Http\Controllers\Admin\ImageController::class, 'index'])->name('images.index');
    Route::get('admin/images/api', [App\Http\Controllers\Admin\ImageController::class, 'api'])->name('images.api');
    Route::get('admin/images/create', [App\Http\Controllers\Admin\ImageController::class, 'create'])->name('images.create');
    Route::post('admin/images', [App\Http\Controllers\Admin\ImageController::class, 'store'])->name('images.store');
    Route::get('admin/images/{model}', [App\Http\Controllers\Admin\ImageController::class, 'show'])->name('images.show');
    Route::get('admin/images/{model}/edit', [App\Http\Controllers\Admin\ImageController::class, 'edit'])->name('images.edit');
    Route::post('admin/images/{model}', [App\Http\Controllers\Admin\ImageController::class, 'update'])->name('images.update');
    Route::delete('admin/images/{model}', [App\Http\Controllers\Admin\ImageController::class, 'destroy'])->name('images.destroy');
});

Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/telegram-channels', [App\Http\Controllers\Admin\TelegramChannelController::class, 'index'])->name('telegram-channels.index');
    Route::get('admin/telegram-channels/api', [App\Http\Controllers\Admin\TelegramChannelController::class, 'api'])->name('telegram-channels.api');
    Route::get('admin/telegram-channels/create', [App\Http\Controllers\Admin\TelegramChannelController::class, 'create'])->name('telegram-channels.create');
    Route::post('admin/telegram-channels', [App\Http\Controllers\Admin\TelegramChannelController::class, 'store'])->name('telegram-channels.store');
    Route::get('admin/telegram-channels/{model}', [App\Http\Controllers\Admin\TelegramChannelController::class, 'show'])->name('telegram-channels.show');
    Route::get('admin/telegram-channels/{model}/edit', [App\Http\Controllers\Admin\TelegramChannelController::class, 'edit'])->name('telegram-channels.edit');
    Route::post('admin/telegram-channels/{model}', [App\Http\Controllers\Admin\TelegramChannelController::class, 'update'])->name('telegram-channels.update');
    Route::delete('admin/telegram-channels/{model}', [App\Http\Controllers\Admin\TelegramChannelController::class, 'destroy'])->name('telegram-channels.destroy');
});
