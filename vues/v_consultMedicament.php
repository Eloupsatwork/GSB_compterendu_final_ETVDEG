      <div class="corpsForm">
		<p>
			<label for="txtDepotLegal">DEPOT LEGAL : </label>
			<input type="text" size="15" id="txtDepotLegal" name="txtDepotLegal" readonly value="<?= $idMed ?>"  />
		</p>
		<p>
			<label for="txtNomCommercial">NOM COMMERCIAL : </label>
			<input type="text" size="25" id="txtNomCommercial" name="txtNomCommercial" readonly value="<?= $Medicament['MED_NOMCOMMERCIAL'] ?>" />
		</p>
		<p>
			<label for="txtFamille">FAMILLE : </label>
			<textarea rows="5" cols="50" id="txtFamille" name="txtFamille"><?= $famille ?></textarea>
		</p>
		<p>
			<label for="txtComposition">COMPOSITION : </label>
			<textarea rows="5" cols="50" id="txtComposition" name="txtComposition"><?= $Medicament['MED_COMPOSITION'] ?></textarea>
		</p>
		<p>
			<label for="txtEffet">EFFETS : </label>
			<textarea rows="5" cols="50" id="txtEffet" name="txtEffet"><?= $Medicament['MED_EFFETS'] ?></textarea>
		</p>
		<p>
			<label for="txtContreIndic">CONTRE INDICATIONS : </label>
			<textarea rows="5" cols="50" id="txtContreIndic" name="txtContreIndic"><?= $Medicament['MED_CONTREINDIC'] ?></textarea>
		</p>
	  </div>


