<?php

namespace App\Controllers;

/**
 * Controleur de base
 * Toutes les autres classes de Controlleur hériteront de celle-ci
 *  
 */

abstract class BaseController
{
    protected array $data = [];
    private array $errors = [];

    /** Afficher la vue en l'injectant dans la mise en page principale (layout)
     * 
     * @param string $view le nom du fichier de vue
     * @param array $date les données à rendre accessible dans la vue
     * 
     */

    protected function render(string $view, array $data=[]):void
    {
        // 'Extract()' transforme les clés d'un tableau en variable (Exemple : $data = ['title'=> 'Accueil'] devient $title = 'Accueil')
        // l'option EXTR_SKIP : Lors d'une collision, ne pas réécrire la variable existante (source PHP Manual).
        extract($data, EXTR_SKIP);
        // Construction complet du chemin vers le fichier de vue :
        $viewPath = dirname(__DIR__,1) . '/Views/' . $view . '.php';
    }

    /**
     * Redirection vers une autre URL
     * @param string $url
     */
    protected function redirect(string $url): void
    {
        header("Emplacement/Location: {$url}");
        exit;
    }

    /**
     * Validation des données
     * @param array $data variable qui récupère les données
     * @param array $rules gère les règles appliquées pour la validation des données
     * @return array 
     */

    public function validate(array $data, array $rules): array
    {
        $errors = [];

        foreach($rules as $field => $rule){
            $value = $data[$field] ?? null;
            $rulesArray = explode('|', $rule);

            foreach($rule as $rules){
                $this->applyRule($field, $value, $rules);
            }
        }
        return $errors;
    }

    /**
     * Application des règles de validation des données (en lien avec la fonction validate() ci-dessus))
     * @param string $field pour le champ sur lequel s'applique la règle
     * @param $value pour la valeur du champ
     * @param string $rule pour définir la règle
     *  
     */

    private function applyRule(string $field, $value, string $rule): void
    {
        $param = null; // initialisation à 'null' par défaut
        if (strpos($rule, ':') !== false)
        {
            [$rule, $param] = explode(':', $rule, 2);
        }

        switch($rule) 
        {
            // pour gérer la règle 'champ requis'
            case 'required':
                if(empty($value))
                {
                    $this->addError($field, "Le champ {$field} est requis !");
                }
                break;
            // pour gérer le champ Email 
            case 'email':
                if( !filter_var($value, FILTER_VALIDATE_EMAIL))
                {
                    $this->addError($field, "Le champ {$field} doit contenir un e-mail !");
                }
                break;
            // pour gérer la règle 'un minimum de caractère est requis'
            case 'min':
                if(strlen($value) < (int) $param)
                {
                    $this->addError($field, "Le champ {$field} doit contenir un minimum de {$param} caractères !");
                }
                break;
            // pour gérer la règle 'un maximum de caractère est autorisés'
            case 'max':
                if(strlen($value) > (int) $param)
                {
                    $this->addError($field, "Le champ {$field} ne doit pas dépasser {$param} caractères !");
                }
                break;
            // pour gérer la règle de 'vérification d'un champ identique'
            case 'same':
                if($value !== ($this->data[$param] ?? null))
                {
                    $this->addError($field, "Le champ {$field} doit être identique au champ {$param} !");
                }
                break;
        }
    }

    /**
     * Fonction qui gère les messages d'erreurs si les champs ne respectent pas les règles définies
     * dans la fonction 'applyRule()'
     * @param string $field le champ concerné par l'ereur
     * @param string $message renvoi le message approprié selon les règles
     * 
     */

    private function addError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    /**
     * Fonction qui nettoie les données et évite les failles xss
     * @param array $data tableau de données à nettoyer
     */

    public function sanitize(array $data): array
    {
        $sanitized = [];
        foreach($data as $key => $value){

            $sanitized[$key] = is_string($value) ? htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8'): $value;
        }
        return $sanitized;
    }


}



