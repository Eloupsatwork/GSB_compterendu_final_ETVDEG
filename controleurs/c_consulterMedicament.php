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
	case'liste':{
		$lesMedicaments = $pdo->getLesMedicaments();
		include(VIEWSPATH."v_listeMedicament.php");
		break;
	}
	case'consulter':{
		$idMed = $_POST['lstMedicament'];
		$Medicament = $pdo->getUnMedicament($idMed);
		$famille = $pdo->getFamilleMedicament($Medicament['FAM_CODE']);
		include(VIEWSPATH."v_consultMedicament.php");
		break;
	}
}
?>