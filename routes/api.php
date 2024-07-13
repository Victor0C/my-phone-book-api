<?php

use App\Http\Controllers\ContactsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/contacts', ContactsController::class);