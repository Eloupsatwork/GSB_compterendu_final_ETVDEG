# Procédure d'installation
## Prérequis
- PHP version 7 ou plus
- Un serveur WAMP (UWAMP ou Laragon par exemple)
## Installation de la base de donnée
Connectez-vous à votre serveur WAMP et créez une base de donnée  
Ensuite, exécutez le script suivant dans votre nouvelle base :   
```
gsb_structurecompterenduV2012.sql
```
Une fois votre base de données créée,  
vous devez lier votre application à votre base de donnée.  
Pour cela, vous devez changer les valeurs des constantes du fichier **__config/constants.php__** aux lignes suivantes: 
```
7. define("URL","{url_de_votre_site}");  
20. define("DB_HOST",'mysql:host={votre_serveur}');
23. define("DB_NAME",'dbname={nom_BD}');
26. define("DB_LOGIN",'{votre_login}');
29. define("DB_MDP",'{votre_mot_de_passe}'); 
```
## Installation de l'application
Pour installer votre application,  
vous devez déposer le dossier de l'application dans votre dossier **__WWW__** de votre serveur WAMP  
Ensuite, vous pourrez lancer votre application
## Lancer l'application
Pour lancer l'application, vous devez lancer votre serveur WAMP puis aller dans votre **__Navigateur WWW__**.  
Une fois sur votre navigateur, vous devrez cliquer sur votre application et cela la lancera. 
