<?php
session_start();

header('Content-Type: text/html; charset=ISO-8859-1');
ini_set('default_charset', 'ISO-8859-1');

require_once("./lib/require_all.php");

$page_print = './'.PATH::$PATH_scripts.'acceuil';
if(isset($_GET['page']) && !empty($_GET['page'])) {
    $page_print = $_GET['page'];
}

$page_print = str_replace('/', '', $page_print);
$page_print .= '.php';
$page_print = './'.PATH::$PATH_scripts.$page_print;

if (!file_exists($page_print)) {
    $page_print = './'.PATH::$PATH_scripts.'acceuil.php';
}

$default_sort = 'prix_public';
if(isset($_GET['default_sort']) && !empty($_GET['default_sort'])) {
    $default_sort = $_GET['default_sort'];    
}

$file_css = 'site.css';

echo '<!DOCTYPE html>';
echo '<html lang="fr">';
echo '<head>';
echo '    <meta charset="ISO-8859-1">';
echo '    <title>PC Micro</title>';
echo '    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
echo '    <link href="'. $file_css .'" rel="stylesheet" type="text/css">';
echo '    <meta name="viewport" content="width=device-width, initial-scale=1">';
echo '</head>';
echo '<body>';
echo '  <header>';
echo '      <h1><a href="?page=acceuil" class="header-link">PC Micro</a></h1>';
echo '  </header>';
echo '  <div class="container">';
echo '      <nav id="menu">';

$vue_login = '<div class="sous_Menu">
                <div class="tite_Menu">Espace client</div>
                <a href="?page=acceuil"><div class="button">Accueil</div></a>
                <form name="identification" action="?page=login" method="post">
                    <label for="login">Nom d\'utilisateur :</label>
                    <input type="text" name="login" class="input_text" id="login">
                    <label for="mdp">Mot de passe :</label>
                    <input type="password" name="mdp" class="input_text" id="mdp">
                    <input type="submit" name="connexion" class="input_button" value="Connexion">
                </form>
                <a href="?page=enregistrer">S\'enregistrer</a>
                <a href="?page=lostpassword">Mot de passe oublie ?</a>
              </div>';

$vue_client = '<div class="sous_Menu">
                <div class="tite_Menu">Espace Client</div>
                <a href="?page=acceuil"><div class="button">Accueil</div></a>
                <a href="?page=coordonnee"><div class="button">Coordonnees</div></a>
                <a href="?page=panier&action=afficher"><div class="button">Panier</div></a>
                <a href="?page=facture&action=afficher"><div class="button">Liste des factures</div></a>
                <a href="?page=unlogin"><div class="button">Deconnexion</div></a>
              </div>';

$vue_admin = '<div class="sous_Menu">
                <div class="tite_Menu">Espace Admin</div>
                <a href="?page=adminClient"><div class="button">Client</div></a>
                <a href="?page=adminAjoutProduit"><div class="button">Ajout Produit</div></a>
                <a href="?page=adminListProduits&npage=0"><div class="button">Liste des Produits</div></a>
              </div>';

$db = ConnexionDB::getInstance();
$results = $db->querySelect('SELECT type FROM produit GROUP BY type');
$nbResults = count($results);

$vue_produit = '<div class="sous_Menu">
                <div class="tite_Menu">Espace Produit</div>
                <a href="?page=produit&categorie=&default_sort='. $default_sort .'&npage=0"><div class="button">Tous</div></a>';
for($i = 0; $i < $nbResults; $i++) {
    $vue_produit .= '<a href="?page=produit&categorie='. $results[$i]['type'].'&default_sort='. $default_sort .'&npage=0"><div class="button">'. $results[$i]['type'] .'</div></a>';
}
$vue_produit .= '</div>';

if(isset($_SESSION['connecte']) && $_SESSION['connecte'] == 1) {
    if($_SESSION['admin'] == 1) {
        echo $vue_admin;
    }
    echo $vue_client;
    echo $vue_produit;
} else {
    echo $vue_login;
    echo $vue_produit;
}

echo '      </nav>';
echo '      <main class="corps">';
require_once($page_print);
echo '      </main>';
echo '  </div>';
echo '  <footer>';
echo '      <p>&copy; 2024 PC Micro</p>';
echo '  </footer>';
echo '</body>';
echo '</html>';
?>
