<?php

Route::get('/{any}', function () {
    return view('home');
})->where('any', '.*');
