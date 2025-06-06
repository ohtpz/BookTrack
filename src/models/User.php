<?php

namespace Elpommier\BookTrack\models;

use core\Database;
use PDO;

class User
{
    private ?int $idUtilisateur = null;
    private ?string $email = null;
    private ?string $mdpHash = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $imageProfil = null;
    private ?string $role = null;

    // --- MÃ©thodes ---

    public static function fetchAll(): array
    {
        $stmt = Database::connection()->prepare("SELECT * FROM Utilisateur");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetchAll();
    }

    public static function findByEmail(string $email): User|false
    {
        $stmt = Database::connection()->prepare("SELECT * FROM Utilisateur WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetch();
    }

    public static function create(array $data): bool
    {
        $stmt = Database::connection()->prepare("
            INSERT INTO Utilisateur (nom, prenom, email, mdpHash, imageProfil, role)
            VALUES (:nom, :prenom, :email, :mdpHash, :imageProfil, :role)
        ");
        return $stmt->execute($data);
    }

    public static function current(): ?User
    {
        static $current = null;

        if (!$current) {
            $email = $_SESSION['user']->email ?? null;
            if ($email !== null) {
                $current = static::findByEmail($email);
            }
        }

        return $current;
    }

    public function connect(): void
    {
        $_SESSION['user'] = $this->current();
        session_regenerate_id(true);
    }

    public function logout(): void
    {
        $_SESSION['user'] = null;
    }

    public function verifyAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMemberOfBibliotheque(int $idBiblio): bool
    {
        $stmt = Database::connection()->prepare("
            SELECT * FROM Bibliotheque WHERE idUtilisateur = :idUtilisateur AND idBiblio = :idBiblio
        ");
        $stmt->execute([
            'idUtilisateur' => $this->getIdUtilisateur(),
            'idBiblio' => $idBiblio
        ]);
        return $stmt->fetch() !== false;
    }

    // --- Getters ---

    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function getImageProfil(): ?string
    {
        return $this->imageProfil;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function getMdpHash(): string
    {
        return $this->mdpHash ?? '';
    }
}