 <div id="contenu">
      <h2>Choisissez un Visiteur</h2>
      <form action="index.php?uc=consulterCompteRenduVisiteur&action=choixRapport" method="post">
      <div class="corpsForm">
  
	  <p>
		<label for="lstVisiteur">Choisir le rapport</label>
		<select name='lstVisiteur' id='lstVisiteur'>

   		<?php foreach($lesVisiteurs as $Visiteur){?>
			<option value="<?= $Visiteur['COL_MATRICULE']?>"><?= $Visiteur['COL_NOM']." ".$Visiteur['COL_PRENOM']?></option>
		<?php } ?>
		
		</select>
	  </p>  

       <p class="titre" /><label class="titre">&nbsp;</label>
		<input class="zone" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" /> 
		</p> 
	  </div>
      </form>
