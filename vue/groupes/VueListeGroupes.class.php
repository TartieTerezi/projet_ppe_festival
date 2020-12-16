<?php
/**
 * Description Page de consultation de la liste des Groupes
 * -> affiche Uun tableau constitué d'une ligne d'entête et d'une ligne par établissement
 * @author Crepiliere Axel basé sur la version VueListeEtablissements.class.php
 * @version 2020
 */

namespace vue\groupes;

use vue\VueGenerique; //Utilise la classe abstraite vueGenerique

class VueListeGroupes extends VueGenerique {
    
    // @var array liste des groupes à afficher 
    private $lesGroupes;
    
    public function __construct() {
        parent::__construct();
    }

    public function afficher() {
        include $this->getEntete();
        ?>
        <br>
        <table width="55%" cellspacing="0" cellpadding="0" class="tabNonQuadrille" >

            <tr class="enTeteTabNonQuad" >
                <td colspan="4" ><strong>Groupes</strong></td>
            </tr>
            <?php
            // Pour chaque établissement lu dans la base de données
            foreach ($this->lesGroupes as $unGroupe) {
                $id = $unGroupe->getId();
                $nom = $unGroupe->getNom();
                ?>
                <tr class="ligneTabNonQuad" >
                    <td width="52%" ><?= $nom ?></td>

                    <td width="16%" align="center" > 
                        <a href="index.php?controleur=groupes&action=detail&id=<?= $id ?>" >
                            Voir détail</a>
                    </td>

                    <td width="16%" align="center" > 
                        <a href="index.php?controleur=groupes&action=modifier&id=<?= $id ?>" >
                            Modifier
                        </a>
                    </td>
                   <?php // Boutton de suppression ?>
                    <td width="16%" align="center" > 
                        <a href="index.php?controleur=groupes&action=supprimer&id=<?= $id ?>" >
                            Supprimer
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <br>
        <a href="index.php?controleur=groupes&action=creer" >
            Création d'un groupes</a >
        <?php
        include $this->getPied();
    }
    
    function setLesGroupes($lesGroupes) {
        $this->lesGroupes = $lesGroupes;
    }
}