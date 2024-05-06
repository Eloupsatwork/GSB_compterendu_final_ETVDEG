    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
			<?php  
				echo $_SESSION['prenom']."  ".$_SESSION['nom'];
			?>    
		</h2>
         <h3>Visiteur</h3>    
      </div>  
        <ul id="menuList">
           <li class="smenu">
              <a href="index.php?uc=ajouterCompteRendu&action=f_ajouter" title="Saisie compte-rendu">Ajout compte-rendu</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=majCompteRendu&action=selection" title="Modification compte-rendu">Modification compte-rendu</a>
           </li>		   
           <li class="smenu">
              <a href="index.php?uc=consulterPraticien&action=liste" title="Consultation des praticiens">Consultation Praticiens</a>
           </li>
           <li class="smenu">
              <a href="index.php?uc=ajouterPraticien&action=f_ajouter" title="Saisie praticien">Ajout praticien</a>
           </li>		   
           <li class="smenu">
              <a href="index.php?uc=consulterMedicament&action=liste" title="Consultation des médicaments">Consultation Médicaments</a>
           </li>	
           <li class="smenu">
              <a href="index.php?uc=consulterCompteRenduPeriode&action=selection" title="Consultation des compte-rendus">Compte-rendus d'une période</a>
           </li>	
			<li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
		
		
        </ul>
        
    </div>
    