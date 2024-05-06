<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = trim(htmlentities($_REQUEST['action']));
switch($action){
	case 'demandeConnexion':{
		include(VIEWSPATH."v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = trim(htmlentities($_REQUEST['login']));
		$mdp = trim(htmlentities($_REQUEST['mdp']));
		$collaborateur = $pdo->getIdCollaborateur($login,$mdp);
		if(!is_array( $collaborateur)){
				ajouterErreur("Login ou mot de passe incorrect");
				include(VIEWSPATH."v_erreurs.php");
				include(VIEWSPATH."v_connexion.php");
		}
		else{
			$infos = $pdo->getInfosCollaborateur($collaborateur[0]);
			$grade = $pdo->getGradeCollaborateur($collaborateur[0]);
			connecterVisiteur($collaborateur[0],$infos['nom'],$infos['prenom'],$grade);

			if($_SESSION['grade'] == "V"){
				include(VIEWSPATH."v_sommaireVisiteur.php");
			}
			else{
				if($_SESSION['grade'] == "D"){
					include(VIEWSPATH."v_sommaireDelegue.php");
				}
				else{
					if($_SESSION['grade'] == "R"){
						include(VIEWSPATH."v_sommaireResponsable.php");
					}
					else{
						ajouterErreur("Erreur de détection du grade");
						include(VIEWSPATH."v_erreurs.php");
						include(VIEWSPATH."v_connexion.php");
					}
				}
			}

			include(VIEWSPATH."v_accueil.php");

		}
		break;
	}
	case 'deconnexion':{
		deconnecter();
		include(VIEWSPATH."v_connexion.php");
		break;
	}
	default :{
		include(VIEWSPATH."v_connexion.php");
		break;
	}
}
?>