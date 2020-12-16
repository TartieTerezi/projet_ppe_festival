<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Representation : test</title>
    </head>

    <body>

    <?php

        use modele\dao\RepresentationDAO;
        use modele\metier\Lieu;
        use modele\metier\Groupe;    
        use modele\metier\Representation;
        use modele\dao\Bdd;
        use controleur\Session;

        require_once __DIR__ . '/../../includes/autoload.inc.php';
        Session::demarrer();
        Bdd::connecter();

        echo "<h2>Test de RepresentationDAO</h2>";

        $id = '001';
        

        // Test n°1
        echo "<h3>1- getOneById</h3>";
        $objet = RepresentationDAO::getOneById($id);
        var_dump($objet);

        // Test n°2
        echo "<h3>2- getAll</h3>";
        $lesObjets = RepresentationDAO::getAll();
        var_dump($lesObjets);

        // Test n°3-1 : Toutes les représentations au lieu d'ID 001 
        echo "<h3>3-1- getAllByIdLieu > 0</h3>";
        $idLieu = '001';
       
        $nb = RepresentationDAO::getAllByIdLieu($idLieu);
        var_dump($nb);

        // Test n°3-2 : Toutes les représentations du groupe g001
        echo "<h3>3-2- GetAllByIdGroupe</h3>";
        $idGroupe = 'g001';
       
        $nb = RepresentationDAO::getAllByIdGroupe($idGroupe);
        var_dump($nb);

        // Test n°4
 
        
        echo "<h3>4- insert</h3>";
        $id = '100';
        $idGroupe = 'g001';
        $idLieu = '001';
        $date = '2021-07-01';
        $heuredebut = '10:10:00';
        $heurefin = '12:00:00';
        try {
//           
            $ok = RepresentationDAO::insertValues($id, $idGroupe, $idLieu, $date, $heuredebut, $heurefin);
            if ($ok) {
                echo "<h4>ooo réussite de l'insertion ooo</h4>";
                $objetLu = RepresentationDAO::getOneById($id);
                var_dump($objetLu);
            } else {
                echo "<h4>*** échec de l'insertion ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }

        // Test n°4-bis
        echo "<h3>4-bis insert déjà présent</h3>";
        try {
            $objet2 = new Lieu($id, 'La Crique', '2 rue des Criques', 300);
            $ok = LieuDAO::insert($objet2);
            if ($ok) {
                echo "<h4>*** échec du test : l'insertion ne devrait pas réussir  ***</h4>";
                $objetLu = Bdd::getOneById($id);
                var_dump($objetLu);
            } else {
                echo "<h4>ooo réussite du test : l'insertion a logiquement échoué ooo</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>ooo réussite du test : la requête d'insertion a logiquement échoué ooo</h4>" . $e->getMessage();
        }
        
        // Test n°5
  //      echo "<h3>5- update</h3>";
     //      $newid = '101';
     //      $newidGroupe = 'g002';
     //      $newidLieu = '002';
     //      $newdate = '2021-08-01';
     //      $newheuredebut = '11:10:00';
     //      $newheurefin = '11:20:00';
      //     try {
      //         $ok = RepresentationDAO::update($newid, $newidGroupe, $newidLieu, $newdate, $newheuredebut, $newheurefin);
       //        if ($ok) {
        //           $objetLu = RepresentationDAO::getOneById($newid);
        //           if ($objetLu->getDate() == $newdate) {
        //               echo "<h4>ooo réussite de la mise à jour ooo</h4>";
          //             var_dump($objetLu);
           //        } else {
           //            echo "<h4>*** échec de la mise à jour, le nombre de chambres n'est pas le bon ***</h4>";
            //       }
         //      } else {
      //             echo "<h4>*** échec de la mise à jour, erreur DAO ***</h4>";
       //        }
     //      } catch (Exception $e) {
     //          echo "<h4>*** échec de la requête, erreur PDO ***</h4>" . $e->getMessage();
     //      }

        // Test n°6
        echo "<h3>6- delete</h3>";
        try {
            $ok = RepresentationDAO::delete($id);
            if ($ok) {
                echo "<h4>ooo réussite de la suppression ooo</h4>";
            } else {
                echo "<h4>*** échec de la suppression ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }



        Bdd::deconnecter();
        Session::arreter();
        ?>


    </body>
</html>
