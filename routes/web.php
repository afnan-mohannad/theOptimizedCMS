<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

Route::get('/admin', function () {
  return redirect('/admin/login');
});

/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => ['setlocale', 'minify'],
  ], function () {

    Route::get('/',[HomeController::class ,'landing'])->name('landing');

    // Pages route e.g. [about,contact,etc]
    Route::get('/{slug}', PageController::class)->name('pages');
});


// Change Language
Route::get('language/{lang}', [HomeController::class ,'changeLanguage'])->name('language');


/*
|--------------------------------------------------------------------------
| UI Routes
|--------------------------------------------------------------------------
*/


