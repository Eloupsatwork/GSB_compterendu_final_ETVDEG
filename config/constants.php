<?php 

// Fichier ou seront stockées toutes les constantes utiles dans le site


//L'url du site
	define("URL","{url_de_votre_site}");
	
// url ou se trouve le css
	define("CSSURL",URL."styles/");
// url ou se trouve les images
	define("IMAGESURL",URL."images/");
	define("CONTROLLERSPATH",APPATH."controleurs".DIRECTORY_SEPARATOR);
	define("VIEWSPATH",APPATH."vues".DIRECTORY_SEPARATOR);
	define("MODELSPATH",APPATH."modele".DIRECTORY_SEPARATOR);
	define("INCLUDEPATH",APPATH."include".DIRECTORY_SEPARATOR);	
	
//Les informations de connexion
	//DB_HOST nom de la machine qui heberge le SGBD
		define("DB_HOST",'mysql:host={votre_serveur}');
		
	//DB_NAME le nom de la base de donnée
		define("DB_NAME",'dbname={nom_BD}');
		
	//Le login de la base
		define("DB_LOGIN",'{votre_login}');
		
	//Le mot de passe
		define("DB_MDP",'{votre_mot_de_passe}');
		
?>
