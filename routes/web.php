<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TaskComponent;
use App\Http\Livewire\WelcomeComponent;
use App\Http\Livewire\ShowUsersComponent;
use App\Http\Livewire\User\ShowTaskComponent;
use App\Http\Livewire\User\ViewTaskComponent;
use App\Http\Livewire\HomeComponent;


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

Route::get('/',WelcomeComponent::class)->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home',HomeComponent::class);


Route::group(['middleware' => 'admin'], function () {

Route::get('/all-users',ShowUsersComponent::class)->name('show.users');;
Route::get('/task',TaskComponent::class)->name('task');
Route::get('/settings',TaskComponent::class)->name('settings');
});
Route::group(['middleware' => 'user'], function () {


Route::get('/tasks',ShowTaskComponent::class)->name('show.task');

});
Route::get('/task/{id}',ViewTaskComponent::class)->name('view.task');
});