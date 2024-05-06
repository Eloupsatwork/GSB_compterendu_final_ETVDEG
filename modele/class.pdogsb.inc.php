<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */
		
class PdoGsb{   		
      	private static $serveur=DB_HOST;
      	private static $bdd=DB_NAME;   		
      	private static $user=DB_LOGIN;    		
      	private static $mdp=DB_MDP;		
		private static $monPdo;
		private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
		PdoGsb::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}


/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES TRANSACTIONS                                -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */
	


/**
 * Démarre une transaction
*/
	public function demarreTransaction(){
		PdoGsb::$monPdo->beginTransaction();
	}	

/**
 * Valide une transaction
*/
	public function valideTransaction(){
		PdoGsb::$monPdo->commit();
	}	

/**
 * Annule une transaction
*/
	public function annuleTransaction(){
		PdoGsb::$monPdo->rollback();
	}			


/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES UTILISATEURS                                 -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */


	
/**
 * Retourne le matricule d'un collaborateur
 
 * @param $login 
 * @param $mdp
 * @return le matricule sous la forme d'un tableau associatif 
*/
	public function getIdCollaborateur($login, $mdp){
		$req = "select COLLABORATEUR.COL_MATRICULE as matricule from COLLABORATEUR 
		where COLLABORATEUR.COL_LOGIN= :login and COLLABORATEUR.COL_MDP= :mdp";
		$idJeuRes = PdoGsb::$monPdo->prepare($req); 
		$idJeuRes->execute(array( ':login' => $login, ':mdp' => $mdp));			
		$ligne = $idJeuRes->fetch();
		return $ligne;
	}



/**
 * Retourne les informations d'un collaborateur
 
 * @param $matricule 
 * @return le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosCollaborateur($matricule){
		$req = "select COLLABORATEUR.COL_NOM as nom, COLLABORATEUR.COL_PRENOM as prenom, COLLABORATEUR.COL_MATRICULE as matricule from COLLABORATEUR 
		where COLLABORATEUR.COL_MATRICULE = :matricule";
		$idJeuRes = PdoGsb::$monPdo->prepare($req); 
		$idJeuRes->execute(array( ':matricule' => $matricule));			
		$ligne = $idJeuRes->fetch();
		return $ligne;
	}

	
/**
 * Retourne tous les visiteurs (collaborateurs non responsables)
 * @param string $nomTable nom de la table demandée
 * @param string $nomColonne critère de tri
 * @return array 
 */
	function getLesVisiteurs(){
        $req = "SELECT COL_MATRICULE, COL_NOM, COL_PRENOM FROM collaborateur LEFT JOIN responsable ON COL_MATRICULE = RES_MATRICULE WHERE RES_MATRICULE IS NULL";
		$idJeuRes = PdoGsb::$monPdo->prepare($req); 
		$idJeuRes->execute();			
		$lignes = $idJeuRes->fetchAll();
		return $lignes;
	}

/**
 * @param $matricule 
 * @return un char qui correspond au grade du collaborateur
*/
	function getGradeCollaborateur($matricule){
		$req = "select RESPONSABLE.RES_MATRICULE as matricule from RESPONSABLE where RESPONSABLE.RES_MATRICULE = :matricule";
		$idJeuRes = PdoGsb::$monPdo->prepare($req); 
		$idJeuRes->execute(array( ':matricule' => $matricule));			
		$ligne = $idJeuRes->fetch();
		if(isset($ligne[0])){
			return "R";
		}
		else{
			$req = "select DELEGUE_REGIONAL.DEL_MATRICULE as matricule from DELEGUE_REGIONAL where DELEGUE_REGIONAL.DEL_MATRICULE = :matricule";
			$idJeuRes = PdoGsb::$monPdo->prepare($req); 
			$idJeuRes->execute(array( ':matricule' => $matricule));			
			$ligne = $idJeuRes->fetch();
			if(isset($ligne[0])){
				return "D";
			}
			else{
				return "V";
			}
		}
	}


/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES MEDICAMENTS                                 -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */

/**
 * @return les Médicaments
 */

	function getLesMedicaments(){
		$req = "SELECT MED_DEPOTLEGAL, MED_NOMCOMMERCIAL, FAM_CODE, MED_COMPOSITION, MED_EFFETS, MED_CONTREINDIC FROM medicament ORDER BY MED_NOMCOMMERCIAL";
		$idJeuRes = PdoGsb::$monPdo->prepare($req);
		$idJeuRes->execute();
		$result = $idJeuRes->fetchAll();
		return $result;
	}

