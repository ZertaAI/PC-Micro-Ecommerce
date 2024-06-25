<?php
    /************************************************************************/
    /* 
            - affiche les factures
    */
    /************************************************************************/

    // Contrôle du paramètre action
    if (!isset($_GET['action'])) {
        echo '<meta http-equiv="refresh" content="0;URL=?page=erreur&erreur=6">';
        exit;
    } else {
        $action = $_GET['action'];
        
        $num_action = 0; // afficher factures
        
        $db = ConnexionDB::getInstance();
        
        switch ($num_action) {
            /*********************** Affichage Factures *******************************************/    
            case 0:
                $id_client = $_SESSION['id_client'];
                
                $dossier_client = './factures/client_' . $id_client;

                $results = $db->querySelect('
                    SELECT id_facture
                    FROM facture  
                    WHERE id_client = ?', [$id_client]);

                $nb_results = count($results);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Factures</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Mes Factures</h2>
    <?php
        if ($nb_results == 0) {
            echo '<div class="alert alert-info text-center">Aucune facture realisee.</div>';
        } else {
            echo '<div class="list-group">';
            for ($i = 0; $i < $nb_results; $i++) {
                $id_facture = $results[$i]['id_facture'];
                $fichier_facture = $dossier_client . '/fact_' . $id_facture . '.pdf';
                // Affiche les liens des factures
                echo '<a href="' . $fichier_facture . '" class="list-group-item list-group-item-action">';
                echo 'Facture ' . $id_facture;
                echo '</a>';
            }
            echo '</div>';
        }
    ?>
</div>
<!-- Inclure Bootstrap JS et dependances -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
                break;
        }
    }    
?>
