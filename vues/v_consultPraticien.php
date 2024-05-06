      <div class="corpsForm">
		<p>
			<label for="txtNumero">NUMERO :</label>
			<input type="text" size="8" id="txtNumero" name="txtNumero" readonly value="<?= $id; ?>"  />
		</p>
		<p>
			<label for="txtNom">NOM :</label>
			<input type="text" size="25" id="txtNom" name="txtNom" readonly value="<?= $praticien['PRA_NOM']; ?>"  />
		</p>
		<p>
			<label for="txtPrenom">PRENOM :</label>
			<input type="text" size="30" id="txtPrenom" name="txtPrenom" readonly value="<?= $praticien['PRA_PRENOM']; ?>"  />
			</p>
		<p>
			<label for="txtAdresse">ADRESSE :</label>
			<input type="text" size="50" id="txtAdresse" name="txtAdresse" readonly value="<?= $praticien['PRA_ADRESSE']; ?>"  />			
		</p>
		<p>
			<label for="txtCp">CODE POSTAL :</label>
			<input type="text" size="50" id="txtCp" name="txtCp" readonly value="<?= $praticien['PRA_CP']; ?>"  />
		</p>
		<p>
			<label for="txtVille">VILLE :</label>
			<input type="text" size="50" id="txtVille" name="txtVille" readonly value="<?= $praticien['PRA_VILLE']; ?>"  />
		</p>
		<p>
			<label for="txtNotoriete">COEFF. NOTORIETE :</label>
			<input type="text" size="7" id="txtNotoriete" name="txtNotoriete" readonly value="<?= $praticien['PRA_COEFNOTORIETE']; ?>"  />			
		</p>
		<p>
			<label for="txtConfiance">COEFF. CONFIANCE	 :</label>
			<input type="text" size="7" id="txtConfiance" name="txtConfiance" readonly value="<?= $praticien['PRA_COEFCONFIANCE']; ?>"  />
		</p>
		<p>
			<label for="txtType">TYPE :</label>
			<input type="text" size="25" id="txtType" name="txtType" readonly value="<?= $type ?>"  />
		</p>
		<p>
			<label for="txtLieu">LIEU :</label>
			<input type="text" size="35" id="txtLieu" name="txtLieu" readonly value="<?= $lieu ?>"  />
		</p>
	  </div>
