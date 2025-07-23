<?php
namespace App\Config; // met la classe dans App\Config
use Dotenv\Dotenv; // import de la classe Dotenv de la libairie vlucas


class Config{ // déclaration de la classe (pour gérer la configuration)
    
/**
* Documentation: PHPDoc = documentation de la méthode, décrit le rôle et les paramètres
* Sert à charger le fichier ".env"
* @param string $path :  le chemin vers le dossier contenant le fichier '.env'
*/
//public statique : rend la méthode accessible sans instancier la classe
//$path: paramètre avec la valeur par défaut
//__DIR__: constante = dossier du fichier actuel
//void: ne retourne rien
    public static function load($path = __DIR__ . '/../../'):void{

        // vérifie si le fichier .env existe avant de tenter de le charger
        // évite les erreurs si le fichier est absent
        if(file_exists($path . '.env')){
            $dotenv = Dotenv::createImmutable($path);
            $dotenv -> load();
        }
    }
/**
 * méthode get
 * @param string $key le nom de la variable
 * @param mixed $default une valeur par défaut à retourner si la variable n'existe pas
 * @return mixed la valeur de la variable ou la valeur par défaut
 */

    public static function get(string $key, $default = null){
        return $_ENV[$key] ?? $default;
    }
}
