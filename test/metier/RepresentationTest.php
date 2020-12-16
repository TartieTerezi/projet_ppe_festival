</head>
    <body>
        <?php
        use modele\metier\Lieu;
        use modele\metier\Groupe;       
        use modele\metier\Representation;
        require_once __DIR__ . '/../../includes/autoload.inc.php';
        echo "<h2>Test unitaire de la classe métier </h2>";
       
        // on crée un objet groupe et un objet lieu à insérer dans l'objet representation
        $unGroupe = new Groupe("g999","les Joyeux Turlurons","général Alcazar","Tapiocapolis" ,25,"San Theodoros","O");
        $unLieu = new Lieu("010","Saint Mars du désert","43 rue du grand nacré",25);
        $objet = new Representation("011", $unGroupe, $unLieu, "2021-07-01", "10:10:00", "12:00:00");
        var_dump($objet);
        ?>
    </body>
</html>
