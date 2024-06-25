<?php
/************************************************************************/
/*
        - Affiche toutes les informations sur les produits presents dans la base de donnees
        - l'administrateur peut modifier ou supprimer les produits presents dans la base de donnees
*/
/************************************************************************/

// Controle du droit d'administration
if (!isset($_SESSION['admin']) or $_SESSION['admin'] == 0) {
    echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=acceuil">';
    exit;
} else {
    // Numero de la page afin d'afficher en fonction de la pagination
    $num_page = 0;
    if (isset($_GET['npage']) && is_numeric($_GET['npage'])) {
        $num_page = $_GET['npage'];
    }

    $db = ConnexionDB::getInstance();

    $results = $db->querySelect('SELECT id_produit, titre, type, marque, image, description, quantite_stock, prix_public, prix_achat FROM produit');

    // Debut de l'algorithme de pagination de 5 articles par page
    $pagination = 5;

    $nb_total_produit = count($results);
    $debut = 0;

    $nb_pages = 1;
    if (($nb_total_produit % $pagination) == 0) {
        $nb_pages = $nb_total_produit / $pagination;
        $debut = $num_page * $pagination;
    } else {
        $nb_pages = ceil($nb_total_produit / $pagination);
        $debut = $num_page * $pagination;
    }

    $fin = $debut + $pagination;
    if ($fin > $nb_total_produit) {
        $fin = $nb_total_produit;
    }

    if ($nb_pages < 1) {
        $nb_pages = 1;
    }
    // Fin de l'algorithme de pagination  
?>
<br /><br />                
<?php
    // Haut de page
    // Affiche page 1, page 2, page ... en fonction de la pagination et du nombre de produits  
    for ($i = 0; $i < $nb_pages; $i++) {
        if ($i != $num_page) {
            echo '<a href="?page=adminListProduits&npage='. $i . '">Page '. ($i+1) . '</a>&nbsp;';
        } else {
            echo 'Page '.($i+1).'&nbsp;';
        }
    }
?>
<br /><br />                
<?php
    // Recuperation des informations sur les produits dans la base de donnees en fonction de la pagination
    for ($i = $debut; $i < $fin; $i++) {
        $id_produit     = $results[$i]['id_produit'];
        $titre          = $results[$i]['titre'];
        $type           = $results[$i]['type'];
        $marque         = $results[$i]['marque'];
        $image          = $results[$i]['image'];
        $quantite_stock = $results[$i]['quantite_stock'];
        $prix_public    = $results[$i]['prix_public'];
        $prix_achat     = $results[$i]['prix_achat'];
        $description    = $results[$i]['description'];
?>
<br /><br />                
        <!-- Affiche les informations du produit -->
        <div align="center" id="produit">
            <div align="center" class="image_produit">    
                <img src="<?= $image; ?>" height="100%" width="120" />
            </div>
            <form action="?page=requeteProduit&type_requete=3&id_produit=<?= $id_produit ?>" method="post">
                <center>
                    <p><b>ID :</b> <?= $id_produit ?></p>
                    <p><b>Titre :</b> <input name="titre" value="<?= $titre ?>" /></p>
                    <p><b>Type :</b> <input name="type" value="<?= $type ?>" /></p>
                    <p><b>Description :</b> <textarea name="description" rows="3" cols="30"><?= $description ?></textarea></p>
                    <p><b>Marque :</b> <input name="marque" value="<?= $marque ?>" /></p>
                    <p><b>Prix public :</b> <input name="prix_public" value="<?= $prix_public ?>" /></p>
                    <p><b>Prix achat :</b> <input name="prix_achat" value="<?= $prix_achat ?>" /></p>
                    <p><b>Quantite en Stock :</b> <input name="quantite" value="<?= $quantite_stock ?>" /></p>
                    <p><b>Image :</b> <input name="image" value="<?= $image ?>" /></p>
                    <input type="submit" name="modifier" class="input_button" value="Modifier" />
                </center>
            </form>
        </div>
        
        <!-- Bouton : Supprimer le produit -->
        <br />
        <center>
            <a href="?page=requeteProduit&type_requete=2&id_produit=<?= $id_produit ?>">
                <div class="button">
                    Supprimer
                </div>
            </a>
        </center>
        <br /><br />
<?php       
    }
    // Affiche page 1, page 2, page ... en fonction de la pagination et du nombre de produits  
    for ($i = 0; $i < $nb_pages; $i++) {
        if ($i != $num_page) {
            echo '<a href="?page=adminListProduits&npage='. $i . '">Page '. ($i+1) . '</a>&nbsp;';
        } else {
            echo 'Page '.($i+1).'&nbsp;';
        }    
    }
}
?>

<!-- Partie du code pour verifier et traiter le formulaire -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produit = $_GET['id_produit'];
    $titre = $_POST['titre'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $marque = $_POST['marque'];
    $prix_public = $_POST['prix_public'];
    $prix_achat = $_POST['prix_achat'];
    $quantite = $_POST['quantite'];
    $image = $_POST['image'];

    // Verification des champs vides
    if (empty($titre) || empty($type) || empty($description) || empty($marque) || empty($prix_public) || empty($prix_achat) || empty($quantite) || empty($image)) {
        echo "Tous les champs sont requis.";
    } else {
        // Effectuez la mise à jour dans la base de donnees ici
        // Exemple :
        // $db->queryUpdate('UPDATE produit SET titre = ?, type = ?, description = ?, marque = ?, prix_public = ?, prix_achat = ?, quantite_stock = ?, image = ? WHERE id_produit = ?', [$titre, $type, $description, $marque, $prix_public, $prix_achat, $quantite, $image, $id_produit]);
        
        echo "Produit mis a jour avec succes.";
    }
}
?>
