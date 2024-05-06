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
	case 'f_ajouter':{
		$num = $pdo->getMaxNumPraticien();
		$lesTypes = $pdo->getLesTypesPraticien();
		include(VIEWSPATH."v_ajoutPraticien.php");
		break;
	}
	case 'ajouter':{
		$num = $_POST['txtNumero'];
		$nom = $_POST['txtNom'];
		$prenom = $_POST['txtPrenom'];
		$adresse = $_POST['txtAdresse'];
		$cp = $_POST['txtCp'];
		$ville = $_POST['txtVille'];
		$notoriete = $_POST['txtNotoriete'];
		$confiance = $_POST['txtConfiance'];
		$idType = $_POST['lstType'];
		if(!isset($num) || !isset($nom) || !isset($prenom) || !isset($adresse) || !isset($cp) || !isset($ville) || !isset($notoriete) || !isset($confiance) || !isset($idType)){
			ajouterErreur("Erreur de paramètre");
			include(VIEWSPATH."v_erreurs.php");
		}
		else{
			$pdo->ajouterPraticien($num, $nom, $prenom, $adresse, $cp, $ville, $notoriete, $confiance, $idType);
			include(VIEWSPATH."v_praticienValide.php");
		}
		break;

	}
}
?>
