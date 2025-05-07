<?php 

namespace Elpommier\BookTrack\controllers;

use Elpommier\BookTrack\models\Livre;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class LivreController {
    public function getBooks(Request $request, Response $response) {

        $livres = Livre::fetchBooks();
        $data = [
            "title" => "Accueil",
            "livres" => $livres
        ];

        $render = new PhpRenderer(__DIR__."/../../views/", $data);
        $render->setLayout("layout.php");
        return $render->render($response, "accueil/index.php");
    }
}