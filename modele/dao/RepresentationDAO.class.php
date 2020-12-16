<?php

namespace modele\dao;

use modele\metier\Representation;
use \PDO;
use modele\metier\Groupe;
use modele\metier\Lieu;

/**
 * Description of RepresentationDAO
 * Classe métier :  Representation
 * @author Bdesmonceaux
 * @version 2020
 */
class RepresentationDAO {

    /**
     * Instancier un objet de la classe Representation à partir d'un enregistrement de la table ATTRIBUTION
     * @param array $enreg
     * @return Attribution
     */
    protected static function enregVersMetier(array $enreg) {
        $id = $enreg['ID'];
        $idGroupe = $enreg['IDGROUPE'];
        $idLieu = $enreg['IDLIEU'];
        $date = $enreg['DATEREPRES'];
        $heureDebut = $enreg['HEUREDEBUT'];
        $heureFin = $enreg['HEUREFIN'];
        // construire les objets Offre et Groupe à partir de leur identifiant       
        $objetLieu = LieuDAO::getOneById($idLieu);
        $objetGroupe = GroupeDAO::getOneById($idGroupe);
        // instancier l'objet Attribution
        $objetMetier = new Representation($id, $objetGroupe, $objetLieu, $date, $heureDebut, $heureFin);
        return $objetMetier;
    }

    /**
     * Complète une requête préparée
     * les paramètres de la requête associés aux valeurs des attributs d'un objet métier
     * @param Representation $objetMetier
     * @param PDOStatement $stmt
     */
    protected static function metierVersEnreg(Representation $objetMetier, \PDOStatement $stmt) {
        $stmt->bindValue(':idGroupe', $objetMetier->getGroupe(),PDO::PARAM_STR);
        $stmt->bindValue(':id', $objetMetier->getId(),PDO::PARAM_STR);
        $stmt->bindValue(':idLieu', $objetMetier->getLieu(),PDO::PARAM_STR);       
        $stmt->bindValue(':date', $objetMetier->getDate(),PDO::PARAM_STR);
        $stmt->bindValue(':heuredebut', $objetMetier->getHeuredebut(),PDO::PARAM_STR);
        $stmt->bindValue(':heurefin', $objetMetier->getHeurefin(),PDO::PARAM_STR);   
    }

    /**
     * Retourne la liste de toutes les représentations
     * @return array tableau d'objets de type Representation
     */
    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Representation";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

    /**
     * Liste des objets Representation concernant une id donné
     * @param string $id : identifiant de la Representation que l'on cherche
     * @return array : tableau des Representations(s)
     */
    public static function getOneById($id) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Representation WHERE ID = :id";
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
     * Liste des objets Representation concernant une date donné
     * @param string $dat : date de la Representation que l'on cherche
     * @return array : tableau des Representations(s)
     */
    public static function getAllByDate($date) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Representation WHERE dateRepres = :date";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':date', $date);
        $ok = $stmt->execute();
        // attention, $ok = true pour un select ne retournant aucune ligne
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

    /**
     * Liste des objets Representation concernant un Lieu donné
     * @param string $idLieu : identifiant du lieu dont on filtre les representations
     * @return array : tableau de Representations(s)
     */
    public static function getAllByIdLieu($idLieu) {
        $lesObjets = array();
        $requete = "SELECT * FROM Representation WHERE IDLIEU = :idLieu";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':idLieu', $idLieu);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }
    /**
     * Liste des objets Representation concernant un Groupe donné
     * @param string $idGroupe : identifiant du groupe dont on filtre les representations
     * @return array : tableau de Representation(s)
     */
     public static function getAllByIdGroupe($idGroupe) {
        $lesObjets = array();
        $requete = "SELECT * FROM Representation WHERE IDGROUPE = :idGroupe";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':idGroupe', $idGroupe);
        $ok = $stmt->execute();
        if ($ok) {
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }
   
    //Suppression d'un objet dans la table Representation en fonction du paramètre
    //@param $id de l'objet que l'on veut enlevef de la base de données
    //@return boolean =true si la suppression a été correcte
    
    public static function delete($id) {
        $ok = false;
        $requete = "DELETE FROM Representation "
                . " WHERE ID=:id ";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);      
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

    public static function insertValues($id, $idGroupe, $idLieu, $date, $heuredebut, $heurefin) {
        $ok = false;
        $requete = "INSERT INTO Representation "
                . "  VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $idGroupe);
        $stmt->bindParam(3, $idLieu);
        $stmt->bindParam(4, $date);
        $stmt->bindParam(5, $heuredebut);
        $stmt->bindParam(6, $heurefin);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }
      
    /**
     * met à jour la table
     * @param Representation $repre
     * @param int $id
     */
    public static function update($id,  $repre) {
      $ok = false;
      
      //$requete = "UPDATE Representation SET idGroupe= :idgroupe , idLieu= :idlieu, dateRepres= :date,heureDebut = :heuredebut,heureFin= :heurefin  WHERE ID= :id";
      $requete = "UPDATE Representation SET `idGroupe` = ?, `idLieu` = ?, `dateRepres` = ?, `heureDebut` = ?, `heureFin` = ? WHERE id = ?;";
      $stmt = Bdd::getPdo()->prepare($requete);
      
      //$stmt->bindValue('1', $repre->getGroupe(),PDO::PARAM_STR);
      $stmt->bindValue(1, $repre->getGroupe());
      $stmt->bindValue(2, $repre->getLieu());       
      $stmt->bindValue(3, $repre->getDate());
      $stmt->bindValue(4, $repre->getHeuredebut());
      $stmt->bindValue(5, $repre->getHeurefin());
      $stmt->bindValue(6, $repre->getId());
      
      $ok = $stmt->execute();
      
      return ($ok && $stmt->rowCount() > 0);
    }    
}
