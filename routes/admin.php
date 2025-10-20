<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware("admin")->prefix("admin")->name("admin.")->group(function(){


    Route::get('dashboard' ,  function(){
        return "hi";
    })->name("dashboard");


});

