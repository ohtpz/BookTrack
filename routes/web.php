<?php


use Elpommier\BookTrack\controllers\LoginController;
use Elpommier\BookTrack\controllers\RegisterController;
use Elpommier\BookTrack\controllers\LogoutController;
use Elpommier\BookTrack\controllers\EmpruntController;
use Elpommier\BookTrack\controllers\LivreController;
use Elpommier\BookTrack\controllers\BilbiothequeController;

//Acceuil
$app->get("/", [LivreController::class, "getBooks"]);

// Connexion
$app->get('/login', [LoginController::class, 'showForm']);
$app->post('/login', [LoginController::class, 'handleLogin']);

// Inscription
$app->get('/register', [RegisterController::class, 'showForm']);
$app->post('/register', [RegisterController::class, 'handleRegister']);

// Déconnexion
$app->get('/logout', [LogoutController::class, 'logout']);

// Emprunt routes fixes
$app->get('/emprunt/mes-demandes', [EmpruntController::class, 'mesDemandes']);
$app->post('/emprunt/accepter/{id}', [EmpruntController::class, 'accepterDemande']);
$app->post('/emprunt/refuser/{id}', [EmpruntController::class, 'refuserDemande']);
$app->post('/emprunt/demande', [EmpruntController::class, 'creerDemande']);
$app->get('/emprunt/historique', [EmpruntController::class, 'historique']);

// Emprunt routes dynamiques
$app->get('/emprunt/{idLivre}', [EmpruntController::class, 'formulaire']);
$app->post('/emprunt/{idLivre}', [EmpruntController::class, 'traiterFormulaire']);

// Bibliothèque
$app->post('/bibliotheque/add', [BilbiothequeController::class, 'ajouteBibliotheque']);
$app->get('/bibliotheque/{idBiblio}', [BilbiothequeController::class, 'getBibliotheque']);
$app->post('/bibliotheque/delete/{idBiblio}', [BilbiothequeController::class, 'deleteBibliotheque']);
$app->post('/bibliotheque/edit/{idBiblio}', [BilbiothequeController::class, 'editBibliotheque']);

//Detail
$app->get("/detail/{idLivre}", [LivreController::class, "getBook"]);


