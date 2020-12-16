<?php

namespace vue\Representations;

use vue\VueGenerique;
use modele\metier\Representation;
use modele\metier\Groupe;
use modele\metier\Lieu;


class VueDetailRepresentation extends VueGenerique {

    /** @var Representation identificateur de l'établissement à afficher */
    private $uneRepresentation;
    /** @var Groupe identificateur de l'établissement à afficher */
    private $unGroupe;
    /** @var Lieu */
    private $unLieu;

    public function __construct() {
        parent::__construct();
    }

    public function afficher() {
        include $this->getEntete();
        
        $this->setGroupe($this->uneRepresentation->getGroupe());
        $this->setLieu($this->uneRepresentation->getLieu());
        
        ?>
        <br>
        <table width='60%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'> 
            <tr class='enTeteTabNonQuad'>
                <td colspan='3'><strong><?= $this->uneRepresentation->getId() ?></strong></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td  width='20%'> Nom du groupe: </td>
                <td><?= $this->unGroupe->getNom() ?></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Date: </td>
                <td><?= $this->uneRepresentation->getDate() ?></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Heure début: </td>
                <td><?= $this->uneRepresentation->getHeuredebut() ?></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Heure fin: </td>
                <td><?= $this->uneRepresentation->getHeurefin() ?></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Lieu: </td>
                <td><?= $this->unLieu->getNom() ?></td>
            </tr>
            
            </table>
            <br>
            
        <a href='index.php?controleur=representations'>Retour</a>
        <?php
        include $this->getPied();
    }
    function setUneRepresentation(Representation $uneRepresentation) {
        $this->uneRepresentation = $uneRepresentation;
    }
    function setGroupe(Groupe $unGroupe){
        $this->unGroupe = $unGroupe;
    }
    function setLieu(Lieu $unLieu){
        $this->unLieu = $unLieu;
    }
    
}

