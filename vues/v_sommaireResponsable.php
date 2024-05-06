    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
			<?php  
				echo $_SESSION['prenom']."  ".$_SESSION['nom'];
			?>    
		</h2>
         <h3>Responsable</h3>    
      </div>  
        <ul id="menuList">
           <li class="smenu">
              <a href="index.php?uc=consulterCompteRenduPeriode&action=selection" title="Consulte le compte rendu d'une periode">Consulter le compte rendu d'une periode</a>
            </li>
            <li class="smenu">
               <a href="index.php?uc=consulterCompteRenduRegion&action=choixResponsable" title="consulte le compte Rendu de la Region">consulter le compte Rendu de la Region</a>
            </li>
            <li class="smenu">
               <a href="index.php?uc=consulterCompteRenduVisiteur&action=choixVisiteur" title="Consulte le compte rendu du visiteur"> Consulte le compte rendu du visiteur</a>  
            </li>
            <li class="smenu">
               <a href="index.php?uc=consulterCompteRenduSecteur&action=choix"title="Consulte le compte rendu du secteur ">Consulte le compte rendu du secteur</a>
            </li>   
            <li class="smenu">
                 <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
              </li>
         </ul>
        
    </div>
    