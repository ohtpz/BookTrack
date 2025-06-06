<?php

namespace Elpommier\BookTrack\controllers;

use DateTime;
use Elpommier\BookTrack\models\Avis;
use Elpommier\BookTrack\models\Livre;
use Elpommier\BookTrack\models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class LivreController extends BaseController
{

    /**
     * Fonction pour récupérer tous les livres
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function getBooks(Request $request, Response $response)
    {

        $livres = Livre::fetchBooks();
        $data = [
            "title" => "Accueil",
            "livres" => $livres,

        ];

        $render = new PhpRenderer(__DIR__ . "/../../views/", $data);
        $render->setLayout("layout.php");
        return $render->render($response, "accueil/index.php");
    }

    /**
     * Fonction pour récupérer un seul livre avec un id
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function getBook(Request $request, Response $response, array $args)
    {

        $idLivre = (int) $args['idLivre'];

        $livre = Livre::fetchBook($idLivre);
        $ratings = Avis::fetchAvis($idLivre);
        $users = User::fetchAll();

        if (count($livre) > 0) {
            $data = [
                "title" => "Détail de " . $livre[0]->titre,
                "livre" => $livre[0],
                "ratings" => $ratings,
                "users" => $users
            ];

            $render = new PhpRenderer(__DIR__ . "/../../views/", $data);
            $render->setLayout("layout.php");
            return $render->render($response, "detail/detail.php");
        } else
            return $response->withHeader('Location', '/')->withStatus(302);
    }

    public function addComment(Request $request, Response $response, array $args)
    {
        $user = User::current();
        if (!isset($user)) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $idLivre = (int)$args['idLivre'];

        $livre = Livre::fetchBook($idLivre);

        $comment = filter_input(INPUT_POST, "comment", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        $ratings = $_POST['rating'];
        $totalRating = 0;
        foreach ($ratings as $rating) {
            if ($rating == "on")
                $totalRating++;
        }

        if($totalRating > 0 && isset($comment) && count($livre) > 0) {

            $date = new DateTime();
            $avis = new Avis();
            $avis->addComment($totalRating, $comment, $date->format('Y-m-d'), User::current()->getIdUtilisateur(), $idLivre);
    
    
        }
        return $response->withHeader('Location', '/detail/' . $idLivre)->withStatus(302);


    }
}
