<?php
Route::get('/', function () {
    dd(\App\Models\Com\Sign::first());
})->name('home');






