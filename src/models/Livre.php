<?php

namespace Elpommier\BookTrack\models;

use DateTime;
use core\Database;
use PDO;

class Livre {
    public int $idLivre;

    public string $titre;

    public ?string $ISBN;

    public $illustration;

    public ?string $dateParution;

    public ?string $statutLecture;

    public string $auteur;

    public static function fetchBooks() {
        $stmt = Database::connection()->query("SELECT idLivre, titre, illustration, auteur FROM Livre");
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetchAll();
    }

    public static function fetchBook($idLivre) {
        $stmt = Database::connection()->prepare("SELECT * FROM Livre WHERE idLivre = :idLivre");
        $stmt->bindParam("idLivre", $idLivre);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function fetchBooksFromBibliotheque($idBiblio) {
        $stmt = Database::connection()->prepare(
            "SELECT l.idLivre, l.titre, l.illustration, l.auteur 
             FROM Livre l
             JOIN Livre_Bibliotheque lb ON l.idLivre = lb.idLivre
             WHERE lb.idBiblio = :idBiblio"
        );
        $stmt->bindParam("idBiblio", $idBiblio);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}