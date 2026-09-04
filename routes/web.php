<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/team', 'pages.team')->name('team');

Route::get('/services', [PageController::class, 'services'])->name('services.index');
Route::view('/services/{service}', 'pages.coming-soon', ['title' => 'Service'])->name('services.show');

Route::get('/work', [WorkController::class, 'index'])->name('work.index');
Route::get('/work/{project}', [WorkController::class, 'show'])->name('work.show');

Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');

Route::view('/contact', 'pages.contact')->name('contact');
