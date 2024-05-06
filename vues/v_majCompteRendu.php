<div id="contenu">
    <h2>Modifier un compte rendu</h2>
 	<form method="POST"  action="index.php?uc=majCompteRendu&action=modifier">
			<p>
				<label for="txtNumero">NUMERO : </label>
				<input type="text" size="10" id="txtNumero" name="txtNumero" readonly value="<?= $num ?>" />
			</p>
			<p>
				<label for="txtDateVisite">DATE VISITE : </label>			
				<input type="text" size="10" id="txtDateVisite" name="txtDateVisite" value="<?=$dateVisite?>" placeholder="AAAA/MM/JJ" />
			</p>
			<p>
				<label for="lstPraticien">PRATICIEN : </label>
				<select id="lstPraticien" name="lstPraticien" >

					<?php foreach($lesPraticiens as $praticien){ ?>
						<option value="<?= $praticien['PRA_NUM']?>" <?php if($praticien['PRA_NUM'] == $leNumPraticien){ echo "Selected"; } ?>><?= $praticien['PRA_NOM']." ".$praticien['PRA_PRENOM']?></option>
					<?php } ?>
				
				</select>
			</p>
			<p>
				<label for="txtConfiance">COEFFICIENT CONFIANCE : </label>
				<input type="text" size="6" id="txtConfiance" name="txtConfiance" value="<?=$lePraticien['PRA_COEFCONFIANCE'] ?>"/>
			</p>
			<p>
				<label for="lstRemplacant">REMPLACANT : </label>
				<input type="checkbox" name="chkRemplacant" <?php if($leNumRemplacant != NULL){ echo "checked"; } ?> />
				<select id="lstRemplacant" name="lstRemplacant" >

					<?php foreach($lesPraticiens as $praticien){ ?>
						<option value="<?= $praticien['PRA_NUM']?>" <?php if($praticien['PRA_NUM'] == $leNumRemplacant){ echo "Selected"; } ?>><?= $praticien['PRA_NOM']." ".$praticien['PRA_PRENOM']?></option>
					<?php } ?>

				</select>
			</p>
			<p>
				<label for="lstMotif">MOTIF : </label>
				<select id="lstMotif" name="lstMotif" >
					<?php foreach($lesMotifs as $motif){ ?>
						<option value="<?= $motif['MOT_CODE'] ?>" <?php if($motif['MOT_CODE'] == $leCodeMotif){ echo "Selected"; } ?>><?= $motif['MOT_LIBELLE'] ?></option>
					<?php } ?>
				</select>
				<input type="text" size="30" name="txtAutreMotif" value=" <?= $autre_motif ?> " />
			</p>
			<p>
				<label for="txtBilan" ><h3> Bilan </h3></label>
				<textarea rows="5" cols="50" id="txtBilan" name="txtBilan"  ><?= $bilan ?></textarea>
			</p>
			<p>
				<label class="titre" ><h3> Eléments présentés </h3></label>
				<label for="chkProduitPresente1">COCHEZ LA CASE : </label>
				<input type="checkbox" name="chkProduitPresente1" id="chkProduitPresente1" <?php if(isset($produit1)){ echo "checked"; } ?>/>
				
				<label for="lstProduit1">CHOISIR PRODUIT 1 : </label>
				<select id="lstProduit1" name="lstProduit1" >

				<?php foreach($lesMedicaments as $medicament){ ?>
					<option value="<?= $medicament['MED_DEPOTLEGAL'] ?>" <?php if(isset($produit1)){ if($medicament['MED_DEPOTLEGAL'] == $produit1['MED_DEPOTLEGAL']){ echo "Selected"; }} ?>><?= $medicament['MED_NOMCOMMERCIAL']?></option>
				<?php } ?>
				
				</select>
				</br></br>
				<label for="chkProduitPresente2">COCHEZ LA CASE : </label>
				<input type="checkbox" name="chkProduitPresente2" id="chkProduitPresente2" <?php if(isset($produit2)){ echo "checked"; } ?>/>
				<label for="lstProduit2">CHOISIR PRODUIT 2 : </label>
				<select id="lstProduit2" name="lstProduit2" >
				
				<?php foreach($lesMedicaments as $medicament){ ?>
					<option value="<?= $medicament['MED_DEPOTLEGAL'] ?>" <?php if(isset($produit2)){ if($medicament['MED_DEPOTLEGAL'] == $produit2['MED_DEPOTLEGAL']){ echo "Selected"; }} ?>><?= $medicament['MED_NOMCOMMERCIAL']?></option>
				<?php } ?>

				</select>
				</br></br>
				<label for="chkDoc">DOCUMENTATION OFFERTE : </label>
				<input name="chkDoc" type="checkbox" id="chkDoc" <?php if($leCompteRendu['RAP_DOCUMENTATION'] == 1){ echo "checked"; } ?>/>
				
			</p>
			<p>
				<label class="titre"><h3>Echantillons</h3></label>
				<div class="titre" id="lignes">

					<?php
						for ($i=0; $i<=9; $i=$i+1)
						{	
							if ($i % 2 == 0)
							{ 
						?>
							<p>
						<?php
							}
						?>						
							<label for="lstEchantillon<?= $i+1 ?>">PRODUIT <?= $i+1; ?> : </label>
							<select id="lstEchantillon<?= $i+1 ?>" name="lstEchantillon<?= $i+1 ?>" >

							<?php foreach($lesMedicaments as $medicament){ ?>
								<option value="<?= $medicament['MED_DEPOTLEGAL'] ?>" <?php if($medicament['MED_DEPOTLEGAL'] == $tabNomEchantillons[$i]){ echo "selected"; } ?>><?= $medicament['MED_NOMCOMMERCIAL']?></option>
							<?php } ?>
							
							</select>
							<input type="text" name="txtQte<?= $i+1 ?>" size="2" value="<?php echo $tabQteEchantillons[$i]; ?> " />
						<?php
		
							if ($i % 2 != 0)
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
				<input type="text" size="10" id="txtDateSaisie" name="txtDateSaisie" value="<?= $date_saisie ?>" placeholder="AAAA/MM/JJ" />
			</p>
			<p>
				<label for="chkSaisie">SAISIE DEFINITIVE : </label>
				<input id="chkSaisie" name="chkSaisie" type="checkbox"  />
			</p>
			<p>
				<input type="submit" value="Valider"></input>			
				<input type="reset" value="Annuler"></input>
			</p>
	</form>



