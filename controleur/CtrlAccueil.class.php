<?php
/**
 * Contrôleur de la page d'accueil
 * @author prof
 * @version 2018
 */

namespace controleur;

use vue\accueil\VueAccueil;
use vue\accueil\VueActionNonAutorisee;

class CtrlAccueil extends ControleurGenerique {

    /** controleur= accueil & action= defaut
     * Afficher la page d'accueil      */
    function defaut() {
        $this->vue = new VueAccueil();
        $this->vue->setTitre("Festival - accueil");
        if (SessionAuthentifiee::estConnecte()) {
            parent::controlerVueAutorisee();
        }else{
            parent::controlerVueNonAutorisee();
        }
        $this->vue->afficher();

    }
    
     /** controleur= accueil & action= refuser
     * En cas de tentative d'accès à une fonctionnalité nécessitant authentification  */
    function refuser() {
        $this->vue = new VueActionNonAutorisee();
        $this->vue->setTitre("Festival - accueil");
        parent::controlerVueNonAutorisee();
        $this->vue->afficher();
    }

}
