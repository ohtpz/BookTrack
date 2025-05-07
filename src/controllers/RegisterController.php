<?php

namespace Elpommier\BookTrack\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Elpommier\BookTrack\models\User;

class RegisterController
{
    public function showForm(Request $request, Response $response): Response
    {
        ob_start();
        require_once __DIR__ . '/../../views/inscription/form.php';
        $content = ob_get_clean();

        $title = 'Inscription';
        ob_start();
        require_once __DIR__ . '/../../views/layout.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    public function handleRegister(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $files = $request->getUploadedFiles();

        $nom = trim($data['nom'] ?? '');
        $prenom = trim($data['prenom'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
            return $response->withHeader('Location', '/register?error=Champs+obligatoires+manquants')->withStatus(302);
        }

        $userModel = new User();
        if ($userModel->findByEmail($email)) {
            return $response->withHeader('Location', '/register?error=Email+d%C3%A9j%C3%A0+utilis%C3%A9')->withStatus(302);
        }

        // Gestion de l’image
        $imagePath = '/img/default/defaultUser.png'; // par défaut
        if (!empty($files['imageProfil']) && $files['imageProfil']->getError() === UPLOAD_ERR_OK) {
            $image = $files['imageProfil'];
            $extension = pathinfo($image->getClientFilename(), PATHINFO_EXTENSION);
            $filename = uniqid('user_') . '.' . $extension;
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $image->moveTo($uploadDir . $filename);
            $imagePath = '/uploads/' . $filename;
        }

        // Création de l’utilisateur
        $userModel->create([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mdpHash' => password_hash($password, PASSWORD_DEFAULT),
            'imageProfil' => $imagePath,
            'role' => 'utilisateur'
        ]);

        return $response->withHeader('Location', '/login')->withStatus(302);
    }
}
