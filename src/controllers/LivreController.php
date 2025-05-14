<?php 

namespace Elpommier\BookTrack\controllers;

use Elpommier\BookTrack\models\Livre;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class LivreController extends BaseController {
    public function getBooks(Request $request, Response $response) {

        $livres = Livre::fetchBooks();
        $data = [
            "title" => "Accueil",
            "livres" => $livres,

        ];

        $render = new PhpRenderer(__DIR__."/../../views/", $data);
        $render->setLayout("layout.php");
        return $render->render($response, "accueil/index.php");
    }

    public function getBook(Request $request, Response $response, array $args) {

        $idLivre = (int) $args['idLivre'];

        $livre = Livre::fetchBook($idLivre);

        if(count($livre) > 0) {
            $data = [
                "title" => "Détail de ".$livre[0]->titre,
                "livre" => $livre[0]
            ];
    
            $render = new PhpRenderer(__DIR__."/../../views/", $data);
            $render->setLayout("layout.php");
            return $render->render($response, "detail/detail.php");
        }
        else 
            return $response->withHeader('Location', '/')->withStatus(302);
    }
}