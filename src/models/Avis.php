<?php

namespace Elpommier\BookTrack\models;

use core\Database;
use PDO;

class Avis {
    public string $idAvis;

    public int $note;
    
    public string $commentaire;

    public string $date;

    public int $idUtilisateur;

    public int $idLivre;

    public static function fecthAvis() {
        $stmt = Database::connection()->query("SELECT * FROM Avis");
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetchAll();
    }

    public static function getAvgNote($idLivre) {
        $stmt = Database::connection()->query("SELECT note FROM Avis WHERE idLivre = :idLivre");
        $stmt->bindParam("idLivre", $idLivre);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        $stmt->execute();
        $notes = $stmt->fetchAll();

        $total = 0;

        foreach($notes as $note) {
            $total += $note;
        }
        return $total / count($notes);
    }
}