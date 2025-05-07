<?php

namespace Elpommier\BookTrack\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Elpommier\BookTrack\models\Emprunt;

class EmpruntController
{
    public function formulaire(Request $request, Response $response, array $args): Response
    {
        $idLivre = (int) $args['idLivre'];

        ob_start();
        require __DIR__ . '/../../views/emprunt/form.php';
        $content = ob_get_clean();

        $title = "Demande d'emprunt";
        ob_start();
        require __DIR__ . '/../../views/layout.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    public function traiterFormulaire(Request $request, Response $response, array $args): Response
    {
        $idLivre = (int) $args['idLivre'];
        $data = $request->getParsedBody();
        $dateDebut = $data['dateDebut'] ?? '';
        $dateFin = $data['dateFin'] ?? '';

        $modele = new Emprunt();
        $utilisateurs = $modele->getProprietairesDuLivre($idLivre, $_SESSION['user']['idUtilisateur']);

        // On passe les variables nécessaires à la vue
        ob_start();
        require __DIR__ . '/../../views/emprunt/resultats.php';
        $content = ob_get_clean();

        $title = "Choisir un propriétaire";
        ob_start();
        require __DIR__ . '/../../views/layout.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    public function creerDemande(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $idLivre = (int) $data['idLivre'];
        $idProprietaire = (int) $data['idProprietaire'];
        $dateDebut = $data['dateDebut'];
        $dateFin = $data['dateFin'];
        $idEmprunteur = $_SESSION['user']['idUtilisateur'];

        $modele = new Emprunt();
        $modele->creerEmprunt($idLivre, $idProprietaire, $idEmprunteur, $dateDebut, $dateFin);

        return $response->withHeader('Location', '/')->withStatus(302);
    }
}
