<div id="contenu">
    <h2>Modifier un compte rendu</h2>
 	<form method="POST"  action="index.php?uc=majCompteRendu&action=modifier">
			<p>
				<label for="txtNumero">NUMERO : </label>
				<input type="text" size="10" id="txtNumero" name="txtNumero" readonly value="<?= $num ?>" />
			</p>
			<p>
				<label for="txtDateVisite">DATE VISITE : </label>			
				<input type="text" size="10" id="txtDateVisite" name="txtDateVisite" value="<?=$dateVisite?>" placeholder="AAAA/MM/JJ" readonly />
			</p>
			<p>
				<label for="txtPraticien">PRATICIEN : </label>
				<input type="text" size="20" id="txtPraticien" name="txtPraticien" value="<?= $lePraticien['PRA_NOM']." ".$lePraticien['PRA_PRENOM']?>" readonly />
			</p>
			<p>
				<label for="txtConfiance">COEFFICIENT CONFIANCE : </label>
				<input type="text" size="6" id="txtConfiance" name="txtConfiance" value="<?=$lePraticien['PRA_COEFCONFIANCE'] ?>" readonly/>
			</p>
			<p>
				<label for="txtRemplacant">REMPLACANT : </label>
				<input type="text" size="20" id="txtRemplacant" name="txtRemplacant" <?php if($leRemplacant != NULL){ ?> value="<?= $leRemplacant['PRA_NOM']." ".$leRemplacant['PRA_PRENOM']; }?>" readonly />
			</p>
			<p>
				<label for="txtMotif">MOTIF : </label>
				<input type="text" size="20" id="txtMotif" name="txtMotif" value="<?= $leMotif['MOT_LIBELLE'] ?>" readonly />
				<label for="txtAutreMotif">AUTRE MOTIF : </label>
				<input type="text" size="30" name="txtAutreMotif" value=" <?= $autre_motif ?> " readonly />
			</p>
			<p>
				<label for="txtBilan" ><h3> Bilan </h3></label>
				<textarea rows="5" cols="50" id="txtBilan" name="txtBilan" readonly ><?= $bilan ?></textarea>
			</p>
			<p>
				<label class="titre" ><h3> Eléments présentés </h3></label>

				<label for="txtProduit1">PRODUIT 1 : </label>
				<input type="text" size="30" name="txtProduit1" value=" <?php if(isset($produit1)){ echo $produit1['MED_NOMCOMMERCIAL']; } ?> " readonly />

				</br></br>
				<label for="txtProduit2">PRODUIT 2 : </label>
				<input type="text" size="30" name="txtProduit2" value=" <?php if(isset($produit2)){ echo $produit2['MED_NOMCOMMERCIAL']; } ?> " readonly />
				
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
							<label for="txtEchantillon<?= $i+1 ?>">PRODUIT <?= $i+1; ?> : </label>
							<input type="text" size="30" name="txtEchantillon<?= $i+1 ?>" value=" <?= $tabNomEchantillons[$i] ?> " readonly />
							<input type="text" name="txtQte<?= $i+1 ?>" size="2" value="<?php echo $tabQteEchantillons[$i]; ?> " readonly />
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
	</form>