/** 
 * @param $id
 * @return médicament de l'identifiant entré
*/
	function getUnMedicament($id){
		$req = "SELECT MED_NOMCOMMERCIAL, FAM_CODE, MED_COMPOSITION, MED_EFFETS, MED_CONTREINDIC FROM medicament WHERE MED_DEPOTLEGAL = :id";
		$idJeuRes = PdoGsb::$monPdo->prepare($req);
		$idJeuRes->execute(array(":id" => $id));
		$result = $idJeuRes->fetch();
		return $result;
	}

/**
 * @param $famille
 * @return famille du code entré
 */

	function getFamilleMedicament($famille){
		$req = "SELECT FAM_LIBELLE FROM famille WHERE FAM_CODE = :code";
		$idJeuRes = PdoGSB::$monPdo->prepare($req);
		$idJeuRes->execute(array(":code" => $famille));
		$result = $idJeuRes->fetch();
		return $result[0];
	}

/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES PRATICIENS                                 -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */
		
/**
 * @return les praticiens
 */

	function getLesPraticiens(){
		$req = "select PRATICIEN.PRA_NUM, PRATICIEN.PRA_NOM, PRATICIEN.PRA_PRENOM, PRATICIEN.PRA_ADRESSE, PRATICIEN.PRA_CP, PRATICIEN.PRA_VILLE, PRATICIEN.PRA_COEFNOTORIETE, PRATICIEN.PRA_COEFCONFIANCE, PRATICIEN.TYP_CODE from PRATICIEN ORDER BY PRA_NOM";
		$idJeuRes = PdoGsb::$monPdo->prepare($req); 
		$idJeuRes->execute();			
		$lignes = $idJeuRes->fetchAll();
		return $lignes;
	}
			
/**
 * @param $id
 * @return les praticiens
 */

 function getUnPratitien($id){
	$req = "select PRATICIEN.PRA_NOM, PRATICIEN.PRA_PRENOM, PRATICIEN.PRA_ADRESSE, PRATICIEN.PRA_CP, PRATICIEN.PRA_VILLE, PRATICIEN.PRA_COEFNOTORIETE, PRATICIEN.PRA_COEFCONFIANCE, PRATICIEN.TYP_CODE from PRATICIEN WHERE PRATICIEN.PRA_NUM = :num";
	$idJeuRes = PdoGsb::$monPdo->prepare($req); 
	$idJeuRes->execute(array(":num" => $id));			
	$ligne = $idJeuRes->fetch();
	return $ligne;
}

/**
 * @param $type
 * @return le type praticien et le lieu du code type en paramètre
 */

 function getTypePratitien($type){
	$req = "select TYP_LIBELLE, TYP_LIEU from TYPE_PRATICIEN where TYP_CODE = :type";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":type" => $type));
	$result = $idJeuRes->fetchAll();
	return $result[0];
 }

/**
 * @return un numéro libre de praticien
 */

 function getMaxNumPraticien(){
	$req = "SELECT MAX(PRA_NUM) FROM PRATICIEN";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute();
	$result = $idJeuRes->fetch();
	return ($result[0] + 1);
 }

/**
 * @return les types d'un praticien
 */

 function getLesTypesPraticien(){
	$req = "SELECT TYP_CODE, TYP_LIBELLE, TYP_LIEU FROM type_praticien ORDER BY TYP_LIBELLE";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute();
	$result = $idJeuRes->fetchAll();
	return $result;
 }

 /**
  * @param $num
  * @param $nom
  * @param $prenom
  * @param $adresse
  * @param $cp
  * @param $ville
  * @param $notoriete
  * @param $confiance
  * @param $idType
  */
 function ajouterPraticien($num, $nom, $prenom, $adresse, $cp, $ville, $notoriete, $confiance, $idType){
	$req = "INSERT INTO praticien VALUES(:num, :nom, :prenom, :adresse, :cp, :ville, :notoriete, :confiance, :idtype)";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$param = array(":num" => $num, ":nom" => $nom, ":prenom" => $prenom, ":adresse" => $adresse, ":cp" => $cp, ":ville" => $ville, ":notoriete" => $notoriete, ":confiance" => $confiance, "idtype" => $idType);
	$idJeuRes->execute($param);
 }


 /**
  * @param $num
  * @param $coef
  */
 function updateConfiance($num, $coef){
	$req = "UPDATE praticien SET PRA_COEFCONFIANCE = :coef WHERE PRA_NUM = :num";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$param = array(":num" => $num , ":coef" => $coef);
	$idJeuRes->execute($param);
 }

/**------------------------------------------------------------------------------------------------------------- */
/**---------------                   LES COMPTES-RENDUS                                -------------------------- */
/**------------------------------------------------------------------------------------------------------------- */
		
