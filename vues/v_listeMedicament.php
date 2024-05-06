 <div id="contenu">
      <h2>Consulter les médicaments</h2>
      <form action="index.php?uc=consulterMedicament&action=consulter" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstMedicament" accesskey="n">MEDICAMENT : </label>
        <select id="lstMedicament" name="lstMedicament">

          <?php foreach($lesMedicaments as $unMedicament){ ?>
            <option value="<?= $unMedicament['MED_DEPOTLEGAL'];?>"><?= $unMedicament['MED_NOMCOMMERCIAL'];?></option>
          <?php } ?>
            
        </select>
      </p>
        <p class="titre" /><label class="titre">&nbsp;</label>
		<input class="zone" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>    
      </form>
