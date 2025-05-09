<?php
namespace Elpommier\BookTrack\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class BaseController {

    public function home(Request $request, Response $response) {
        $data = [
            "title" => "Accueil"
        ];

        $render = new PhpRenderer(__DIR__."/../../views/", $data);
        $render->setLayout("layout.php");
        return $render->render($response, "accueil/index.php");
    }
}
