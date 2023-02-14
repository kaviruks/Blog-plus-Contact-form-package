<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Kavinda\Contact\Http\Controllers\ContactController;



// Contact form view url
Route::get('/contact','Kavinda\Contact\Http\Controllers\ContactController@index')->name('contact');

// Contact form post url
Route::post('/store','Kavinda\Contact\Http\Controllers\ContactController@store');

