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
### GITBASH : 💻
   - git clone "url_repo" (installation du repo en local)
   - git init (créer le dossier .git dans le projet en local)
   - git config user.name "mon_identifiant_github"
   - git config user-email 'mon_mail"
   - git add . (ajout des fichiers)
   - git commit -m 'commit initial'
   - git remote add origin "url_repo" (créer un lien entre depot local et distant nommé Origin)
   - git branch -M main (renomme la branche Master en Main)
   - git push origin main

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

### Installation des dépendances via terminal💻
 cmd : composer install
-> Installe les dépendances, dossier VENDOR (fournisseurs), et le fichier composer.lock

## Création de la class Config (backend/src/Config/Config.php)
servira à charger le fichier .env, à le lire, et séparer et nettoyer les données

## Création de la class Database (backend/src/Config/Database.php)
 gère une connexion unique à la base de données en utilisant le design pattern Singleton qui garantit qu'une seule instance de la classe soit créée pendant toute la durée de vie de l'application.

 ⚠️Lors du passage en "prod" ne plus utiliser 'die' mais plutôt privilégier le 'throw new Exception()' avec un message neutre pour l'utilisateur. 
 ET AJOUTER un:  error_log()


## MVC - Modèles Vues Controleurs


- Création de la classe BaseModels (classe abstraite) qui sert à créer les fonctionnalités communes (fondation) aux autres modèles. Elle ne sera pas instaciable mais sera héritée par d'autres classes.

/* Cette architecture favorise la réutilisabilité et la cohérence en centralisant la gestion de la connexion à la base de données dans une classe parente commune.*/

**** @todo *****

- Puis, implémentation des différentes modeles (user, car, etc...)


## Lecture de la documentation PHPDocs /** */
   - @var est utilisé pour documenter les propriétés des Classes.
   - @param est utilisé pour documenter les paramètres des méthodes || fonctions.
   - @return est utilisé pour documenter les valeurs de retours des méthodes || fonctions.
   - @throws est utilisé pour documenter les Exceptions qui peuvent être levées.
   - @todo pour définir des Notes pour plus tard.
   - @see pour renvoyer des Références d'autres éléments.
