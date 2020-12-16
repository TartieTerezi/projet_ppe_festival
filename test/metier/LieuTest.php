<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lieu Test</title>
    </head>
    <body>
        <?php
        use modele\metier\Lieu;
        require_once __DIR__ . '/../../includes/autoload.inc.php';
        echo "<h2>Test unitaire de la classe métier Lieu</h2>";
        // création d'un objet lieu de test
        $objet = new Lieu("010","laJoliverie","43 rue du grand nacré",25);
        var_dump($objet);
        ?>
    </body>
</html>
