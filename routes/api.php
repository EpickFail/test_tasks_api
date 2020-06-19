<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResources(['task' => 'API\TaskController']);
Route::apiResources(['user' => 'API\UserController']);