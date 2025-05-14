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
        $stmt->execute([
            ':idLivre' => $idLivre,
            ':idEmprunteur' => $idEmprunteur
        ]);
        return $stmt->fetchAll();
    }

    public function creerEmprunt(int $idLivre, int $idProprietaire, int $idEmprunteur, string $dateDebut, string $dateFin): void
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO Emprunt (dateDebut, dateFin, statut, idLivre, idEmprunteur, idProprietaire)
                VALUES (:dateDebut, :dateFin, 'attente', :idLivre, :idEmprunteur, :idProprietaire)
            ");
            $stmt->execute([
                ':dateDebut' => $dateDebut,
                ':dateFin' => $dateFin,
                ':idLivre' => $idLivre,
                ':idEmprunteur' => $idEmprunteur,
                ':idProprietaire' => $idProprietaire
            ]);
        } catch (\PDOException $e) {
            die("Erreur lors de la création de l'emprunt : " . $e->getMessage());
        }
    }

    public function changerStatut(int $idEmprunt, string $statut): bool
    {
        $stmt = $this->db->prepare("UPDATE Emprunt SET statut = ? WHERE idEmprunt = ?");
        return $stmt->execute([$statut, $idEmprunt]);
    }

    public function getDemandesRecues(int $idProprietaire): array
    {
        $sql = "SELECT e.*, u.nom, u.prenom, l.titre
                FROM Emprunt e
                JOIN Utilisateur u ON u.idUtilisateur = e.idEmprunteur
                JOIN Livre l ON l.idLivre = e.idLivre
                WHERE e.idProprietaire = ? AND e.statut = 'attente'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idProprietaire]);
        return $stmt->fetchAll();
    }

    public function getDemandesEnvoyees(int $idEmprunteur): array
    {
        $sql = "SELECT e.*, u.nom, u.prenom, l.titre
                FROM Emprunt e
                JOIN Utilisateur u ON u.idUtilisateur = e.idProprietaire
                JOIN Livre l ON l.idLivre = e.idLivre
                WHERE e.idEmprunteur = ? AND e.statut = 'attente'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idEmprunteur]);
        return $stmt->fetchAll();
    }

    public function getEmpruntsEnCours(int $idUtilisateur): array
    {
        $sql = "SELECT e.*, l.titre,
                       u1.nom AS nomProprio, u1.prenom AS prenomProprio,
                       u2.nom AS nomEmp, u2.prenom AS prenomEmp
                FROM Emprunt e
                JOIN Livre l ON l.idLivre = e.idLivre
                JOIN Utilisateur u1 ON u1.idUtilisateur = e.idProprietaire
                JOIN Utilisateur u2 ON u2.idUtilisateur = e.idEmprunteur
                WHERE (e.idProprietaire = :id1 OR e.idEmprunteur = :id2)
                  AND e.statut = 'en cours'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id1' => $idUtilisateur,
            ':id2' => $idUtilisateur
        ]);
        return $stmt->fetchAll();
    }
    public function getToutesDemandesRecues(int $idProprietaire): array
    {
        $sql = "SELECT e.*, u.nom, u.prenom, l.titre
                FROM Emprunt e
                JOIN Utilisateur u ON u.idUtilisateur = e.idEmprunteur
                JOIN Livre l ON l.idLivre = e.idLivre
                WHERE e.idProprietaire = ? AND e.statut != 'attente'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idProprietaire]);
        return $stmt->fetchAll();
    }
    
    public function getToutesDemandesEnvoyees(int $idEmprunteur): array
    {
        $sql = "SELECT e.*, u.nom, u.prenom, l.titre
                FROM Emprunt e
                JOIN Utilisateur u ON u.idUtilisateur = e.idProprietaire
                JOIN Livre l ON l.idLivre = e.idLivre
                WHERE e.idEmprunteur = ? AND e.statut != 'attente'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idEmprunteur]);
        return $stmt->fetchAll();
    }
    

    
}
