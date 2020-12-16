<?php
namespace modele\dao;

use modele\metier\Lieu;
use PDOStatement;
use PDO;

/**
 * Description of LieuDAO
 * Classe métier :  Lieu
 * @author prof
 * @version 2017
 */
class LieuDAO {


    /**
     * Instancier un objet de la classe Lieu à partir d'un enregistrement de la table LIEU
     * @param array $enreg
     * @return unLieu
     */
    protected static function enregVersMetier(array $enreg) {
        $id = $enreg['ID'];
        $nom = $enreg['NOM'];
        $adresse = $enreg['ADRESSE'];
        $capacite = $enreg['CAPACITE'];      
        $unLieu = new Lieu($id, $nom, $adresse, $capacite);

        return $unLieu;
    }
    /**
     * Valorise les paramètres d'une requête préparée avec l'état d'un objet Lieu
     * @param Lieu $objetMetier un lieu
     * @param PDOStatement $stmt requête préparée
     */
    protected static function metierVersEnreg(Lieu $objetMetier, PDOStatement $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        // Note : bindParam requiert une référence de variable en paramètre n°2 ; 
        // avec bindParam, la valeur affectée à la requête évoluerait avec celle de la variable sans
        // qu'il soit besoin de refaire un appel explicite à bindParam
        $stmt->bindValue(':id', $objetMetier->getId());
        $stmt->bindValue(':nom', $objetMetier->getNom());
        $stmt->bindValue(':adresse', $objetMetier->getAdresse());
        $stmt->bindValue(':capacite', $objetMetier->getCapacite());
        
    }


    /**
     * Retourne la liste de tous les lieus
     * @return array tableau d'objets de type Lieu
     */
    public static function getAll() {
        $lesLieus = array();
        $requete = "SELECT * FROM Lieu ORDER BY NOM";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            // Tant qu'il y a des enregistrements dans la table
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //ajoute un nouveau lieu au tableau
                $lesLieus[] = self::enregVersMetier($enreg);
            }
        }
        return $lesLieus;
    }

    /**
     * Recherche un lieu selon la valeur de son identifiant
     * @param string $idLieu
     * @return Lieu le lieu trouvé ; null sinon
     */
    public static function getOneById($id) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Lieu WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        // attention, $ok = true pour un select ne retournant aucune ligne
        if ($ok && $stmt->rowCount() > 0) {
            $objetConstruit = self::enregVersMetier($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $objetConstruit;
    }


    /**
     * Retourne la liste des lieus attribués à un établissement donné
     * @param string $idLieu
     * @return array tableau d'éléments de type Lieu
     */
    public static function getAllByRepresentation($id) {
        $lesLieus = array();  // le tableau à retourner
        $requete = "SELECT * FROM Lieu l
                    WHERE ID IN (
                    SELECT DISTINCT ID FROM Representation r
                            INNER JOIN Lieu l ON r.IDLIEU = l.ID 
                            WHERE r.IDLIEU=:id
                    )";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        if ($ok) {
            // Tant qu'il y a des enregistrements dans la table
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //ajoute un nouveau lieu au tableau
                $lesLieus[] = self::enregVersMetier($enreg);
            }
        } 
        return $lesLieus;
    }

    
   
    /**
     * Insérer un nouvel enregistrement dans la table à partir de l'état d'un objet métier
     * @param Lieu $objet objet métier à insérer
     * @return boolean =FALSE si l'opération échoue
     */
    public static function insert(Lieu $objet) {
        $requete = "INSERT INTO Lieu VALUES (:id, :nom, :adresse, :capacite)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier
     * @param string identifiant de l'enregistrement à mettre à jour
     * @param Lieu $objet objet métier à mettre à jour
     * @return boolean =FALSE si l'opérationn échoue
     */
    public static function update($id, Lieu $objet) {
        $ok = false;
        $requete = "UPDATE  Lieu SET NOM=:nom, ADRESSE=:adresse, CAPACITE=:capacite
           WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }
    
    /**
     * Détruire un enregistrement de la table LIEU d'après son identifiant
     * @param string identifiant de l'enregistrement à détruire
     * @return boolean =TRUE si l'enregistrement est détruit, =FALSE si l'opération échoue
     */
    public static function delete($id) {
        $ok = false;
        $requete = "DELETE FROM Lieu WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }

    /**
     * Permet de vérifier s'il existe ou non un Lieu ayant déjà le même identifiant dans la BD
     * @param string $id identifiant du lieu à tester
     * @return boolean =true si l'id existe déjà, =false sinon
     */
    public static function isAnExistingId($id) {
        $requete = "SELECT COUNT(*) FROM LIEU WHERE ID=:id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
    
    public static function isAnExistingName($nom) {
        $requete = "SELECT COUNT(*) FROM Lieu WHERE NOM=:nom";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
    
    
}
