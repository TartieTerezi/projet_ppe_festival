<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vue\groupes;
use vue\VueGenerique;
use modele\metier\Groupe;

/**
 * Description of VueDetailGroupe
 *
 * @author crepi
 */
class VueDetailGroupe extends VueGenerique {

    /** @var Groupe identificateur de l'établissement à afficher */
    private $unGroupe;

    public function __construct() {
        parent::__construct();
    }

    public function afficher() {
        include $this->getEntete();

        ?>
        <br>
        <table width='60%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'> 
            <tr class='enTeteTabNonQuad'>
                <td colspan='3'><strong><?= $this->unGroupe->getNom() ?></strong></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td  width='20%'> Id: </td>
                <td><?= $this->unGroupe->getId() ?></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Nom : </td>
                <td><?= $this->unGroupe->getNom() ?></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Hebergement : </td>
                <td><?php if($this->unGroupe->getHebergement()=="O"){
                    echo 'oui';
                } else {
                        echo 'Non';
                }
                
                    ?>
                </td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Nombre de personnes : </td>
                <td><?= $this->unGroupe->getNbPers() ?></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Pays : </td>
                <td><?= $this->unGroupe->getNomPays() ?></td>
            </tr>
        </table>
        <br>
        <a href='index.php?controleur=groupes&action=liste'>Retour</a>
        <?php
        include $this->getPied();
    }

    function setUnGroupe(Groupe $unGroupe) {
        $this->unGroupe = $unGroupe;
    }


}

