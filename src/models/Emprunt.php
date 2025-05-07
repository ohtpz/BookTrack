<?php

namespace Elpommier\BookTrack\models;

use core\Database;
use PDO;

class Emprunt
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function getProprietairesDuLivre(int $idLivre, int $idEmprunteur): array
    {
        $sql = "
            SELECT DISTINCT u.*
            FROM Utilisateur u
            JOIN Bibliotheque b ON b.idUtilisateur = u.idUtilisateur
            JOIN Livre_Bibliotheque lb ON lb.idBiblio = b.idBiblio
            WHERE lb.idLivre = :idLivre AND u.idUtilisateur != :idEmprunteur
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['idLivre' => $idLivre, 'idEmprunteur' => $idEmprunteur]);
        return $stmt->fetchAll();
    }

    public function creerEmprunt(int $idLivre, int $idProprietaire, int $idEmprunteur, string $dateDebut, string $dateFin): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO Emprunt (dateDebut, dateFin, statut, idLivre, idEmprunteur, idProprietaire)
            VALUES (:dateDebut, :dateFin, 'attente', :idLivre, :idEmprunteur, :idProprietaire)
        ");
        $stmt->execute([
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'idLivre' => $idLivre,
            'idEmprunteur' => $idEmprunteur,
            'idProprietaire' => $idProprietaire
        ]);
    }

}
