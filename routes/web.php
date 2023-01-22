<?php

use App\Http\Controllers\initialRoute;
use App\Http\Controllers\Routed;
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
/* HTTP GET */
Route::get('/', [Routed::class, 'Apps']);
Route::get('/add', [Routed::class, 'addView'])->name('addViewers');
Route::get('/api', [Routed::class, 'index']);
Route::get('/materialapi', [Routed::class, 'materialAPI']);

/*HTTP POST */
Route::post('/add/added', [Routed::class, 'added'])->name('added');
Route::delete('/delete/{data}', [Routed::class, 'delete'])->name('Deleted');
/* HTTP DELETE */
#Route::delete();
?>
