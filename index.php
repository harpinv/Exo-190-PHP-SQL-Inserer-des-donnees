<?php

/**
 * Pour cet exercice, vous allez utiliser la base de données table_test_php créée pendant l'exo 189
 * Vous utiliserez également les deux tables que vous aviez créées au point 2 ( créer des tables avec PHP )
 */

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'bdd_cours';

try {
    /**
     * Créez ici votre objet de connection PDO, et utilisez à chaque fois le même objet $pdo ici.
     */
    $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $password);
    $maConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /**
     * 1. Insérez un nouvel utilisateur dans la table utilisateur.
     */

    // TODO votre code ici.
    $dt = new DateTime();
    $date = $dt->format('Y-m-d H:i:s');

    $table_test_php = "
         INSERT INTO utilisateur (nom, prenom, email, password, adresse, code_postal, pays, date_enregistrement)
         VALUES ('Pit', 'Brout', 'p.brout@gmail.com', '4567', '2 Rue Nounou', 59440, 'France', '$date')
    ";

    $result = $maConnexion->exec($table_test_php);
    echo $result;

    /**
     * 2. Insérez un nouveau produit dans la table produit
     */

    // TODO votre code ici.

    $table_test_php = "
         INSERT INTO produit (titre, prix, description_courte, description_longue)
         VALUES ('confiture', 2, 'confiture de fraise', 'fraise avec du sucre et un gélifiant')
    ";

    $result = $maConnexion->exec($table_test_php);
    echo $result;

    /**
     * 3. En une seule requête, ajoutez deux nouveaux utilisateurs à la table utilisateur.
     */

    // TODO Votre code ici.

    $table_test_php = "
         INSERT INTO utilisateur (nom, prenom, email, password, adresse, code_postal, pays, date_enregistrement)
         VALUES ('Banne', 'Mac', 'b.mac@gmail.com', '3498', '3 Rue du bouchon', 59810, 'France', '$date'),
         VALUES ('Martin', 'Vom', 'm.vom@gmail.com', '7102', '5 Rue melon', 59230, 'France', '$date')
    ";

    $result = $maConnexion->exec($table_test_php);
    echo $result;

    /**
     * 4. En une seule requête, ajoutez deux produits à la table produit.
     */

    // TODO Votre code ici.

    $table_test_php = "
         INSERT INTO produit (titre, prix, description_courte, description_longue)
         VALUES ('miel', 3, 'miel des abeille', 'miel liquide fabriqué par des abeille pendant un été'),
         VALUES ('chocolat', 1, 'tablette de chocolat', 'tablette de chocolat au lait de 200g')
    ";

    $result = $maConnexion->exec($table_test_php);
    echo $result;

    /**
     * 5. A l'aide des méthodes beginTransaction, commit et rollBack, insérez trois nouveaux utilisateurs dans la table utilisateur.
     */

    // TODO Votre code ici.

    $maConnexion->beginTransaction();

    $table_test_php = 'INSERT INTO utilisateur (nom, prenom, email, password, adresse, code_postal, pays, date_enregistrement) VALUES ';

    $uti1 = $table_test_php . "('Color', 'Will', 'c.will@gmail.com', '6082', '1 Rue point', 59764, 'France', '$date')";
    $maConnexion->exec($uti1);

    $uti2 = $table_test_php . "('Pate', 'Paffe', 'p.paffe@gmail.com', '9345', '6 Rue pontton', 5342, 'France', '$date')";
    $maConnexion->exec($uti2);

    $uti3 = $table_test_php . "('Violet', 'Blanc', 'v.blanc@gmail.com', '4071', '4 Rue du marrais', 59214, 'France', '$date')";
    $maConnexion->exec($uti3);

    $maConnexion->commit();

    /**
     * 6. A l'aide des méthodes beginTransaction, commit et rollBack, insérez trois nouveaux produits dans la table produit.
     */

    $maConnexion->beginTransaction();

    $table_test_php = 'INSERT INTO produit (titre, prix, description_courte, description_longue) VALUES ';

    $pro1 = $table_test_php . "('lait', 2, 'lait de vache', 'bouteille d'un litre demi écrémé')";
    $maConnexion->exec($pro1);

    $pro2 = $table_test_php . "('oeuf', 1, 'oeuf de poule', 'oeuf de poule élevé en plaine et au grain')";
    $maConnexion->exec($pro2);

    $pro3 = $table_test_php . "('fromage', 3, 'fromage raclette', 'fait au lait de vache pasteurisé')";
    $maConnexion->exec($pro3);

    $maConnexion->commit();

}
catch (PDOException $exception) {
    echo "Erreur de connexion: " . $exception->getMessage();

    $maConnexion->rollBack();
}