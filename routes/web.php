<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');

Route::view('/about', 'pages.coming-soon', ['title' => 'About'])->name('about');
Route::view('/team', 'pages.coming-soon', ['title' => 'Team'])->name('team');
Route::view('/services', 'pages.coming-soon', ['title' => 'Services'])->name('services.index');
Route::view('/services/{service}', 'pages.coming-soon', ['title' => 'Service'])->name('services.show');
Route::view('/work', 'pages.coming-soon', ['title' => 'Work'])->name('work.index');
Route::view('/work/{project}', 'pages.coming-soon', ['title' => 'Project'])->name('work.show');
Route::view('/pricing', 'pages.coming-soon', ['title' => 'Pricing'])->name('pricing');
Route::view('/blog', 'pages.coming-soon', ['title' => 'Blog'])->name('blog.index');
Route::view('/blog/{post}', 'pages.coming-soon', ['title' => 'Post'])->name('blog.show');
Route::view('/contact', 'pages.coming-soon', ['title' => 'Contact'])->name('contact');
