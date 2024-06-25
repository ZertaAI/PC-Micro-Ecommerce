<?php
	/************************************************************************/
	/* 

	        - Suppression de la session ("deconnecter")		
	*/
	/************************************************************************/
?>

<p>Deconnexion en cours, veuillez patienter ...</p>
	
<?php
	session_destroy(); //detruire la session utilisateur si celle-ci existe	
?>

<META HTTP-EQUIV="refresh" CONTENT="1;URL=?page=acceuil">