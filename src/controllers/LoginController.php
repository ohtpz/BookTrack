<?php

namespace Elpommier\BookTrack\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Elpommier\BookTrack\models\User;

class LoginController
{
    public function showForm(Request $request, Response $response): Response
    {
        ob_start();
        require_once __DIR__ . '/../../views/connexion/form.php';
        $content = ob_get_clean();
    
        $title = 'Connexion';
        ob_start();
        require_once __DIR__ . '/../../views/layout.php';
        $html = ob_get_clean();
    
        $response->getBody()->write($html);
        return $response;
    }
    

    public function handleLogin(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['mdpHash'])) {
            $_SESSION['user'] = $user;
            return $response->withHeader('Location', '/')->withStatus(302);
        } else {
            return $response->withHeader('Location', '/login?error=1')->withStatus(302);
        }
    }
}
