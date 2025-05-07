<?php

use Elpommier\BookTrack\controllers\LoginController;
use Elpommier\BookTrack\controllers\RegisterController;
use Elpommier\BookTrack\controllers\LogoutController;
use Elpommier\BookTrack\controllers\EmpruntController;

// Connexion
$app->get('/login', [LoginController::class, 'showForm']);
$app->post('/login', [LoginController::class, 'handleLogin']);

// Inscription
$app->get('/register', [RegisterController::class, 'showForm']);
$app->post('/register', [RegisterController::class, 'handleRegister']);

// Déconnexion
$app->get('/logout', [LogoutController::class, 'logout']);

// Emprunt 
$app->post('/emprunt/demande', [EmpruntController::class, 'creerDemande']);
$app->get('/emprunt/{idLivre}', [EmpruntController::class, 'formulaire']);
$app->post('/emprunt/{idLivre}', [EmpruntController::class, 'traiterFormulaire']);
