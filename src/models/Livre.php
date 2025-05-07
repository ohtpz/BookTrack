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

    public ?DateTime $dateParution;

    public ?string $statutLecture;

    public string $auteur;

    public static function fetchBooks() {
        $stmt = Database::connection()->query("SELECT idLivre, titre, illustration, auteur FROM Livre");
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        return $stmt->fetchAll();
    }
}