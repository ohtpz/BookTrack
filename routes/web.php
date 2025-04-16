<?php

use Elpommier\BookTrack\controllers\LoginController;
use Elpommier\BookTrack\controllers\RegisterController;

$app->get('/login', [LoginController::class, 'showForm']);
$app->post('/login', [LoginController::class, 'handleLogin']);

$app->get('/register', [RegisterController::class, 'showForm']);
$app->post('/register', [RegisterController::class, 'handleRegister']);
