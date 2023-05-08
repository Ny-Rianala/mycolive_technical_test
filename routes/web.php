<?php
use Illuminate\Support\Facades\Route;

$controller_prefix = 'App\Http\Controllers\\';

Route::get('/', function () {
    // If the user is not authenticated, redirect them to the login page
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // Get the current user
    $user = auth()->user();

    // TODO: Add your logic here for the homepage
    // For example, you could retrieve some data from the database and pass it to the view

    return view('index', ['user' => $user]);
})->middleware('auth');

Route::match(array('GET', 'POST'), 'login', $controller_prefix.'AuthController@login')->name('login');
Route::match(array('GET', 'POST'), 'register', $controller_prefix.'AuthController@register')->name('register');