<?php
namespace vue\Representations;

use vue\VueGenerique;
use modele\metier\Representation;

/**
 * Page de suppression d'un établissement donné
 * @author Crepiliere
 * @version 2020
 *
 */
class VueSupprimerRepresentation extends VueGenerique {

    /** @var Representation a supprimer */
    private $uneRepresentation;
   

    public function __construct() {
        parent::__construct();
    }
    
    public function afficher() {
        include $this->getEntete();
        
        //$this->setUnGroupe($this->uneRepresentation->getGroupe());
        
        ?>
<br><center>Voulez-vous vraiment supprimer la Representation du <?= $this->uneRepresentation->getDate() ?> ?
            <h3><br>
                <a href="index.php?controleur=representations&action=validerSupprimer&id=<?= $this->uneRepresentation->getId() ?>">Oui</a>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <a href="index.php?controleur=representations">Non</a></h3>
        </center>
        <?php
        include $this->getPied();
    }

    function setUneRepresentation(Representation $uneRepresentation){
        $this->uneRepresentation = $uneRepresentation;
    }
}
