<?php
	/************************************************************************/
	/* 
	        - Gestion des erreurs
	*/
	/************************************************************************/
	
	$erreur = 99;
	if(isset($_SESSION['connecte']) and !empty($_GET['erreur'])) {
		$erreur = $_GET['erreur'];
	}

	switch($erreur)
	{
		case 0:
			echo "Le compte n'existe pas ou vos identifiants sont incorrects.";
			break;
		case 1:
			echo "Un champ est reste vide lors de votre saisie, veuillez renouveller l'enregistrement du compte.";
			break;
		case 2:
			echo "Le compte existe deja.";
			break;
		case 3:
			echo "La quantite voulue est trop grande ou negative";
			break;
		case 4:
			echo "Parametre de tri invalide";
			break;
		case 5:
			echo "Produit deja existant";
			break;
		case 6:
			echo "Un des champs est vide";
			break;
		case 7:
			echo "Le champs stock est invalide";
			break;
		case 8:
			echo "Il n'y a pas de produit dans le panier";
			break;
		case 9:
			echo "Stock epuise";
			break;
		case 10:
			echo "Numero de compte vide";
			break;
		default: 
			echo "Les identifiants fournis ne sont pas corrects.";
	}
?>