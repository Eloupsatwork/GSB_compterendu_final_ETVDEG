<?php
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
else{

			ajouterErreur("Erreur de connexion");
			include(VIEWSPATH."v_erreurs.php");

}
$action = trim(htmlentities($_REQUEST['action']));
switch($action){
	case"choixDelegue":{
		if(isset($_REQUEST['lstDelegue'])){
			$idCollaborateur = $_REQUEST['lstDelegue'];
		} else {
			$idCollaborateur = $_SESSION['idVisiteur'];
		}
        $lesComptesRendus = $pdo->getLesComptesRendusRegion($idCollaborateur);
		if(empty($lesComptesRendus)){
			ajouterErreur("Il n'y a aucun compte rendu");
			include(VIEWSPATH."v_erreurs.php");
			break;
		}
		
		include(VIEWSPATH."v_listeCompteRenduRegion.php");
		break;
    }
	case"choixResponsable":{
		$idCollaborateur = $_SESSION['idVisiteur'];
		$secteur = $pdo->getSecteurResponsable($idCollaborateur);
		$lesRegions = $pdo->getRegionsDuSecteur($secteur);
		$lesIDDeleguesRegion = [];
		foreach($lesRegions as $region){
			array_push($lesIDDeleguesRegion, $pdo->getDelegueRegion($region[0]));
		}
		$lesDeleguesRegion = [];
		foreach($lesIDDeleguesRegion as $ID){
			if(!empty($ID)){
				array_push($lesDeleguesRegion, $pdo->getInfosCollaborateur($ID[0]));
			}
		}

		include(VIEWSPATH."v_listeDelegue.php");
		break;
	}
    case"consulter":{
		//Récupération des valeurs à modifier
		$num = $_POST['lstRapport'];
		$leCompteRendu = $pdo->getLeCompteRendu($num);
		$dateVisite = $leCompteRendu['RAP_DATE_VISITE'];
		$leNumPraticien = $leCompteRendu['PRA_NUM'];
		$lePraticien = $pdo->getUnPratitien($leNumPraticien);
		$leNumRemplacant = $leCompteRendu['PRA_NUM_REMPLACANT'];
		if($leNumRemplacant != NULL){
			$leRemplacant = $pdo->getUnPratitien($leNumRemplacant);
		} else {
			$leRemplacant = NULL;
		}
		$leCodeMotif = $leCompteRendu['MOT_CODE'];
		$leMotif = $pdo->getLeMotif($leCodeMotif);
		if($leCodeMotif == "AUTMO"){
			$autre_motif = $leCompteRendu['RAP_MOTIF_AUTRE'];
		} else {
			$autre_motif = "";
		}
		$bilan = $leCompteRendu['RAP_BILAN'];
			//Récupération des présentations
		$lesMedicaments = $pdo->getLesMedicaments();
		$lesPresentation = $pdo->getLesPresentationRapport($num);
		if($pdo->getNbPresentation($num) == 1){
			$produit1 = $pdo->getUnMedicament($lesPresentation[0]['MED_DEPOTLEGAL']);
		} elseif ($pdo->getNbPresentation($num) == 2) {
			$produit1 = $pdo->getUnMedicament($lesPresentation[0]['MED_DEPOTLEGAL']);
			$produit2 = $pdo->getUnMedicament($lesPresentation[1]['MED_DEPOTLEGAL']);
		}
			//récupération des échantillons
		$lesEchantillons = $pdo->getLesEchantillonsRapport($num);
		$tabNomEchantillons = [];
		$tabQteEchantillons = [];
		foreach($lesEchantillons as $unEchantillon){
			array_push($tabNomEchantillons, $pdo->getUnMedicament($unEchantillon['MED_DEPOTLEGAL'])['MED_NOMCOMMERCIAL']);
			array_push($tabQteEchantillons, $unEchantillon['OFF_QTE']);
		}

		$date_saisie = $leCompteRendu['RAP_DATE_SAISIE'];

		include(VIEWSPATH."v_consulterCompteRendu.php");
		break;
    }

}


?>