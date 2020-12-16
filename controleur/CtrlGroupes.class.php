<?php

/**
 * Contrôleur de gestion des groupes
 * @author Crepiliere Axel
 * @version 2020
 */

namespace controleur;

use controleur\GestionErreurs;
use modele\dao\GroupeDAO;
use modele\dao\AttributionDAO;
use modele\metier\Groupe;
use modele\dao\Bdd;
use vue\groupes\VueListeGroupes;
use vue\groupes\VueSaisieGroupe;
use vue\groupes\VueSupprimerGroupes;
use vue\groupes\VueDetailGroupe;


/**
 * Description of CtrlGroupes
 *
 * @author crepi
 */
class CtrlGroupes extends ControleurGenerique {
    
    /** controleur= groupes & action= defaut
     * Afficher la liste des établissements      */
    public function defaut() {
        $this->liste();
    }
    
    /** controleur= groupes & action= liste
     * Afficher la liste des établissements      */
    public function liste() {
        $laVue = new VueListeGroupes();
        $this->vue = $laVue;
        // On récupère un tableau composé de la liste des groupes
        Bdd::connecter();
        $laVue->setLesGroupes($this->getTabGroupes());
        parent::controlerVueAutorisee();
        $this->vue->setTitre("Festival - groupes");
        $this->vue->afficher();
    }
    
    /*****************************************************************************
     * Méthodes permettant de préparer les informations à destination des vues
     ******************************************************************************/

    public function getTabGroupes(): Array {
        $lesGroupes = Array();
        $lesGroupes = GroupeDAO::getAll();
        return $lesGroupes;
    }
    public function creer() {
        //Création d'une nouvelle vue à partir de la vue "VueSaisieGroupe"
        $laVue = new VueSaisieGroupe();
        $this->vue = $laVue;
        // Onmentionne bien que l'action est de créer afin de rendre la zone de texte d'"ID" visible
        $laVue->setActionRecue("creer");
        $laVue->setActionAEnvoyer("validerCreer");
        $laVue->setMessage("Nouvel établissement");
        // En création, on affiche un formulaire vide
       
        $unGroupe = new Groupe("", "", "", "", "", "", "");
        $laVue->setUnGroupe($unGroupe);
        parent::controlerVueAutorisee();
        $this->vue->setTitre("Festival - groupes");
        $this->vue->afficher();
    }

    /** controleur= groupes & action=validerCreer
     * ajouter d'un établissement dans la base de données d'après la saisie    */
    public function validerCreer() {
        Bdd::connecter();
        /* @var Groupe $unGroupe  : récupération du contenu du formulaire et instanciation d'un établissement */
        $unGroupe = new Groupe($_REQUEST['id'], $_REQUEST['nom'], $_REQUEST['identite'], $_REQUEST['adresse'], $_REQUEST['nbPers'], $_REQUEST['nomPays'], $_REQUEST['hebergement']);
        // vérifier la saisie des champs obligatoires et les contraintes d'intégrité du contenu
        // pour un formulaire de création (paramètre n°1 = true)
        $this->verifierDonneesEtab($unGroupe, true);
        if (GestionErreurs::nbErreurs() == 0) {
            // s'il ny a pas d'erreurs,
            // enregistrer l'établissement
            GroupeDAO::insert($unGroupe);
            // revenir à la liste des établissements
            header("Location: index.php?controleur=groupes&action=liste");
        } else {
            // s'il y a des erreurs, 
            // réafficher le formulaire de création
            $laVue = new VueSaisieGroupe();
            $this->vue = $laVue;
            $laVue->setActionRecue("creer");
            $laVue->setActionAEnvoyer("validerCreer");
            $laVue->setMessage("Nouveau Groupe");
            $laVue->setUnGroupe($unGroupe);
            parent::controlerVueAutorisee();
            $laVue->setTitre("Festival - groupe");
            $this->vue->afficher();
        }
    }
    
    /** controleur= etablissements & action=modifier $ id=identifiant de l'établissement à modifier
     * Afficher le formulaire de modification d'un établissement     */
    public function modifier() {
        //récupération de l'ID du groupe
        $idGroupe = $_GET["id"];
        //Création d'une vue à partir de la vue "VueSaisieGroupe"
        $laVue = new VueSaisieGroupe();
        $this->vue = $laVue;
        // Lire dans la BDD les données des groupes à modifier
        Bdd::connecter();
        //recherche de la table à modifier
        $leGroupe = GroupeDAO::getOneById($idGroupe);
        $this->vue->setUnGroupe($leGroupe);
        $laVue->setActionRecue("modifier");
        $laVue->setActionAEnvoyer("validerModifier");
        $laVue->setMessage("Modifier le Groupe : " . $leGroupe->getNom() . " (" . $leGroupe->getId() . ")");
        parent::controlerVueAutorisee();
        $this->vue->setTitre("Festival - groupe");
        //affichage des informations actuelles du groupe afin qu'elles puissent être modifiés 
        $this->vue->afficher();
    }
    
