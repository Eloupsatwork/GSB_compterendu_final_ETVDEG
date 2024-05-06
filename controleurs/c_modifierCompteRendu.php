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
	case('selection'):{
		$lesComptesRendus = $pdo->getLesComptesRendus();

		include(VIEWSPATH."v_listeCompteRenduMAJ.php");
		break;
	}
	case('f_modifier'):{
		//Récupération des valeurs à modifier
		$num = $_POST['lstRapport'];
		$leCompteRendu = $pdo->getLeCompteRendu($num);
		$dateVisite = $leCompteRendu['RAP_DATE_VISITE'];
		$lesPraticiens = $pdo->getLesPraticiens();
		$leNumPraticien = $leCompteRendu['PRA_NUM'];
		$lePraticien = $pdo->getUnPratitien($leNumPraticien);
		$leNumRemplacant = $leCompteRendu['PRA_NUM_REMPLACANT'];
		$leCodeMotif = $leCompteRendu['MOT_CODE'];
		$lesMotifs = $pdo->getLesMotifs();
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
			$produit1 = $lesPresentation[0];
		} elseif ($pdo->getNbPresentation($num) == 2) {
			$produit1 = $lesPresentation[0];
			$produit2 = $lesPresentation[1];
		}
			//récupération des échantillons
		$lesEchantillons = $pdo->getLesEchantillonsRapport($num);
		$tabNomEchantillons = [];
		$tabQteEchantillons = [];
		foreach($lesEchantillons as $unEchantillon){
			array_push($tabNomEchantillons, $unEchantillon['MED_DEPOTLEGAL']);
			array_push($tabQteEchantillons, $unEchantillon['OFF_QTE']);
		}

		$date_saisie = $leCompteRendu['RAP_DATE_SAISIE'];

		//affichge de la vue
		include(VIEWSPATH."v_majCompteRendu.php");
		break;
	}
	case('modifier'):{
		//Récupération des informations
		$idCollaborateur = $_SESSION['idVisiteur'];
		$numCompteRendu = $_POST['txtNumero'];
		$dateVisite = $_POST['txtDateVisite'];
		$IDPraticien = $_POST['lstPraticien'];
		$coefConfiance = $_POST['txtConfiance'];

		if(isset($_POST['chkRemplacant'])){
			if(isset($_POST['lstRemplacant'])){
				$IDRemplacant = $_POST['lstRemplacant'];
			}
			else{
				ajouterErreur("Choisissez un remplaçant");
				include(VIEWSPATH."v_erreurs.php");
				break;
			}
		}
		else{
			$IDRemplacant = NULL;
		}

		$motif = $_POST['lstMotif'];
		if($motif == "AUTMO"){
			$autre_motif = $_POST['txtAutreMotif'];
		}
		else{
			$autre_motif = NULL;
		}

		$bilan = $_POST['txtBilan'];

		
		if(isset($_POST['chkDoc'])){
			$docOffert = 1;
		}
		else{
			$docOffert = 0;
		}
		
		$lesEchantillons = [];
		for($i=1; $i<=10; $i++){
			array_push($lesEchantillons, [$_POST["lstEchantillon".$i], $_POST["txtQte".$i]]);
		}
		
		$datesaisie = $_POST['txtDateSaisie'];
		
		if(isset($_POST['chkSaisie'])){
			$saisieDef = 1;
		}
		else{
			$saisieDef = 0;
		}
		
		//Vérification des données du rapport
		if(!isset($idCollaborateur) && !isset($numCompteRendu) && !isset($IDPraticien) && !isset($dateVisite) && !isset($datesaisie) && !isset($bilan) && !isset($motif) && !isset($docOffert) && !isset($saisieDef)){
			ajouterErreur("Erreur de saisie");
			include(VIEWSPATH."v_erreurs.php");
			break;
		}
		
		//test des variables pour présenter
		if(isset($_POST['chkProduitPresente1'])){
			if(!isset($_POST['lstProduit1'])){
				ajouterErreur("Choisissez un produit 1");
				include(VIEWSPATH."v_erreurs.php");
				break;
			}
		}
		if(isset($_POST['chkProduitPresente2'])){
			if(!isset($_POST['lstProduit2'])){
				ajouterErreur("Choisissez un produit 2");
				include(VIEWSPATH."v_erreurs.php");
				break;
			}
		}

		//test des variables pour les échantillons
		for($i=0; $i<=9; $i++){
			if(!isset($lesEchantillons[$i][0])){
				$numéro = $i + 1;
				ajouterErreur("Choisissez un médicament pour l'échantillon $numéro");
				include(VIEWSPATH."v_erreurs.php");
				break;
			}

			if(!isset($lesEchantillons[$i][1])){
				$numéro = $i + 1;
				ajouterErreur("Choisissez une quantité pour l'échantillon $numéro");
				include(VIEWSPATH."v_erreurs.php");
				break;
			}
					
		}

		//création du rapport de visite
		$pdo->majCompteRendu($numCompteRendu, $idCollaborateur, $IDPraticien, $IDRemplacant, $dateVisite, $datesaisie, $bilan, $autre_motif, $motif, $docOffert, $saisieDef);

		//suppression des produits présentés pour les réinssérer
		$pdo->supprimerPresentationRapport($numCompteRendu);
		//Insertion produit 1
		if(isset($_POST['chkProduitPresente1'])){
			$produitPresente1 = $_POST['lstProduit1'];
			$pdo->ajouterPresentation($produitPresente1, $idCollaborateur, $numCompteRendu);	
		}
		//Insertion produit 2
		if(isset($_POST['chkProduitPresente2'])){
			$produitPresente2 = $_POST['lstProduit2'];
			$pdo->ajouterPresentation($produitPresente2, $idCollaborateur, $numCompteRendu);
		}


		//suppression des échantillons pour les réinssérer
		$pdo->supprimerEchantillonsRapport($numCompteRendu);
		//Insertion des échantillons
		for($i=0; $i<=9; $i++){
			$pdo->ajouterEchantillon($idCollaborateur, $numCompteRendu, $lesEchantillons[$i][0], $lesEchantillons[$i][1]);
		}
		
		//Modification du coefConfiance
		$pdo->updateConfiance($IDPraticien, $coefConfiance);


		include(VIEWSPATH."v_compteRenduValide.php");
		break;
	}

}

?>