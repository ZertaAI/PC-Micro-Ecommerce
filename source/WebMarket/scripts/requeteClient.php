<?php
/************************************************************************/
/* 
    En fonction du type de la requete :
        - Mise à jour des coordonnees
        - Mise à jour des coordonnees faite par l'administrateur
        - Supprimer un client par l'administrateur
        - Inserer un client par l'administrateur
        - Afficher la facture du client apres verification de la carte bancaire 
        - par defaut : revenir à l'accueil 
*/
/************************************************************************/

// Verifiez si une session n'est pas dejà active avant de demarrer une nouvelle session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verification du type de requete
if (!isset($_GET['type_requete']) || empty($_GET['type_requete'])) {
    echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=erreur&erreur=6">';
    exit;
}

// Recuperation du type de requete
$type_requete = is_numeric($_GET['type_requete']) ? $_GET['type_requete'] : 99;

// Recuperation des informations de session
$id_client = isset($_SESSION['id_client']) && is_numeric($_SESSION['id_client']) ? $_SESSION['id_client'] : 0;
$admin_session = isset($_SESSION['admin']) && is_numeric($_SESSION['admin']) ? $_SESSION['admin'] : 0;

// Recuperation des informations POST
$nom_client = isset($_POST['nom']) ? trim($_POST['nom']) : ''; 
$prenom_client = isset($_POST['prenom']) ? trim($_POST['prenom']) : ''; 
$adresse_client = isset($_POST['adresse']) ? trim($_POST['adresse']) : ''; 
$tel_client = isset($_POST['tel']) ? trim($_POST['tel']) : ''; 
$email_client = isset($_POST['email']) ? trim($_POST['email']) : ''; 
$mdp_client = isset($_POST['mdp']) ? trim($_POST['mdp']) : '';

// Verification des champs obligatoires
if (empty($nom_client) || empty($prenom_client) || empty($adresse_client) || empty($tel_client) || empty($email_client)) {
    echo 'Un des champs est vide.';
    echo '<META HTTP-EQUIV="refresh" CONTENT="2;URL=?page=erreur&erreur=6">';
    exit;
}

$db = ConnexionDB::getInstance();

switch ($type_requete) {
    // 0: Mise à jour des coordonnees
    case 0:
        if ($_SESSION['connecte'] == 0) {
            echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=acceuil">';
            exit;
        }
        
        $db->execute('UPDATE client SET nom = ?, prenom = ?, adresse = ?, tel = ?, email = ? WHERE id_client = ?',
            [$nom_client, $prenom_client, $adresse_client, $tel_client, $email_client, $id_client]);

        // Mise à jour des informations de session
        $_SESSION['nom'] = $nom_client;
        $_SESSION['prenom'] = $prenom_client;
        $_SESSION['adresse'] = $adresse_client;
        $_SESSION['email'] = $email_client;
        $_SESSION['tel'] = $tel_client;
    
        echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=coordonnee">';
        break;
        
    // 1: Mise à jour des coordonnees faite par l'administrateur
    case 1:
        if ($admin_session == 0) {
            echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=acceuil">';
            exit;
        }
        
        $admin_client = isset($_POST['admin']) && $_POST['admin'] == 'oui' ? 1 : 0;

        // Recuperer l'id dans le GET
        if (!isset($_GET['id_client']) || !is_numeric($_GET['id_client'])) {
            echo 'ID client manquant ou invalide.';
            exit;
        }
        
        $id_client = $_GET['id_client'];

        $db->execute('UPDATE client SET nom = ?, prenom = ?, adresse = ?, tel = ?, email = ?, admin = ? WHERE id_client = ?',
            [$nom_client, $prenom_client, $adresse_client, $tel_client, $email_client, $admin_client, $id_client]);
        
        if (!empty($mdp_client)) {
            $db->execute('UPDATE client SET mdp = ? WHERE id_client = ?', [$mdp_client, $id_client]);
            echo "Mise à jour du client avec succes.";
        }
        
        echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=adminClient">';
        break;
        
    // 2: Supprimer un client par l'administrateur
    case 2:
        if ($admin_session == 0) {
            echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=acceuil">';
            exit;
        }
        
        // Recuperer l'id dans le GET
        if (!isset($_GET['id_client']) || !is_numeric($_GET['id_client'])) {
            echo 'ID client manquant ou invalide.';
            exit;
        }
        
        $id_client = $_GET['id_client'];

        $results = $db->querySelect('SELECT COUNT(*) as nb_lignes FROM panier WHERE id_client = ?', [$id_client]);
        if ($results[0]['nb_lignes'] > 0) {
            echo "Le client ne peut pas etre supprime, car le panier du client n'est pas vide.";
        } else {
            $results = $db->querySelect('SELECT admin FROM client WHERE id_client = ?', [$id_client]);
            if ($results[0]['admin'] == 1) {
                $results = $db->querySelect("SELECT COUNT(*) as nb_lignes FROM client WHERE admin = 1");
                if ($results[0]['nb_lignes'] > 1) {
                    $db->execute('DELETE FROM client WHERE id_client = ?', [$id_client]);
                    echo "Le client-administrateur supprime avec succes.";
                } else {
                    echo "Le client ne peut pas etre supprime, car il est le seul administrateur du site.";   
                }
            } else {
                $db->execute('DELETE FROM client WHERE id_client = ?', [$id_client]);
                echo "Le client supprime avec succes.";
            }
        }
        break;
        
    // 3: Inserer un client par l'administrateur
    case 3:
        if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == 1) {
            echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=acceuil">';
            exit;
        }
        
        if (empty($mdp_client)) {
            echo 'Le mot de passe est vide.';
            echo '<META HTTP-EQUIV="refresh" CONTENT="2;URL=?page=erreur&erreur=6">';
            exit;
        }
        
        $results = $db->querySelect('SELECT COUNT(*) as nb_lignes FROM client WHERE nom = ? AND prenom = ? OR email = ?', 
            [$nom_client, $prenom_client, $email_client]);
        
        if ($results[0]['nb_lignes'] == 0) {
            $db->execute('INSERT INTO client 
            (`nom`, `prenom`, `admin`, `mdp`, `adresse`, `tel`, `email`)  
            VALUES (?, ?, ?, ?, ?, ?, ?)', 
            [$nom_client, $prenom_client, 0, $mdp_client, $adresse_client, $tel_client, $email_client]);
            echo 'Votre compte a bien ete enregistre, vous pouvez vous connecter.';
        } else {
            echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=erreur&erreur=2">';
        }
        break;
        
    // 4: Afficher la facture du client apres verification de la carte bancaire 
    case 4:
        // Votre code ici
        break;

    default:
        echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=?page=acceuil">';
        break;
}
?>
