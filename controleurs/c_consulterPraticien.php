<?php

// Test connexion visiteur
if(estConnecteVisiteur()){
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
}
else {

		ajouterErreur("Erreur de connexion");
		include(VIEWSPATH."v_erreurs.php");

}

$action = trim(htmlentities($_REQUEST['action']));
switch($action){
	case 'liste':{
		$lesPraticiens = $pdo->getLesPraticiens();
		include(VIEWSPATH."v_listePraticien.php");
		break;
	}
	case 'consulter':{
		$id = $_POST['lstPraticien'];
		$praticien = $pdo->getUnPratitien($id);
		$dataType = $pdo->getTypePratitien($praticien['TYP_CODE']);
		$type = $dataType['TYP_LIBELLE'];
		$lieu = $dataType['TYP_LIEU'];
		include(VIEWSPATH."v_consultPraticien.php");
		break;
	}
}
?>
