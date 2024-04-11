<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Main\FormController;
use App\Http\Controllers\Main\QuestionController;
use App\Http\Controllers\Main\ResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::group(['prefix' => 'auth'], function () {
        # Auth Endpoints
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('token.validate');
    });

    Route::group(['prefix' => 'forms', 'middleware' => 'token.validate'], function () {
        # Forsm Endpoints
        Route::get('/', [FormController::class, 'index'])->name('forms.index');
        Route::get('/{form_detail}', [FormController::class, 'detail'])->name('forms.detail');
        Route::post('/', [FormController::class, 'store'])->name('forms.store');

        # Question Endpoints
        Route::prefix('{form_slug}/question')->group(function () {
            Route::post('/', [QuestionController::class, 'store'])->name('forms.question.store');
            Route::delete('/{question_id}', [QuestionController::class, 'store'])->name('forms.question.delete');
        });

        # Response Endpoints
        Route::prefix('{form_slug}/responses')->group(function () {
            Route::get('/', [ResponseController::class, 'index'])->name('forms.response.index');
            Route::post('/', [ResponseController::class, 'store'])->name('forms.response.store');
        });
    });
});
