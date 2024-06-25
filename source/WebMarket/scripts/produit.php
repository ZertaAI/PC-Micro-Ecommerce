<?php
    /************************************************************************/
    /* 
            - Affiche les produits en fonction de la categorie, des caracteristiques des produits
            - Gestion de la pagination de produits par 6 articles par page
    */
    /************************************************************************/
    
    /*************** Debut de la Definition de la fonction afficherProduit ********************/
    // Definition de la fonction afficherProduit (le tri se fait dans la requete grâce à ORDER BY)
    function afficherProduit($categorie, $tri, $prix_min, $prix_max, $num_page) {
        $db = ConnexionDB::getInstance();
        $results = null;

        $sql = 'SELECT `id_produit`, `titre`, `type`, `marque`, `image`, `description`, `quantite_stock`, `prix_public`, `prix_achat` FROM produit ';
        // Contrôle de la categorie
        if (empty($categorie)) {
            if (empty($tri)) {
                $results = $db->querySelect($sql);
            } else {
                $results = $db->querySelect($sql . ' WHERE prix_public > ? AND prix_public < ? ORDER BY ?', [$prix_min, $prix_max, $tri]);
            }
        } else {
            if (empty($tri)) {
                $results = $db->querySelect($sql . ' WHERE type = ?', [$categorie]);
            } else {
                $results = $db->querySelect($sql . ' WHERE type = ? AND prix_public > ? AND prix_public < ? ORDER BY ?', [$categorie, $prix_min, $prix_max, $tri]);
            }
        }
        
        $nb_total_produits = count($results);
        if ($nb_total_produits == 0) {
            echo "<div class='message'>Aucun produit de ce type n'est disponible</div>";
        } else {
        
            // Debut de l'Algorithme de pagination de 6 articles par page
            $produitsParPage = 6; // Nombre de produits par page
            $nb_page = ceil($nb_total_produits / $produitsParPage); // Calcul du nombre total de pages
            $debut = ($num_page - 1) * $produitsParPage; // Calcul de l'offset pour la requete
            
            $fin = $debut + $produitsParPage;
            if ($fin > $nb_total_produits) {
                $fin = $nb_total_produits;
            }
                
            if ($nb_page < 1) {
                $nb_page = 1;
            }
            // fin de l'Algorithme de pagination
        
            // Haut de page avec pagination
            echo "<div class='pagination'>";
            for ($i = 0; $i < $nb_page; $i++) {
                if ($i != $num_page - 1) {
                    echo "<a href=\"?page=produit&categorie=". $categorie ."&default_sort=". $tri ."&npage=". ($i + 1) ."&action=afficher\">Page ".($i + 1)."</a>&nbsp;";
                } else {
                    echo "<span class='current-page'>Page ".($i + 1)."</span>&nbsp;";
                }
            }
            echo "</div><br /><br />";
            
            // Recuperation des informations sur les produits dans la base de donnees en fonction de la pagination
            echo "<div class='product-list'>";
            for ($i = $debut; $i < $fin; $i++) {
                $id_produit  = $results[$i]['id_produit'];
                $titre       = $results[$i]['titre'];
                $type        = $results[$i]['type'];
                $marque      = $results[$i]['marque'];
                $image       = $results[$i]['image'];
                $quantite_stock = $results[$i]['quantite_stock'];
                $prix_public = $results[$i]['prix_public'];
                $prix_achat  = $results[$i]['prix_achat'];
                $description = $results[$i]['description'];
                
                // Affiche les informations du produit
                echo "<div class='product'>";
                echo "  <div class='image_produit'>";    
                echo "      <img src='". $image ."' alt='". $titre ."' />";
                echo "  </div>";
                echo "  <div class='product-details'>";
                echo "      <h3>". $titre ."</h3>";
                echo "      <div class='description'>";
                echo "          <p class='short-desc'>". substr($description, 0, 100) ."...</p>";
                echo "          <p class='full-desc'>". $description ."</p>";
                if (strlen($description) > 100) {
                    echo "          <button class='show-more'>plus</button>";
                }
                echo "      </div>";
                echo "      <p><strong>Marque:</strong> ". $marque ."</p>";
                echo "      <p><strong>Prix:</strong> ". $prix_public ." Euros</p>";
                echo "      <p><strong>Stock:</strong> ". $quantite_stock ."</p>";
                
                // Contrôle du login    
                if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == 1) {
                    // Contrôle du stock
                    if ($quantite_stock > 0) {
                        echo "<div class='add-to-cart'>";
                        echo "  <form action=\"?page=requeteProduit&type_requete=0&id_produit=". $id_produit . "\" method=\"post\">";
                        echo "      <img src=\"panier2.png\" alt='Panier' class='panier-img' />Quantite voulue : <input name=\"quantite_post\" value=\"1\" type='number' min='1' />";
                        echo "      <input type=\"submit\" name=\"ajouter\" class=\"input_button\" value=\"Ajouter\" />";
                        echo "  </form>";
                        echo "</div>";
                    } else {
                        echo "<div class='out-of-stock'><img src=\"panier2.png\" alt='Panier' class='panier-img' /><span>Plus en stock</span></div>";
                    }
                } else {
                    echo "<div class='not-logged-in'><img src=\"panier2.png\" alt='Panier' class='panier-img' /><a href=\"?page=acceuil\"><span>Vous n'etes pas connecte</span></a></div>";
                }
                echo "  </div>"; // .product-details
                echo "</div>"; // .product
            }
            echo "</div>"; // .product-list
?>            
    <br /><br />
    
    <!-- Demande saisie pour le tri des produits -->     
    <form action="?page=produit&categorie=<?= $categorie ?>&action=Trier&default_sort=<?= $tri ?>" method="post" class="sorting-form">
        <center>
            Trier par 
            <select name="option_tri">
                <option value="prix_public">Prix</option>
                <option value="quantite_stock">Stock</option>
            </select>
        </center>
        <br />
        <div class='price-filter'>
            <label for='prix_min'>Prix min:</label>
            <input id='prix_min' value="0" type="number" name="prix_min" class="input_text" />
            <label for='prix_max'>Prix max:</label>
            <input id='prix_max' value="1000" type="number" name="prix_max" class="input_text" />
        </div>
        <input type="submit" name="valider" class="input_button" value="Trier" />
    </form>
    
    <br /><br />
<?php
            // Bas de page avec pagination
            echo "<div class='pagination'>";
            for ($i = 0; $i < $nb_page; $i++) {
                if ($i != $num_page - 1) {
                    echo '<a href="?page=produit&categorie='. $categorie .'&default_sort='. $tri .'&npage='. ($i + 1) .'&action=afficher">Page '.($i + 1).'</a>&nbsp;';
                } else {
                    echo '<span class="current-page">Page '.($i + 1).'</span>&nbsp;';
                }
            }
            echo "</div>";
        }
    }
    /*************** Fin de la Definition de la fonction afficherProduit ********************/
