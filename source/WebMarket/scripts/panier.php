<?php
    /************************************************************************/
    /* 
            - en fonction de l'action qui est mis en parametre : 
            - on affiche le panier
            - on supprimer le produit du panier
    */
    /************************************************************************/

    //Controle du parametre action
    if(!isset($_GET['action'])) {
?>
<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=erreur&erreur=6">
<?php
    } else {
        $action = $_GET['action'];
        
        $num_action = 0; //afficher panier
        if($action == "supprimer") {
            $num_action = 1; //supprimer panier
        } elseif ($action == "payer") {
            $num_action = 2; //payer
        }
        
        $db = ConnexionDB::getInstance();
        
        switch($num_action)
        {
            /*********************** Affichage Panier *******************************************/    
            case 0 :
                $id_client = $_SESSION['id_client'];
                $results = $db->querySelect('
                    SELECT pa.`quantite_panier`,
                    pro.`id_produit`, pro.`titre`, pro.`type`, pro.`marque`, pro.`image`, pro.`description`, pro.`quantite_stock`, pro.`prix_public`, pro.`prix_achat`
                    FROM panier pa, produit pro 
                    WHERE pa.id_produit = pro.id_produit AND pa.id_client = ?', [$id_client]);

                $nb_results = count($results);
                if($nb_results == 0) {
                    echo 'Aucun produit dans le panier';
                } else {    
                    echo '<style>
                            .image_produit img {
                                width: 200px;
                                height: 200px;
                                object-fit: cover;
                            }
                            .button-supprimer {
                                background-color: #ff4d4d;
                                color: white;
                                border: none;
                                padding: 10px 20px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 16px;
                                margin: 4px 2px;
                                cursor: pointer;
                                border-radius: 5px;
                                transition: background-color 0.3s ease;
                            }
                            .button-supprimer:hover {
                                background-color: #ff1a1a;
                            }
                            .button-valider {
                                background-color: #4CAF50;
                                color: white;
                                border: none;
                                padding: 10px 20px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 16px;
                                margin: 10px 0;
                                cursor: pointer;
                                border-radius: 5px;
                                transition: background-color 0.3s ease;
                            }
                            .button-valider:hover {
                                background-color: #45a049;
                            }
                            .produit-container {
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                border: 1px solid #ddd;
                                padding: 20px;
                                margin-bottom: 20px;
                                border-radius: 5px;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            }
                            .produit-details {
                                text-align: center;
                                margin: 10px 0;
                            }
                          </style>';

                    for($i = 0; $i < $nb_results; $i++) {
                        $id_produit = $results[$i]['id_produit'];
                        $titre = $results[$i]['titre'];
                        $marque = $results[$i]['marque'];
                        $image = $results[$i]['image'];
                        $quantite_stock = $results[$i]['quantite_stock'];
                        $prix = $results[$i]['prix_public'];
                        $description = $results[$i]['description'];                                                
                        $quantite_panier = $results[$i]['quantite_panier'];

                        echo '<div class="produit-container">';
                        echo '    <div class="image_produit">';
                        echo '        <img src="' .$image. '" alt="'. $titre .'" />';            
                        echo '    </div>';
                        echo '    <div class="produit-details">';
                        echo '        <b>Titre:</b> '. $titre .'<br />';
                        echo '        <b>Description:</b> '. $description .'<br />';
                        echo '        <b>Marque:</b> '. $marque .'<br />';
                        echo '        <b>Prix:</b> '. $prix .' Euros<br />';
                        echo '        <b>Stock:</b> '. $quantite_stock .'<br />';
                        echo '        <b>Quantite voulue:</b> '. $quantite_panier .'<br />';
                        echo '    </div>';
                        
                        if($quantite_stock < $quantite_panier) {
                            echo '<center><a class="button-supprimer" href="#">Pas assez en stock</a></center>';
                        }
                        echo '<center><a class="button-supprimer" href="?page=panier&action=supprimer&id='. $id_produit .'">Supprimer</a></center>';
                        echo '</div>';
                    }
                    echo '<center><a class="button-valider" href="?page=genererFacture">Valider ma commande</a></center>';
                }
                break;
            
            /*********************** Supprimer Panier *******************************************/
            case 1 :
                $id_produit = $_GET['id'];
                $db->execute('DELETE FROM panier WHERE id_produit = ?', [$id_produit]);
                echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=panier&action=afficher">';
                break;

            /*********************** Payer *******************************************/
            case 2 :
                // Rediriger directement vers la page de generation de facture
                echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=genererFacture">';
                break;
        }
    }    
?>
