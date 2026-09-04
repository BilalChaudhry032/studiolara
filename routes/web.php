<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/team', 'pages.team')->name('team');
Route::view('/services', 'pages.services.index')->name('services.index');
Route::view('/services/{service}', 'pages.coming-soon', ['title' => 'Service'])->name('services.show');
Route::view('/work', 'pages.coming-soon', ['title' => 'Work'])->name('work.index');
Route::view('/work/{project}', 'pages.coming-soon', ['title' => 'Project'])->name('work.show');
Route::view('/pricing', 'pages.pricing')->name('pricing');
Route::view('/blog', 'pages.coming-soon', ['title' => 'Blog'])->name('blog.index');
Route::view('/blog/{post}', 'pages.coming-soon', ['title' => 'Post'])->name('blog.show');
Route::view('/contact', 'pages.contact')->name('contact');
