 <div id="contenu">
      <h2>Consulter les praticiens</h2>
      <form action="index.php?uc=consulterPraticien&action=consulter" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstPraticien" accesskey="n">PRATICIEN : </label>
        <select id="lstPraticien" name="lstPraticien">
          <?php foreach ($lesPraticiens as $unPraticien){ ?>
            <option value="<?= $unPraticien['PRA_NUM'];?>"><?= $unPraticien['PRA_NOM'], " ", $unPraticien['PRA_PRENOM'];?></option>
          <?php } ?>
            
        </select>
      </p>
        <p class="titre" /><label class="titre">&nbsp;</label>
		<input class="zone" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>    
      </form>
