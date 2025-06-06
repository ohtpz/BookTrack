<?php

namespace Elpommier\BookTrack\models;

use core\Database;
use DateTime;
use PDO;

class Avis {
    public string $idAvis;

    public int $note;
    
    public string $commentaire;

    public $date;

    public int $idUtilisateur;

    public int $idLivre;

    public static function fetchAvis($idLivre) {
        $stmt = Database::connection()->prepare("SELECT * FROM Avis WHERE idLivre = :idLivre");
        $stmt->bindParam("idLivre", $idLivre);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function addComment(int $note, string $commentaire, string $date, int $idUtilisateur, int $idLivre): void {
        $stmt = Database::connection()->prepare(
            "INSERT INTO Avis (note, commentaire, date, idUtilisateur, idLivre) 
             VALUES (:note, :commentaire, :date, :idUtilisateur, :idLivre)"
        );
        $stmt->execute([
            'note' => $note,
            'commentaire' => $commentaire,
            'date' => $date,
            'idUtilisateur' => $idUtilisateur,
            'idLivre' => $idLivre
        ]);
    }
    
}