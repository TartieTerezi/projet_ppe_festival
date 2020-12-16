<?php

namespace vue\Representations;

error_reporting(E_ALL);
ini_set("display_errors", 1);

use vue\VueGenerique;
use modele\metier\Representation;
use modele\metier\Groupe;
use modele\metier\Lieu;
use modele\dao\LieuDAO;
use modele\dao\GroupeDAO;
use modele\dao\Bdd;

class VueSaisieRepresentation extends VueGenerique {

    /** @var Representation identificateur de l'établissement à afficher */
    private $uneRepresentation;
    /** @var Groupe identificateur de l'établissement à afficher */
    private $unGroupe;
    /** @var Lieu */
    private $unLieu;
    /** @var tableau des Lieux */
    private $desLieux;
    /** @var tableau des groupes */
    private $desGroupes;
    /** @var string ="validerCreer" ou = "validerModifier" en fonction de l'utilisation du formulaire */
    private $actionAEnvoyer;
    /** @var string ="creer" ou = "modifier" en fonction de l'utilisation du formulaire */
    private $actionRecue;
    


    public function __construct() {
        parent::__construct();
    }

    public function afficher() {
        include $this->getEntete();
        
        ?>
        <form method="POST" action="index.php?controleur=representations&action=<?= $this->actionAEnvoyer ?>">
        <br>
        <table width='60%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'> 
            <tr class='enTeteTabNonQuad'>
                                <?php         
                if ($this->actionRecue == "creer") {

                    ?>
                    <tr class="enTeteTabNonQuad">
                        <td colspan='3'></td>
                    </tr>
                    <tr class='ligneTabNonQuad'>
                        <td> Id: </td>
                        <td><input name="id" value="" maxlength="3"  required="true" ></td>
                    </tr>
                    <?php
                } else {
                    $this->setGroupe($this->uneRepresentation->getGroupe());
                    $this->setLieu($this->uneRepresentation->getLieu());
                    ?>
                    <tr class="enTeteTabNonQuad">
                        <td colspan='3'><input name="id" hidden="true"  value="<?= $this->uneRepresentation->getId() ?>"></td>
                    </tr>
                    <?php
                }
                ?>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td  width='20%'> Nom du groupe: </td>
                <td>
                    <select name="groupe">
                        <?php
                        
                        if($this->actionRecue === "modifier"){
                        
                        $test = $this->unGroupe->getId(); //sauvegarde le groupe
                        foreach ($this->desGroupes as $unGroupe){ //boucle pour tout les groupes 
                            $this->setGroupe($unGroupe); //enregistre le groupe en tant qu'objet Groupe
                            ?>
                        <option value="<?= $this->unGroupe->getId()?>" 
                            <?php 
                            if($this->unGroupe->getId()===$test){ //si l'id est egale à l'id du groupe
                            ?>selected<?php //met l'attribut selected
                            }
                            ?>
                            ><?= $this->unGroupe->getNom() ?></option><?php }
                            
                        } else {
                            
                            foreach ($this->desGroupes as $unGroupe){ //boucle pour tout les groupes 
                                $this->setGroupe($unGroupe); //enregistre le groupe en tant qu'objet Groupe
                                ?>
                            <option value="<?= $this->unGroupe->getId() ?>"><?= $this->unGroupe->getNom() ?></option><?php 
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Date: </td>
                <td><input required="true" type="date" name="date" value="<?= $this->uneRepresentation->getDate() ?>" min="2010-01-01" max="2099-30-12"></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Heure début: </td>
                <td><input required="true" type="time" name="heuredebut" value="<?= $this->uneRepresentation->getHeuredebut() ?>" min="00:00:00" max="23:59:59" step="2"></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Heure fin: </td>
                <td><input required="true" type="time" name="heurefin" value="<?= $this->uneRepresentation->getHeurefin() ?>" min="00:00:00" max="23:59:59" step="2"></td>
            </tr>
            <tr class='ligneTabNonQuad'>
                <td> Lieu: </td>
                <td>
                    <select name="lieu">
                        <?php
                        
                        if($this->actionRecue == "modifier"){
                        
                        $test = $this->unLieu->getId(); //sauvegarde le lieu
                        foreach ($this->desLieux as $unLieu){ //boucle pour tout les lieux 
                            $this->setLieu($unLieu); //enregistre le lieu en tant qu'objet Lieu
                            ?><option value="<?= $this->unLieu->getId()?>"<?php 
                            if($this->unLieu->getId()===$test){ //si l'id est egale à l'id du lieu
                                ?>selected<?php //met l'attribut selected
                            }
                            ?>
                            ><?= $this->unLieu->getNom() ?></option><?php 
                            
                        }
                            
                        } else {
                            
                            foreach ($this->desLieux as $unLieu){ //boucle pour tout les lieux 
                            $this->setLieu($unLieu); //enregistre le lieu en tant qu'objet Lieu
                            ?>
                            <option value="<?= $this->unLieu->getId()?>"><?= $this->unLieu->getNom() ?></option><?php }
                            
                        }
                            
                            ?>
                    </select>
                </td>
            </tr>
            <table align="center" cellspacing="15" cellpadding="0">
                <tr>
                    <td align="right"><input type="submit" value="Valider" name="valider">
                    </td>
                    <td align="left"><input type="reset" value="Annuler" name="annuler">
                    </td>
                </tr>
            </table>
            <br>
        </form>   
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
    function setGroupes(array $groupes){
        $this->desGroupes = $groupes;
    }
    function setLieu(Lieu $unLieu){
        $this->unLieu = $unLieu;
    }   
    function setLieux(array $lieux){
        $this->desLieux = $lieux;
    }
    public function setActionAEnvoyer(string $action) {
        $this->actionAEnvoyer = $action;
    }
    public function setActionRecue(string $action) {
        $this->actionRecue = $action;
    }

}