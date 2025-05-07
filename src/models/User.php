<?php

namespace Elpommier\BookTrack\models;

use core\Database;
use PDO;

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM Utilisateur WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO Utilisateur (nom, prenom, email, mdpHash, imageProfil, role)
            VALUES (:nom, :prenom, :email, :mdpHash, :imageProfil, :role)
        ");
        return $stmt->execute($data);
    }
}
