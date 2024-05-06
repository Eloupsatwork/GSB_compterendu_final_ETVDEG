 <div id="contenu">
      <h2>Choisir un délégué régional</h2>
      <form action="index.php?uc=consulterCompteRenduRegion&action=choixDelegue" method="post">
      <div class="corpsForm">
  
	  <p>
		<label for="lstDelegue">Choisir le délégue</label>
		<select name='lstDelegue' id='lstDelegue'>

		<?php foreach($lesDeleguesRegion as $Delegue){ ?>
			<option value="<?= $Delegue['matricule']?>"><?= $Delegue['nom']." ".$Delegue['prenom'] ?></option>
		<?php } ?>
		
		</select>
	  </p>  

       <p class="titre" /><label class="titre">&nbsp;</label>
		<input class="zone" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" /> 
		</p> 
	  </div>
      </form>
