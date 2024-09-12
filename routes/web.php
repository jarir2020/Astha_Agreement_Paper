<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgreementController;

Route::get('/', function () {
    return view('agreement_form');
})->name('agreement.form');

Route::get('/agreement-form', function () {
    return view('agreement_aform');
})->name('agreement.form');

Route::post('/agreement-submit', [AgreementController::class, 'submit'])->name('agreement.submit');