/**
 * @return un numéro libre de rapport_visite
 */

 function getMaxNumCompteRendu(){
	$req = "SELECT MAX(RAP_NUM) FROM rapport_visite";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute();
	$result = $idJeuRes->fetch();
	return ($result[0] + 1);
 }

/**
 * @return les motifs de visites
 */

 function getLesMotifs(){
	$req = "SELECT MOT_CODE, MOT_LIBELLE FROM motif ORDER BY MOT_LIBELLE";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute();
	$result = $idJeuRes->fetchAll();
	return $result;
 }

 /**
  * @param $idcolab
  * @param $numRapport
  * @param $numPraticien
  * @param $IDRemplacant
  * @param $dateVisite
  * @param $bilan
  * @param $motifAutre
  * @param $motif
  * @param $doc
  * @param $saisie
  */

  function ajouterCompteRendu($idcolab, $numRapport, $numPraticien, $IDRemplacant, $dateVisite, $datesaisie, $bilan, $motifAutre, $motif, $doc, $saisie){
	$req = "INSERT INTO rapport_visite VALUES(:idColab, :numRapport, :numPraticien, :remplacant, :dateVisite, :dateSaisie, :bilan, :motifAutre, :motif, :documentation, :saisieDef)";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$param = array(":idColab" => $idcolab, ":numRapport" => $numRapport, ":numPraticien" => $numPraticien, ":remplacant" => $IDRemplacant, ":dateVisite" => $dateVisite, ":dateSaisie" => $datesaisie, ":bilan" => $bilan, ":motifAutre" => $motifAutre, ":motif" => $motif, ":documentation" => $doc, ":saisieDef" => $saisie);
	$idJeuRes->execute($param);
  }


  /**
   * @param $medicament
   * @param $collaborateur
   * @param $rapport
   */
  function ajouterPresentation($medicament, $collaborateur, $rapport){
	$req = "INSERT INTO presenter VALUES(:med, :collab, :rapport)";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$param = array(":med" => $medicament, ":collab" => $collaborateur, ":rapport" => $rapport);
	$idJeuRes->execute($param);
  }

  /**
   * @param $collaborateur
   * @param $rapport
   * @param $medicament
   * @param $qte
   */
  function ajouterEchantillon($collaborateur, $rapport, $medicament, $qte){
	$req = "INSERT INTO offrir VALUES(:collab, :rapport, :med, :qte)";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$param = array(":collab" => $collaborateur, ":rapport" => $rapport, ":med" => $medicament, ":qte" => $qte);
	$idJeuRes->execute($param);
  }

  /**
   * @param $num
   */
  function supprimerCompteRendu($num){
	$req = "DELETE FROM rapport_visite WHERE RAP_NUM = :num";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$param = array(":num" => $num);
	$idJeuRes->execute($param);
  }

  /**
   * @return les rapports de visite
   */
  function getLesComptesRendus(){
	$req = "SELECT COL_MATRICULE, RAP_NUM, PRA_NUM, PRA_NUM_REMPLACANT, RAP_DATE_VISITE, RAP_DATE_SAISIE, RAP_BILAN, RAP_MOTIF_AUTRE, MOT_CODE, RAP_DOCUMENTATION, RAP_SAISIEDEFINITIVE FROM rapport_visite";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute();
	$result = $idJeuRes->fetchAll();
	return $result;
  }

  /**
   * @param $num
   * @return le compte rendu du numéro
   */
  function getLeCompteRendu($num){
	$req = "SELECT COL_MATRICULE, PRA_NUM, PRA_NUM_REMPLACANT, RAP_DATE_VISITE, RAP_DATE_SAISIE, RAP_BILAN, RAP_MOTIF_AUTRE, MOT_CODE, RAP_DOCUMENTATION, RAP_SAISIEDEFINITIVE FROM rapport_visite WHERE RAP_NUM = :num";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":num" => $num));
	$result = $idJeuRes->fetch();
	return $result;
  }

  /**
   * @param $num
   * @return le nombre de présentation d'un compte rendu
   */
  function getNbPresentation($num){
	$req = "SELECT COUNT(MED_DEPOTLEGAL) FROM presenter WHERE RAP_NUM = :num";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":num" => $num));
	$result = $idJeuRes->fetch();
	return $result[0];
  }

  /**
   * @param $num
   * @return les présentations d'un compte rendu
   */
  function getLesPresentationRapport($num){
	$req = "SELECT MED_DEPOTLEGAL, COL_MATRICULE, RAP_NUM FROM presenter WHERE RAP_NUM = :num";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":num" => $num));
	$result = $idJeuRes->fetchAll();
	return $result;
  }

  /**
   * @param $num
   * @return les échantillons d'un compte rendu
   */
  function getLesEchantillonsRapport($num){
	$req = "SELECT COL_MATRICULE, MED_DEPOTLEGAL, OFF_QTE FROM offrir where RAP_NUM = :num";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":num" => $num));
	$result = $idJeuRes->fetchAll();
	return $result;
  }

  /**
   * @param $num
   * @param $idCollaborateur
   * @param $IDPraticien
   * @param $IDRemplacant
   * @param $dateVisite
   * @param $dateSaisie
   * @param $bilan
   * @param $autre_motif
   * @param $motif
   * @param $docOffert
   * @param $saisieDef
   */
  function majCompteRendu($num, $idCollaborateur, $IDPraticien, $IDRemplacant, $dateVisite, $dateSaisie, $bilan, $autre_motif, $motif, $docOffert, $saisieDef){
	$req = "UPDATE rapport_visite SET COL_MATRICULE = :idCollab, PRA_NUM = :idPrat, PRA_NUM_REMPLACANT = :idRemp, RAP_DATE_VISITE = :dateVisite, RAP_DATE_SAISIE = :dateSaisie, RAP_BILAN = :bilan, RAP_MOTIF_AUTRE = :autreMotif, MOT_CODE = :motif, RAP_DOCUMENTATION = :doc, RAP_SAISIEDEFINITIVE = :saisieDef WHERE RAP_NUM = :num";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$param = array(":idCollab" => $idCollaborateur, ":idPrat" => $IDPraticien, ":idRemp" => $IDRemplacant, ":dateVisite" => $dateVisite, ":dateSaisie" => $dateSaisie, ":bilan" => $bilan, ":autreMotif" => $autre_motif, ":motif" => $motif, "doc" => $docOffert, ":saisieDef" => $saisieDef, ":num" => $num);
	$idJeuRes->execute($param);
  }

  /**
   * @param $num
   */
  function supprimerPresentationRapport($num){
	$req = "DELETE FROM presenter WHERE RAP_NUM = :num";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":num" => $num));
  }

  /**
   * @param $num
   */
  function supprimerEchantillonsRapport($num){
	$req = "DELETE FROM offrir WHERE RAP_NUM = :num";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":num" => $num));
  }

  /**
   * @param $leCode
   * @return le motif du code
   */
  function getLeMotif($leCode){
	$req = "SELECT MOT_LIBELLE FROM motif WHERE MOT_CODE = :code";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":code" => $leCode));
	$result = $idJeuRes->fetch();
	return $result;
  }

  /**
   * @return les comptes rendus de la region
   */
  function getLesComptesRendusRegion($delegue){
	$req = "SELECT RAP_NUM, PRA_NUM, PRA_NUM_REMPLACANT, RAP_DATE_VISITE, RAP_DATE_SAISIE, RAP_BILAN, RAP_MOTIF_AUTRE, MOT_CODE, RAP_DOCUMENTATION, RAP_SAISIEDEFINITIVE FROM rapport_visite WHERE COL_MATRICULE = :matricule";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":matricule" => $delegue));
	$result = $idJeuRes->fetchAll();
	return $result;
  }

  /**
   * @param $matricule
   * @return le secteur du responsable
   */
  function getSecteurResponsable($matricule){
	$req = "SELECT SEC_CODE FROM responsable WHERE RES_MATRICULE = :matricule";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":matricule" => $matricule));
	$result = $idJeuRes->fetch();
	return $result[0];
  }

  /**
   * @param $secteur
   * @return les regions du secteur
   */
  function getRegionsDuSecteur($secteur){
	$req = "SELECT REG_CODE FROM region WHERE SEC_CODE = :secteur";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":secteur" => $secteur));
	$result = $idJeuRes->fetchAll();
	return $result;
  }

  /**
   * @param $region
   * @return le délégué de la région
   */
  function getDelegueRegion($region){
	$req = "SELECT DEL_MATRICULE FROM delegue_regional WHERE REG_CODE = :region";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":region" => $region));
	$result = $idJeuRes->fetch();
	return $result;
  }

  function getLesComptesRendusVisiteur($matricule){
	$req = "SELECT RAP_NUM, PRA_NUM, PRA_NUM_REMPLACANT, RAP_DATE_VISITE, RAP_DATE_SAISIE, RAP_BILAN, RAP_MOTIF_AUTRE, MOT_CODE, RAP_DOCUMENTATION, RAP_SAISIEDEFINITIVE FROM rapport_visite WHERE COL_MATRICULE = :matricule";
	$idJeuRes = PdoGsb::$monPdo->prepare($req);
	$idJeuRes->execute(array(":matricule" => $matricule));
	$result = $idJeuRes->fetchAll();
	return $result;
  }

}	
?>