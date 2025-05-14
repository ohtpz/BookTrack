<?php

namespace Elpommier\BookTrack\models;

use core\Database;
use PDO;

class Bibliotheque {

    // ID de la bibliothèque
    public int $idBiblio;

    // ID de l'utilisateur qui possède la bibliothèque
    public int $idUtilisateur;

    // Nom de la bibliothèque
    public string $nom;

    // Listes des livres (en ID) dans la bibliothèque
    public array $livres = [];

    // Recupère la liste des bibliothèques d'un utilisateur
    public static function fetchBibliothequesByUserId(int $idUtilisateur): array {
        $stmt = Database::connection()->prepare(
            "SELECT idBiblio, idUtilisateur, nom 
             FROM Bibliotheque 
             WHERE idUtilisateur = :idUtilisateur"
        );
        $stmt->execute(['idUtilisateur' => $idUtilisateur]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
        return $stmt->fetchAll();
    }

    public static function createBibliotheque(int $idUtilisateur, string $nom): void {
        $stmt = Database::connection()->prepare(
            "INSERT INTO Bibliotheque (idUtilisateur, nom) 
             VALUES (:idUtilisateur, :nom)"
        );
        $stmt->execute([
            'idUtilisateur' => $idUtilisateur,
            'nom' => $nom
        ]);
    }

    public function loadLivres(): void {
        $stmt = Database::connection()->prepare(
            "SELECT l.* 
             FROM Livre l
             JOIN Biblio_Livre bl ON l.idLivre = bl.idLivre
             WHERE bl.idBiblio = :idBiblio"
        );
        $stmt->execute(['idBiblio' => $this->idBiblio]);
        $this->livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public static function ajouterLivre(int $idLivre): void {
        $stmt = Database::connection()->prepare(
            "INSERT IGNORE INTO Biblio_Livre (idBiblio, idLivre) VALUES (:idBiblio, :idLivre)"
        );
        $stmt->execute([
            'idBiblio' => $this->idBiblio,
            'idLivre' => $idLivre
        ]);
    }

   
    public static function supprimerLivre(int $idLivre): void {
        $stmt = Database::connection()->prepare(
            "DELETE FROM Biblio_Livre WHERE idBiblio = :idBiblio AND idLivre = :idLivre"
        );
        $stmt->execute([
            'idBiblio' => $this->idBiblio,
            'idLivre' => $idLivre
        ]);
    }
}
