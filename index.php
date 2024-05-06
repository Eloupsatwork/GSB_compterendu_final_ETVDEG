<?php
session_start();
// Définition du chemin de la racine du site
define("APPATH", realpath(dirname("__FILE__")).DIRECTORY_SEPARATOR);
// Inclusion des paramètres de l'application
require_once APPATH."config".DIRECTORY_SEPARATOR."constants.php";
// Inclusion de la classe de gestion de la base de données
require_once (MODELSPATH."class.pdogsb.inc.php");
// Inclusion de l'entête et de l'include
include(VIEWSPATH."v_entete.php");
require_once(INCLUDEPATH."fct.inc.php");

$pdo = PdoGsb::getPdoGsb();
$estConnecteVisiteur = estConnecteVisiteur();

if(!isset($_REQUEST['uc']) || !$estConnecteVisiteur)
{
			$_REQUEST['uc'] = 'connexion';
	}
$uc = trim(htmlentities($_REQUEST['uc']));
switch($uc){
	case 'connexion':{	// (accessible visiteur, délégué et responsable)
		include(CONTROLLERSPATH."c_connexion.php");break;
	}
	case 'ajouterCompteRendu' :{    // (accessible visiteur, délégué)
		include(CONTROLLERSPATH."c_ajouterCompteRendu.php");
		break;
	}
		case 'majCompteRendu' :{    // (accessible visiteur, délégué)
		include(CONTROLLERSPATH."c_modifierCompteRendu.php");
		break;
	}
	case 'ajouterPraticien' :{    // (accessible visiteur, délégué)
		include(CONTROLLERSPATH."c_ajouterPraticien.php");
		break;
	}
	case 'consulterPraticien' :{	// (accessible visiteur, délégué)
		include(CONTROLLERSPATH."c_consulterPraticien.php");
		break; 
	}
	case 'consulterMedicament':{	// (accessible visiteur, délégué)
		include(CONTROLLERSPATH."c_consulterMedicament.php");
		break;
	}
	case 'consulterCompteRenduPeriode' :{  // compte-rendus sur une période (accessible visiteur, délégué et responsable)
		include(CONTROLLERSPATH."c_consulterCompteRenduPeriode.php");
		break;
	}
	case 'consulterCompteRenduRegion' :{  // compte-rendus d'une région (accessible délégué et responsable)
		include(CONTROLLERSPATH."c_consulterCompteRenduRegion.php");
		break;
	}
	case 'consulterCompteRenduVisiteur' :{  // compte-rendus d'un visiteur (accessible délégué et responsable)
		include(CONTROLLERSPATH."c_consulterCompteRenduVisiteur.php");
		break; 
	}
	case 'consulterCompteRenduSecteur' :{  // compte-rendus d'un secteur (accessible responsable)
		include(CONTROLLERSPATH."c_consulterCompteRenduSecteur.php");
		break; 		
	}	
	
}
// Inclusion du pied
include(VIEWSPATH."v_pied.php");
?>
