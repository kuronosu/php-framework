<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Request;

Request::register('/', HomeController::class);
Request::register('/contact', ContactController::class);

$request = new Request;
$request->send();
