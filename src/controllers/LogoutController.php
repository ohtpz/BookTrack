<?php

namespace Elpommier\BookTrack\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LogoutController
{
    public function logout(Request $request, Response $response): Response
    {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 3600);

        return $response->withHeader('Location', '/login')->withStatus(302);
    }
}
