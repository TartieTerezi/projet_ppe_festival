<?php

/**
 * Contrôleur de gestion des groupes
 * @author Crepiliere Axel
 * @version 2020
 */

namespace controleur;

use modele\dao\RepresentationDAO;
use vue\Representations\VueSaisieRepresentation;
use vue\Representations\VueDetailRepresentation;
use vue\Representations\VueListeRepresentation;
use vue\Representations\VueSupprimerRepresentation;
use modele\metier\Representation;
use controleur\GestionErreurs;
use modele\dao\Bdd;
use modele\dao\GroupeDAO;
use modele\dao\LieuDAO;

/**
 * Description of CtrlGroupes
 *
 * @author crepiliere
 */
class CtrlRepresentations extends ControleurGenerique {
    private $representation;


    /** controleur= groupes & action= defaut
     * Afficher la liste des representations      */
    public function defaut() {
        $this->liste();
    }
    
    /** controleur= representations & action= liste
     * Afficher la liste des representations      */
    public function liste() {
        $laVue = new VueListeRepresentation();
        $this->vue = $laVue;
        // On récupère un tableau composé de la liste des groupes
        Bdd::connecter();
        $laVue->setLesRepresentations($this->getTabRepresentations());
        parent::controlerVueAutorisee();
        $this->vue->setTitre("Festival - groupes");
        $this->vue->afficher();
    }
    
        /** controleur= representations & action=detail & id=identifiant_établissement
     * Afficher un representations d'après son identifiant     */
    public function detail() {
        $idRepres = $_GET["id"];
        $this->vue = new VueDetailRepresentation();
        // Lire dans la BDD les données de l'établissement à afficher
        Bdd::connecter();
        $this->vue->setUneRepresentation(RepresentationDAO::getOneById($idRepres));
        parent::controlerVueAutorisee();
        $this->vue->setTitre("Festival - Representation");
        $this->vue->afficher();
    }
    
    
    /** controleur= representations & action=modifier & id=identifiant_representation
     * Afficher un representations d'après son identifiant     */
    public function modifier() {
        $idRepres = $_GET["id"];
        $laVue = new VueSaisieRepresentation();
        $this->vue = $laVue; 
        $laVue->setActionRecue("modifier");
        $laVue->setActionAEnvoyer("validerModifier");
        // Lire dans la BDD les données de l'établissement à afficher
        Bdd::connecter();
        $this->vue->setUneRepresentation(RepresentationDAO::getOneById($idRepres));
        $laVue->setGroupes(GroupeDAO::getAll());
        $laVue->setLieux(LieuDAO::getAll());
        parent::controlerVueAutorisee();
        $this->vue->setTitre("Festival - Representation");
        $this->vue->afficher();
    }
        
    /** controleur= representations & action=validerModifier
     * modifier un representations dans la base de données d'après la saisie    */
    public function validerModifier() {
        $repre = new Representation($_POST['id'], $_POST['groupe'], $_POST['lieu'], $_POST['date'], $_POST['heuredebut'], $_POST['heurefin']);
        
        Bdd::connecter();
        // enregistrer les modifications pour la representation
        RepresentationDAO::update($_POST['id'], $repre);
        // revenir à la liste des Representations        
        header("Location: index.php?controleur=representations&action=liste");
    }
    
        /** controleur = representations & action = supprimer & id n° id de la representation
     *  supprime une representation dans la base de données apres confirmation */ 
    public function supprimer() {
        //récupération de l'ID de Representation
        $idR = $_GET["id"];
        //Création d'une vue à partir de la vue VueSuppriemrGroupes
        $laVue = new VueSupprimerRepresentation();
        $this->vue = $laVue;
        // Lire dans la BDD les données de la representation à supprimer
        Bdd::connecter();

        
        $this->vue->setUneRepresentation(RepresentationDAO::getOneById($idR));
        parent::controlerVueAutorisee();
        $this->vue->setTitre("Festival - groupes");
        $this->vue->afficher();
        
    }

    /** controleur= representations & action= validerSupprimer & id = n° type de chambre
     * supprimer un type de chambre dans la base de données après confirmation   */
    public function validerSupprimer() {
        Bdd::connecter();
        if (!isset($_GET["id"])) {
            // pas d'identifiant fourni
            GestionErreurs::ajouter("Il manque l'identifiant de la representation à supprimer");
        } else {
            // suppression de l'établissement d'après son identifiant
            RepresentationDAO::delete($_GET["id"]);
        }
        // retour à la liste des établissements
        header("Location: index.php?controleur=representations&action=liste");
    }
    
        /** controleur= representations & action=creer
     * Afficher le formulaire d'ajout d'une representation    */
    public function creer() {        
        Bdd::connecter();
        $laVue = new VueSaisieRepresentation();
        $this->vue = $laVue;
        $laVue->setActionRecue("creer");
        $laVue->setActionAEnvoyer("validerCreer");
        // En création, on affiche un formulaire vide
        /* @var Representation $repre */
        $repre = new Representation("", "", "", "", "", "");
        $laVue->setUneRepresentation($repre);
        $laVue->setGroupes(GroupeDAO::getAll());
        $laVue->setLieux(LieuDAO::getAll());
        parent::controlerVueAutorisee();
        $this->vue->setTitre("Festival - Representation");
        $this->vue->afficher();
    }

    /** controleur= representations & action=validerCreer
     * ajouter d'und representation dans la base de données d'après la saisie    */
    public function validerCreer() {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        Bdd::connecter();
        RepresentationDAO::insertValues($_POST['id'], $_POST['groupe'], $_POST['lieu'], $_POST['date'], $_POST['heuredebut'], $_POST['heurefin']);

        // revenir à la liste des établissements
        header("Location: index.php?controleur=representations&action=liste");
    }
    

    
    /*****************************************************************************
     * Méthodes permettant de préparer les informations à destination des vues
     ******************************************************************************/

    public function getTabRepresentations(): Array {
        $lesRepresentations = Array();
        $lesRepresentations = RepresentationDAO::getAll();
        return $lesRepresentations;
    }
   
}
