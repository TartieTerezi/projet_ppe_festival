<?php

namespace vue\Representations;

use vue\VueGenerique;
use modele\dao\RepresentationDAO;

//Utilise la classe abstraite vueGenerique

class VueListeRepresentation extends VueGenerique {
    
    // @var array liste des groupes à afficher 
    private $lesRepresentations;
    
    public function __construct() {
        parent::__construct();
    }

    public function afficher() {
        include $this->getEntete();
        ?>
        <br>
        
            <?php 
           
            $tableauRepresentation[] = array();
            $i = 0;
            
            //parcours l'ensemble des representations 
            foreach ($this->lesRepresentations as $uneRepresentation) {
                $date = $uneRepresentation->getDate(); //recupere la date d'une representation 
                $verification = true; //variable qui servira de verification 
                
                //parcours l'ensemble de la liste des dates des representations
                foreach ($tableauRepresentation as $uneDate ){
                    if ($uneDate===$date){  //si une date est déjà présente dans la liste des representations
                        $verification = false; //place le code de verification à Faux
                    }                 
                }

                //si le code de verification est Vrai
                if ($verification){
                    $tableauRepresentation[$i]=$date; //ajoute la date dans le tableau des representations
                    ++$i; //incremente la variable i 
                }
            }
            
            
            foreach ($tableauRepresentation as $uneDate){
               $RepresentationByDate = RepresentationDAO::getAllByDate($uneDate);
               ?>
               <table width="55%" cellspacing="0" cellpadding="0" class="tabNonQuadrille" >
                   <tr>
                       <td colspan="5" style="text-align:center;" ><strong>Representation du <?=$uneDate ?></strong></td>
                   </tr>
                   <tr class="enTeteTabNonQuad">
                       <td width="20%">Groupe</td>
                       <td width="20%">Lieu</td>
                       <td width="20%">Heure de début</td>
                       <td width="20%">Heure de fin</td>
                       <td width="10%"></td>
                       <td width="10%"></td>
                   </tr>
                       <?php
                            foreach ($RepresentationByDate as $uneRepresentation){
                                $id = $uneRepresentation->getId();
                                $lieu = $uneRepresentation->getLieu()->getNom();
                                $groupe = $uneRepresentation->getGroupe()->getNom();               
                                $heureDebut = $uneRepresentation->getHeuredebut();
                                $heureFin = $uneRepresentation->getHeureFin();
                        ?>
                   <tr class="ligneTabNonQuad" >
                       <td width="20%" style="text-align:center;" ><?= $groupe ?></td>
                       <td width="20%" style="text-align:center;" ><?= $lieu ?></td>
                    <td width="20%"  style="text-align:center;" ><?= $heureDebut ?></td>
                    <td width="20%" style="text-align:center;" ><?= $heureFin ?></td>
                    <td width="10%"  style="text-align:center;"> <a href="index.php?controleur=representations&action=modifier&id=<?= $id ?>" >Modifier</a></td>
                    <td width="10%"  style="text-align:center;"><a href="index.php?controleur=representations&action=supprimer&id=<?= $id ?>" >Supprimer</a></td>
                   </tr>
                       <?php
                       
                            }
                            ?></table><?php
                            
                            }
                            ?>
    
        <br>
        <a href="index.php?controleur=representations&action=creer" >
            Création d'une Representation</a >
        <?php
        include $this->getPied();
    }
    
    function setLesRepresentations($lesRepresentations) {
        $this->lesRepresentations = $lesRepresentations;
    }
}
