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

    public function getBibliotheque(Request $request, Response $response, array $args) {
        $idBiblio = (int)$args['idBiblio'];
        $bibliotheque = Bibliotheque::fetchBibliothequeById($idBiblio);
    
        
        if ($bibliotheque && $bibliotheque->isMemberOfBibliotheque($idBiblio)) {
            $bibliotheque->loadLivres();
            return $this->view->render($response, '/bibliotheque/bibliotheque.php', [
                'bibliotheque' => $bibliotheque,
                'livres' => Livre::fetchBooks()
            ]);
        } else {
            return $response->withHeader('Location', '/')->withStatus(302);
        }
    }

    public function editBibliotheque(Request $request, Response $response, array $args) {
        $idBiblio = (int)$args['idBiblio'];
        $data = $request->getParsedBody();
        $nom = $data['nom'] ?? '';
        $bibliotheque = Bibliotheque::fetchBibliothequeById($idBiblio);
    
        

        if ($bibliotheque && $bibliotheque->isMemberOfBibliotheque($idBiblio)) {
            $bibliotheque->updateBibliotheque($idBiblio, $nom);
            return $response->withHeader('Location', "/bibliotheque/{$idBiblio}")->withStatus(302);
        } else {
            return $response->withHeader('Location', '/')->withStatus(302);
        }
    }

    public function deleteBibliotheque(Request $request, Response $response, array $args) {
        $idBiblio = (int)$args['idBiblio'];
        $bibliotheque = Bibliotheque::fetchBibliothequeById($idBiblio);
    
        if ($bibliotheque && $bibliotheque->isMemberOfBibliotheque($idBiblio)) {
            $bibliotheque->deleteBibliotheque($idBiblio);
        }
    
        return $response->withHeader('Location', '/')->withStatus(302);
    }

    public function showAddLivreForm(Request $request, Response $response, array $args) {
        $idBiblio = (int)$args['idBiblio'];
        $bibliotheque = Bibliotheque::fetchBibliothequeById($idBiblio);
    
        if ($bibliotheque && $bibliotheque->isMemberOfBibliotheque($idBiblio)) {
            return $this->view->render($response, '/bibliotheque/addLivre.php', [
                'bibliotheque' => $bibliotheque,
                'livres' => Livre::fetchBooks()
            ]);
        } else {
            return $response->withHeader('Location', '/')->withStatus(302);
        }
    }
}