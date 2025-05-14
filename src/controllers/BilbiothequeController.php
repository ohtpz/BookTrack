<?php 

namespace Elpommier\BookTrack\controllers;

use Elpommier\BookTrack\models\Livre;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use Elpommier\BookTrack\models\User;
use Elpommier\BookTrack\models\Bibliotheque;


class BilbiothequeController extends BaseController {
    public function ajouteBibliotheque(Request $request, Response $response) {
        $data = $request->getParsedBody();
        $nom = $data['nom'] ?? '';

        if (strlen($nom) < 3) {
            return $response->withHeader('Location', '/')->withStatus(302);
        }
    
        $user = User::current();
    
        if ($user) {
            Bibliotheque::createBibliotheque($user->getIdUtilisateur(), $nom);
        }
    
        return $response->withHeader('Location', '/')->withStatus(302);
    }
}