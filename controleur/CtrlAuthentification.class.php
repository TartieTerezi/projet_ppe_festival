<?php
/**
 * Contrôleur fonction d'authentification
 * @author prof
 * @version 2018
 */

namespace controleur;

use controleur\GestionErreurs;
use controleur\GestionParametres;

use modele\dao\UtilisateurDAO;
use modele\metier\Utilisateur;
use modele\dao\Bdd;

use vue\accueil\VueAccueil;
use vue\authentification\VueSAuthentifier;

class CtrlAuthentification extends ControleurGenerique {

    /** controleur= authentification & action= defaut  */
    function defaut() {
        $this->saisirIdentification();
    }
    

    /** controleur= authentification & action=saisirIdentification
     * Afficher le formulaire d'identification d'un utilisateur     */
    public function saisirIdentification() {
        $laVue = new VueSAuthentifier();
        $this->vue = $laVue;
        $this->vue->setTitre("Festival - authentification");

        $laVue->setMessage("Identification");
        $laVue->setLogin("");
        $laVue->setMdp("");
        
        if (SessionAuthentifiee::estConnecte()) {
            parent::controlerVueAutorisee();
        }else{
            parent::controlerVueNonAutorisee();
        }
        
        $this->vue->afficher();
    }

    /** controleur= authentification & action= authentifier
     * vérifier l'identité de l'utilisateur dans la BDD    */
    public function authentifier() {
        Bdd::connecter();
        $login = $_REQUEST['login'];
        $mdp = $_REQUEST['mdp'];
        $utilisateurConnecte = $this->verifierDonneesIdentification($login, $mdp);
        $mdpHash = $utilisateurConnecte->getMdp();
        if (GestionErreurs::nbErreurs() == 0) {
            // L'utilisateur est authentifiée
            // Initialiser la session
            SessionAuthentifiee::seConnecter($utilisateurConnecte);
            // Vérifie si le mot de passe est haché
            if (password_hash($mdp, PASSWORD_DEFAULT) != $mdpHash) {
                $requete = "UPDATE Utilisateur SET `mdp`='".password_hash($mdp, PASSWORD_DEFAULT)."' WHERE `id`=".$utilisateurConnecte->getId();
                $stmt = Bdd::getPdo()->prepare($requete);
                $ok = $stmt->execute();
            } 
             // Afficher l'écran d'accueil
             header("Location: index.php");
        } else {
            // Erreur d'identification
            // Revenir à la demande de connexion
            $laVue = new VueSAuthentifier();
            $this->vue = $laVue;
            $this->vue->setTitre("Festival - authentification");
 
            $laVue->setMessage("Identification");
            $laVue->setLogin($login);
            $laVue->setMdp($mdp);
            parent::controlerVueNonAutorisee();
            $this->vue->afficher();
        }
    }

    /**
     * controleur= authentification & action= seDeconnecter
     * = mettre fin à la session   */
    public function seDeconnecter() {
        // Mettre fin à la session
        SessionAuthentifiee::seDeconnecter();
        // Afficher l'écran d'accueil
        header("Location: index.php");
    }
    
    /*********************************************************************************************************
     *  Méthodes privées
     *********************************************************************************************************/

    /**
     * Vérification des données saisies dans le formulaire d'identification
     * @param string $loginSaisi
     * @param string $mdpSaisi
     * @return Utilisateur : l'utilisateur concerné si le loginet le mot de passe correspondent; =null sinon
     * EFFET DE BORD : génération de messages d'erreur dans la variable de session
     */
    private function verifierDonneesIdentification($loginSaisi, $mdpSaisi) {
        $unUtilisateur = null;
        if ($loginSaisi == "") {
            GestionErreurs::ajouter('Il faut saisir un login');
        } else {
            /* @var $unUtilisateur Utilisateur  */
            $unUtilisateur = UtilisateurDAO::getOneByLogin($loginSaisi);
            if (is_null($unUtilisateur)) {
                // Aucun utilisateur inscrit n'a ce login
                GestionErreurs::ajouter('login inconnu');
            } else {
                // L'utilisateur (login) existe
                $mdpValide = $unUtilisateur->getMdp();
                               
                // Vérifie que le mot de passe correspond à celui dans la BDD et s'il y a un hachage
                if($mdpValide != $mdpSaisi && !password_verify($mdpSaisi, $mdpValide)){
                    GestionErreurs::ajouter('mot de passe incorrect ');
                }
            }
        }
        return $unUtilisateur;
    }
}
