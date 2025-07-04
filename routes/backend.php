<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UploadController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MenuBuilderController;

/*
/
|--------------------------------------------------------------------------
| CMS Routes
|--------------------------------------------------------------------------
|
*/

/*
/
|--------------------------------------------------------------------------
| General Modules
|--------------------------------------------------------------------------
|
*/

// Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('clear-cache', [DashboardController::class, 'clear'])->name('clear.cache');

// Roles and Users
// Route::resource('roles', RoleController::class)->except(['show']);
Route::resource('users', UserController::class)->except(['show','destroy','create']);
Route::view('users', 'livewire.admin.users.index')->name('users.index');

// Menu Builder
Route::resource('menus', MenuController::class)->except(['show']);
Route::post('menus/{menu}/order', [MenuController::class, 'orderItem'])->name('menus.order');
Route::group(['as' => 'menus.', 'prefix' => 'menus/{id}/'], function () {
    Route::get('builder', [MenuBuilderController::class, 'index'])->name('builder');
    // Menu Item
    Route::group(['as' => 'item.', 'prefix' => 'item'], function () {
        Route::get('/create', [MenuBuilderController::class, 'itemCreate'])->name('create');
        Route::post('/store', [MenuBuilderController::class, 'itemStore'])->name('store');
        Route::get('/{itemId}/edit', [MenuBuilderController::class, 'itemEdit'])->name('edit');
        Route::put('/{itemId}/update', [MenuBuilderController::class, 'itemUpdate'])->name('update');
        Route::delete('/{itemId}/destroy', [MenuBuilderController::class, 'itemDestroy'])->name('destroy');
    });
});

// Tinymce upload images route
Route::post('upload', [UploadController::class, 'tinymceUpload'])->name('tinymce.upload');

/*
/
|--------------------------------------------------------------------------
| Custom Modules - and applied by livewire
|--------------------------------------------------------------------------
|
*/

// Pages 
Route::view('pages', 'livewire.admin.pages.index')->name('pages.index');
Route::view('pages/create', 'livewire.admin.pages.index')->name('pages.create');
Route::view('pages/{id}/update', 'livewire.admin.pages.index')->name('pages.update');
Route::view('pages/{id}/show', 'livewire.admin.pages.index')->name('pages.show');

// Categories
Route::view('categories', 'livewire.admin.categories.index')->name('categories.index');

// Posts
Route::view('posts', 'livewire.admin.posts.index')->name('posts.index');
Route::view('posts/create', 'livewire.admin.posts.index')->name('posts.create');
Route::view('posts/{id}/update', 'livewire.admin.posts.index')->name('posts.update');
Route::view('posts/{id}/show', 'livewire.admin.posts.index')->name('posts.show');

// Banners
Route::view('banners', 'livewire.admin.banners.index')->name('banners.index');

// Tags
Route::view('tags', 'livewire.admin.tags.index')->name('tags.index');

// Subscribers
Route::view('subscribers', 'livewire.admin.subscribers.index')->name('subscribers.index');

// Messages
Route::view('messages', 'livewire.admin.messages.index')->name('messages.index');

//Profile
Route::view('profile', 'livewire.admin.profiles.index')->name('profile.index');
Route::view('profile/{id}/update', 'livewire.admin.profiles.index')->name('profile.update');
Route::view('profile/security', 'livewire.admin.profiles.security')->name('profile.password.change');

// Settings
Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
    Route::view('{tab}', 'livewire.admin.settings.general')->name('index');
    
});
//roles
Route::view('roles', 'livewire.admin.roles.index')->name('roles.index');
Route::view('roles/create', 'livewire.admin.roles.index')->name('roles.create');
Route::view('roles/{id}/update', 'livewire.admin.roles.index')->name('roles.edit');
