<?php

use App\Http\Controllers\WelcomeController;

use App\Http\Controllers\PhotoController;

use Illuminate\Support\Facades\Route;

Route::get('/hello', [WelcomeController::class,'hello']);

Route::get('/', [WelcomeController::class,'index']);

Route::get('/about', [WelcomeController::class,'about']);

Route::get('/articles/{id}', [WelcomeController::class,'articles']);

// Route::get('/greeting', function () {
// 	return view('hello', ['name' => 'bagus']);
// });

// Route::get('/greeting', function () {
// 	return view('blog.hello', ['name' => 'Bagus']);
// });

Route::get('/greeting', [WelcomeController::class, 'greeting']);

Route::resource('photos', PhotoController::class);

Route::resource('photos', PhotoController::class)->only([
    'index', 'show'
]);

Route::resource('photos', PhotoController::class)->except([
    'create', 'store', 'update', 'destroy'
]);


// Route::get('/hello', function () {
//     return 'Hello World';
// });

// Route::get('/world', function () {
//     return 'World';
// });

// Route::get('/', function () {
//     return 'Selamat Datang';
// });

// Route::get('/about', function () {
//     return '244107020238, Bagus';
// });

// Route::get('/user/{name}', function ($name) {
//     return 'Nama saya Bagus'.$name;
// });

// Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
//     return 'Pos ke-1'.$postId." Komentar ke-: 5".$commentId;
// });

// Route::get('/articles/{id}', function ($id) {
//     return 'Halaman Artikel dengan ID {10}'.$id;
// });

// Route::get('/user/{name?}', function ($name = 'Bagus') {
//     return 'Nama saya Bagus' . $name;
// });