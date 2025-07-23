# ECORIDE - PLateforme de covoiturage pour les voyageurs soucieux de l'environnement 

## MODE D'EMPLOI DE L'APPLICATION
 -> GUIDE TECHNIQUE


 ## MCD ✅

 ## MLD ✅
 > Format de notation :
 > NOM_TABLE (#clé_primaire, attribut1, attribut2, =>clé_étrangère, attribut3)
 > Légende :
    > # = Clé primaire
    > => = Clé étrangère
    > * = Attribut obligatoire (NOT NULL)

 USERS (#u_id*, u_lastname*, u_firstname*, u_pseudo*, u_picture, u_email*, u_adress, u_postal_code, u_city, u_dob*, u_phone, u_password*, u_register_date*, u_isActive, crd_sum, crd_quantity, crd_bonus),

 ROLES (#role_id*, role_name, role_details),

 CARS (#c_id*, c_brand*, c_model*, c_color*, c_license*, c_energy*, c_date_license*, c_owner_id*),

 TRAVELS (#t_id*, t_city_departure*, t_city_arrival*, t_date_hour_dep*,t_places_available*, t_price_per_person*, t_status, =>driver_id*),

 RESERVATIONS (#reserv_id*, reserv_date, reserv_status, reserv_nb_person*, reserv_nb_person*, reserv_total_price, reserv_options, =>user_id_reserv*, =>travel_id*),


 REVIEWS (#rw_id*, rw_score*, rw_comment*, rw_datetime*, rw_status, =>reservation_id*),

 ROLES_ASSIGNS (#user_id, #role_id, =>user_id, =>role_id),

 
## Insérer des données tests dans ma Base de données Ecoride ✅
## Diagramme de classe (...en cours...)




## Configuration de l'environnement du projet Ecoride
back-end : PHP PDO en MVC
front-end : HTML / CSS / JS
bdd : MySql

### Création du fichier à la racine du projet : .env
### Création du fichier à la racine du projet : .htaccess (config standard = Headers de sécurité, FilesMatch)

### Création du dossier public et du fichier .htaccess/public 

### Configuration du versionnage avec Github
   Créer un repo sur GitHub.com
### GITBASH : 
   git clone "url_repo" (installation du repo en local)
   git init (créer le dossier .git dans le projet en local)
   git config user.name "mon_identifiant_github"
   git config user-email 'mon_mail"
   git add . (ajout des fichiers)
   git commit -m 'commit initial'
   git remote add origin "url_repo" (créer un lien entre depot local et distant nommé Origin)
   git branch -M main (renomme la branche Master en Main)
   git push origin main

### Création du fichier : composer.json
   Dépendances de production :
   - php : version 8.1 ou supérieur
   - nikic/fast-route : pour la gestion des routes URL's
   - vlucas/phpdotenv : gère les variables d'environnement
   Dépendances de développement :
   - phpunit : pour gérer les tests unitaires (framework PHPUnit)
   Autoloader de production : 
   -  PSR-4
   - "src/"
   Autoloader de dev:
   - PSR-4
   - "tests/"


