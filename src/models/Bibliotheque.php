<?php

namespace Elpommier\BookTrack\models;

use core\Database;
use PDO;

class Bibliotheque {
    public int $idBiblio;

    public int $idUtilisateur;

    public array $idLivre = [];

    public static function fetchBooksByUser(int $idUtilisateur) {
        $stmt = Database::connection()->prepare("SELECT idLivre, titre, illustration, auteur FROM Livre l JOIN Livre_Bibliotheque lb ON l.idLivre = lb.idLivre WHERE lb.idBiblio = :idBiblio");
        $stmt->execute(['idBiblio' => $idUtilisateur]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Livre::class);
        return $stmt->fetchAll();
    }
}