<?php

// Définit l’espace de noms (`namespace`) : utile pour organiser le code et éviter les conflits de noms.

namespace App\Config;

// Import des classes PDO et PDOException pour gérer la base de données MySQL

use PDO;
use PDOException;

/**
 * Classe Database qui gère la connexion à la base de données
 * On utilise le patron de conception (Design Pattern) : Singleton; 
 * Cela garantit qu'une seule instance de la classe soit créée.
 */

class Database {

    // propriété statique privée pour stocker l'instance unique de PDO
    // ?PDO = soit un objet PDO, soit NULL

    private static ?PDO $instance = null;

    // constructeur privé pour empêcher la création d'objet via 'new Database'
    private function __construct(){}

    // méthode de clonage privée pour empêcher de cloner l'instance
    private function __clone(){}

    /**
     * 
     * La méthode getInstance() est le cœur du design pattern Singleton.
     * Elle a un rôle fondamental : fournir un point d'accès unique à l'instance
     * de la connexion à la base de données (ici un objet PDO).
     * 
     */

    public static function getInstance(): PDO {

        // on vérifie si l'instance n'est pas déjà créée
        if(self::$instance === null){

            // On construit le Data Source Name (DSN) avec les infos du fichier .env
            /**
             * 
             * sprintf() signifie "string print formatted".
             * Elle retourne une chaîne de caractères construite à partir d’un modèle
             * contenant des placeholders (espaces réservés comme %s, %d, etc.)
             * que tu remplaces ensuite par des valeurs réelles.
             * 
             *  */ 
            $dsn = sprintf(
                "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4", // ATTENTION de ne pas mettre d'espaces entre les paramètres!!
                Config::get('DB_HOST'), // remplace le 1er %s dans la chaîne ci-dessus 'mysql:[...]'
                Config::get('DB_PORT', '3306'),  // remplace le 2nd %s dans la chaîne ci-dessus 'mysql:[...]'
                Config::get('DB_NAME') // remplace le 3ème %s dans la chaîne ci-dessus 'mysql:[...]'
            );

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lance des exceptions en cas d'erreur SQL
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // récupère des résultats sous forme de tableau associatif
            ];

            try{

                // On créer l'instance de PDO et on la stock
                self::$instance = new PDO($dsn, Config::get('DB_USER'), Config::get('DB_PASSWORD'), $options);

                // Gestion des erreurs, elles sont attrapées avec le 'catch'
                // et un message d'erreur est renvoyé
            }catch(PDOException $error){
                die("Erreur de connexion à la base de données : " . $error->getMessage());
            }
        }
        return self::$instance;
    }
}
