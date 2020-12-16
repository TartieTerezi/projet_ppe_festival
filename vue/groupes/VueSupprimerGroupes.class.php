<?php

namespace vue\groupes;

use vue\VueGenerique;
use modele\metier\Groupe;

/**
 * Description Page de suppression d'un type de chambre donné
 * @author prof
 * @version 2018
 */
class VueSupprimerGroupes extends VueGenerique {

// Création de l'objet unGroupe
    private $unGroupe;

    public function construct() {
        parent::construct();
    }

    public function afficher() {
        //affichage de l'entete
        include $this->getEntete();
        ?>
        <?php // Message de confirmation de suppresion d'un groupe ?>
        <br><center>Voulez-vous vraiment supprimer le groupe 
        <?php //Récupération de l'ID et du Nom du groupe ?>
        <?= $this->unGroupe->getId() ?> <?= $this->unGroupe->getNom() ?> ?
            <h3><br>
                <?php //Si le choix est "oui", l'information est envoyé vers le controleur qui demandera la suppression ?>
                <a href="index.php?controleur=groupes&action=validerSupprimer&id=<?= $this->unGroupe->getId() ?>">
                    Oui</a>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <?php //Si le choix est "non", on est redirigé vers la liste des groupes ?>
                <a href="index.php?controleur=groupes">Non</a></h3></center>
        <?php
        // affichage du pied de page
        include $this->getPied();
    }
    // GETTER AND SETTER ------------------------------
    public function getUnGroupe(): Groupe {
        return $this->unGroupe;
    }

    public function getActionRecue() {
        return $this->actionRecue;
    }

    public function getActionAEnvoyer() {
        return $this->actionAEnvoyer;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setUnGroupe(Groupe $unGroupe) {
        $this->unGroupe = $unGroupe;
    }

    public function setActionRecue($actionRecue) {
        $this->actionRecue = $actionRecue;
    }

    public function setActionAEnvoyer($actionAEnvoyer) {
        $this->actionAEnvoyer = $actionAEnvoyer;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

}