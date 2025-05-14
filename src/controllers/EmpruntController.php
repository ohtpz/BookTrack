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

        $error = $_GET['error'] ?? null;

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

        if (strtotime($dateDebut) < strtotime(date('Y-m-d'))) {
            return $response->withHeader('Location', "/emprunt/{$idLivre}?error=passee")->withStatus(302);
        }

        if (strtotime($dateDebut) > strtotime($dateFin)) {
            return $response->withHeader('Location', "/emprunt/{$idLivre}?error=dates")->withStatus(302);
        }

        $modele = new Emprunt();
        $utilisateurs = $modele->getProprietairesDuLivre($idLivre, $_SESSION['user']['idUtilisateur']);

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

        // Vérifier doublon
        if ($modele->demandeExiste($idLivre, $idProprietaire, $idEmprunteur)) {
            return $response->withHeader('Location', "/emprunt/{$idLivre}?error=doublon")->withStatus(302);
        }

        // Vérifier recouvrement
        if ($modele->periodeOccupee($idLivre, $dateDebut, $dateFin)) {
            return $response->withHeader('Location', "/emprunt/{$idLivre}?error=recouvrement")->withStatus(302);
        }

        $modele->creerEmprunt($idLivre, $idProprietaire, $idEmprunteur, $dateDebut, $dateFin);

        return $response->withHeader('Location', '/')->withStatus(302);
    }

    public function mesDemandes(Request $request, Response $response): Response
    {
        $idUtilisateur = $_SESSION['user']['idUtilisateur'];
        $modele = new Emprunt();

        $demandesRecues = $modele->getDemandesRecues($idUtilisateur);
        $demandesEnvoyees = $modele->getDemandesEnvoyees($idUtilisateur);
        $empruntsEnCours = $modele->getEmpruntsEnCours($idUtilisateur);
        $historiqueRecues = $modele->getToutesDemandesRecues($idUtilisateur);
        $historiqueEnvoyees = $modele->getToutesDemandesEnvoyees($idUtilisateur);

        ob_start();
        require __DIR__ . '/../../views/emprunt/demandes.php';
        $content = ob_get_clean();

        $title = "Demandes";
        ob_start();
        require __DIR__ . '/../../views/layout.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    public function accepterDemande(Request $request, Response $response, array $args): Response
    {
        $idEmprunt = (int) $args['id'];
        $modele = new Emprunt();
        $modele->changerStatut($idEmprunt, 'en cours');
        return $response->withHeader('Location', '/emprunt/mes-demandes')->withStatus(302);
    }

    public function refuserDemande(Request $request, Response $response, array $args): Response
    {
        $idEmprunt = (int) $args['id'];
        $modele = new Emprunt();
        $modele->changerStatut($idEmprunt, 'refuse');
        return $response->withHeader('Location', '/emprunt/mes-demandes')->withStatus(302);
    }
}