?>

<?php
    // Recuperation des parametres
    $action = "default";
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $action  = $_GET['action'];
    }
    
    $categorie = "";
    if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
        $categorie = $_GET['categorie'];
    }
    
    // Parametre du tri par defaut
    $default_sort = "prix_public";
    if (isset($_GET['default_sort']) && !empty($_GET['default_sort'])) {
        $default_sort = $_GET['default_sort'];
    }

    $npage = 1; // Page 1 par defaut
    if (isset($_GET['npage']) && !empty($_GET['npage'])) {
        $npage = $_GET['npage'];        
    }    

    // Contrôle de l'action
    if ($action == "Trier") {
        $option_tri = $_POST['option_tri'];
        $prix_min = $_POST['prix_min'];
        $prix_max = $_POST['prix_max']; 
        
        afficherProduit($categorie, $option_tri, $prix_min, $prix_max, $npage);
    } else {
        afficherProduit($categorie, $default_sort, 0, 1000000, $npage);
    }
?>

<style>
    .message {
        font-size: 18px;
        color: red;
        text-align: center;
        margin: 20px 0;
    }

    .pagination {
        text-align: center;
        margin-bottom: 20px;
    }

    .pagination a, .pagination span.current-page {
        padding: 5px 10px;
        margin: 0 5px;
        text-decoration: none;
        color: #2B3E68;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

    .pagination span.current-page {
        background-color: #2B3E68;
        color: white;
    }

    .product-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .product {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        width: 200px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .image_produit {
        height: 150px; /* Fix the height */
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #ddd;
        margin-bottom: 15px;
    }

    .image_produit img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .product-details {
        text-align: left;
    }

    .description .full-desc {
        display: none;
    }

    .product-details p {
        margin: 5px 0;
    }

    .add-to-cart, .out-of-stock, .not-logged-in {
        margin-top: 15px;
        text-align: center;
    }

    .add-to-cart input[type='number'] {
        width: 50px;
        margin-left: 5px;
    }

    .sorting-form {
        text-align: center;
        margin-bottom: 20px;
    }

    .price-filter {
        display: flex;
        justify-content: center;
        gap: 10px;
        align-items: center;
    }

    .price-filter label {
        margin-right: 5px;
    }

    .panier-img {
        width: 24px; /* Set a fixed width */
        height: 24px; /* Set a fixed height */
        object-fit: contain; /* Ensure the image maintains its aspect ratio */
        margin-right: 5px; /* Add some margin to separate it from the text */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var buttons = document.querySelectorAll('.show-more');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var description = this.previousElementSibling;
                if (description.style.display === 'none' || description.style.display === '') {
                    description.style.display = 'block';
                    this.textContent = 'moins';
                } else {
                    description.style.display = 'none';
                    this.textContent = 'plus';
                }
            });
        });
    });
</script>
