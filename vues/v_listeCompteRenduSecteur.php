 <div id="contenu">
      <h2>Choisir un compte rendu du secteur</h2>
      <form action="index.php?uc=consulterCompteRenduRegion&action=consulter" method="post">
      <div class="corpsForm">
  
	  <p>
		<label for="lstRapport">Choisir le rapport</label>
		<select name='lstRapport' id='lstRapport'>

		<?php foreach($lesComptesRendus[0] as $CompteRendu){?>
			<option value="<?= $CompteRendu['RAP_NUM']?>"><?= "numéro ".$CompteRendu['RAP_NUM'] ?></option>
		<?php } ?>
		
		</select>
	  </p>  

       <p class="titre" /><label class="titre">&nbsp;</label>
		<input class="zone" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" /> 
		</p> 
	  </div>
      </form>
