<div id="contenu">
	<h2>Compte-rendu de visite</h2>
		<form method="POST"  action="index.php?uc=ajouterCompteRendu&action=ajouter">
			<p>
				<label for="txtNumero">NUMERO : </label>
				<input type="text" size="10" name="txtNumero" id="txtNumero" value="<?= $numCompteRendu ?>"/>
			</p>
			<p>
				<label for="txtDateVisite">DATE VISITE : </label>			
				<input type="date" size="10" name="txtDateVisite" id="txtDateVisite" />
			</p>
			<p>
				<label for="lstPraticien">PRATICIEN : </label>
				<select id="lstPraticien" name="lstPraticien" >

				<?php foreach($lesPraticiens as $praticien){ ?>
					<option value="<?= $praticien['PRA_NUM']?>"><?= $praticien['PRA_NOM']." ".$praticien['PRA_PRENOM']?></option>
				<?php } ?>
				
				</select>
			</p>
			<p>
				<label for="txtConfiance">COEFFICIENT CONFIANCE : </label>
				<input type="text" size="6" name="txtConfiance" id="txtConfiance" />
			</p>
			<p>
				<label for="lstRemplacant">REMPLACANT : </label>
				<input type="checkbox" name="chkRemplacant" />
				<select id="lstRemplacant" name="lstRemplacant" >

				<?php foreach($lesPraticiens as $praticien){ ?>
					<option value="<?= $praticien['PRA_NUM']?>"><?= $praticien['PRA_NOM']." ".$praticien['PRA_PRENOM']?></option>
				<?php } ?>

				</select>
			</p>
			<p>
				<label for="lstMotif">MOTIF : </label>
				<select id="lstMotif" name="lstMotif" >

					<?php foreach($lesMotifs as $motif){ ?>
						<option value="<?= $motif['MOT_CODE'] ?>"><?= $motif['MOT_LIBELLE'] ?></option>
					<?php } ?>
					
				</select>
				<input type="text" name="txtAutreMotif" />
			</p>
			<p>
				<label for="txtBilan" ><h3> Bilan </h3></label>
				<textarea rows="5" cols="50" name="txtBilan" id="txtBilan" ></textarea>
			</p>
			<p>
				<label class="titre" ><h3> Eléments présentés </h3></label>
				<label for="chkProduitPresente1">COCHEZ LA CASE : </label>
				<input type="checkbox" name="chkProduitPresente1" id="chkProduitPresente1"/>
				<label for="lstProduit1">CHOISIR PRODUIT 1 : </label>
				<select id="lstProduit1" name="lstProduit1" >
		
					<?php foreach($lesMedicaments as $medicament){ ?>
						<option value="<?= $medicament['MED_DEPOTLEGAL'] ?>"><?= $medicament['MED_NOMCOMMERCIAL']?></option>
					<?php } ?>

				</select>
				<br>
				<label for="chkProduitPresente2">COCHEZ LA CASE : </label>
				<input type="checkbox" name="chkProduitPresente2" id="chkProduitPresente2"/>
				<label for="lstProduit2">CHOISIR PRODUIT 2 : </label>
				<select id="lstProduit2" name="lstProduit2" >
				
					<?php foreach($lesMedicaments as $medicament){ ?>
						<option value="<?= $medicament['MED_DEPOTLEGAL'] ?>"><?= $medicament['MED_NOMCOMMERCIAL']?></option>
					<?php } ?>

				</select>
				<br>
				<label for="chkDoc">DOCUMENTATION OFFERTE : </label>
				<input name="chkDoc" type="checkbox" id="chkDoc"/>
			</p>
			<p>
				<label class="titre"><h3>Echantillons</h3></label>
				<div class="titre" id="lignes">

					<?php
						for ($i=1; $i<=10; $i=$i+1)
						{	
							if ($i % 2 != 0)
							{ 
						?>
							<p>
						<?php
							}
						?>						
							<label for="lstEchantillon<?= $i ?>">PRODUIT <?= $i; ?> : </label>
							<select id="lstEchantillon<?= $i ?>" name="lstEchantillon<?= $i ?>" >

								<?php foreach($lesMedicaments as $medicament){ ?>
									<option value="<?= $medicament['MED_DEPOTLEGAL'] ?>"><?= $medicament['MED_NOMCOMMERCIAL']?></option>
								<?php } ?>
							
							</select>
							<input type="text" name="txtQte<?= $i ?>" size="2" />
						<?php
		
							if ($i % 2 == 0)
							{  
						?>
								<br>
								</p>
						<?php
							}
						}
						?>
			
				</div>
			</p>
			<p>
				<label for="txtDateSaisie">DATE SAISIE : </label>
				<input type="text" size="10" name="txtDateSaisie" id="txtDateSaisie" placeholder="AAAA/MM/JJ"/>
			</p>
			<p>
				<label for="chkSaisie">SAISIE DEFINITIVE : </label>
				<input name="chkSaisie" type="checkbox" id="chkSaisie" />
			</p>
			<p>
				<input type="submit" value="Valider"></input>			
				<input type="reset" value="Annuler"></input>
			</p>
		</form>