     /** controleur= etablissements & action=validerModifier
     * modifier un établissement dans la base de données d'après la saisie    */
    public function validerModifier() {
        Bdd::connecter();
        /* @var Etablissement $unEtab  : récupération du contenu du formulaire et instanciation d'un établissement */
        $unGroupe = new Groupe($_REQUEST['id'], $_REQUEST['nom'], $_REQUEST['identite'], $_REQUEST['adresse'], $_REQUEST['nbPers'], $_REQUEST['nomPays'], $_REQUEST['hebergement']);

        // vérifier la saisie des champs obligatoires et les contraintes d'intégrité du contenu
        // pour un formulaire de modification (paramètre n°1 = false)
        $this->verifierDonneesGroupe($unGroupe, false);
        if (GestionErreurs::nbErreurs() == 0) {
            // s'il ny a pas d'erreurs,
            // enregistrer les modifications pour l'établissement
            GroupeDAO::update($unGroupe->getId(), $unGroupe);
            // revenir à la liste des établissements
            header("Location: index.php?controleur=groupes&action=liste");
        } else {
            // s'il y a des erreurs, 
            // réafficher le formulaire de modification
            $laVue = new VueSaisieGroupe();
            $this->vue = $laVue;
            $laVue->setUnGroupe($unGroupe);
            $laVue->setActionRecue("modifier");
            $laVue->setActionAEnvoyer("validerModifier");
            $laVue->setMessage("Modifier le groupe : " . $unGroupe->getNom() . " (" . $unGroupe->getId() . ")");
            parent::controlerVueAutorisee();
            $laVue->setTitre("Festival - groupe");
            $this->vue->afficher();
        }
    }
    
     public function detail() {
        $idGroupe = $_GET["id"];
        $this->vue = new VueDetailGroupe();
        // Lire dans la BDD les données du groupe à afficher
        Bdd::connecter();
        $this->vue->setUnGroupe(GroupeDAO::getOneById($idGroupe));
        parent::controlerVueAutorisee();
        $this->vue->setTitre("Festival - Groupes");
        $this->vue->afficher();
    }
    
    public function supprimer() {
        //récupération de l'ID du groupe
        $idG = $_GET["id"];
        //Création d'une vue à partir de la vue VueSuppriemrGroupes
        $laVue = new VueSupprimerGroupes();
        $this->vue = $laVue;
        // Lire dans la BDD les données de l'établissement à supprimer
        Bdd::connecter();
        $laVue->setUnGroupe(GroupeDAO::getOneById($idG));
        parent::controlerVueAutorisee();
        $this->vue->setTitre("Festival - groupes");
        $this->vue->afficher();
    }

    /** controleur= typesChambres & action= validerSupprimer & id = n° type de chambre
     * supprimer un type de chambre dans la base de données après confirmation   */
    public function validerSupprimer() {
        Bdd::connecter();
        if (!isset($_GET["id"])) {
            // pas d'identifiant fourni
            GestionErreurs::ajouter("Il manque l'identifiant du groupe à supprimer");
        } else {
            // suppression de l'établissement d'après son identifiant
            GroupeDAO::delete($_GET["id"]);
        }
        // retour à la liste des établissements
        header("Location: index.php?controleur=groupes&action=liste");
    }

   
    private function verifierDonneesGroupe(Groupe $unGroupe, bool $creation) {
        // Vérification des champs obligatoires.
        // Dans le cas d'une création, on vérifie aussi l'id
        if (($creation && $unGroupe->getId() == "") || $unGroupe->getNom() == "" || $unGroupe->getNbPers() == "" || $unGroupe->getNomPays() == "" || $unGroupe->getHebergement() == "") {
            GestionErreurs::ajouter('Chaque champ suivi du caractère * est obligatoire');
        }
        // En cas de création, vérification du format de l'id et de sa non existence
        if ($creation && $unGroupe->getId() != "") {
            // Si l'id est constitué d'autres caractères que de lettres non accentuées 
            // et de chiffres, une erreur est générée
            if (!estAlphaNumerique($unGroupe->getId())) {
                GestionErreurs::ajouter("L'identifiant doit comporter uniquement des lettres non accentuées et des chiffres");
            } else {
                if (GroupeDAO::isAnExistingId($unGroupe->getId())) {
                    GestionErreurs::ajouter("Le Groupe " . $unGroupe->getId() . " existe déjà");
                }
            }
        }
        // Vérification qu'un établissement de même nom n'existe pas déjà (id + nom si création)
        if ($unGroupe->getNom() != "" && GroupeDAO::isAnExistingName($creation, $unGroupe->getId(), $unGroupe->getNom())) {
            GestionErreurs::ajouter("Le groupe " . $unGroupe->getNom() . " existe déjà");
        }
        
    }
}
