<?php

namespace App\Controllers;


/**
 * Controleur de base
 * Toutes les autres classes de Controlleur hériteront de celle-ci
 *  
 */

abstract class BaseController
{

    protected Response $response;
    protected Validator $validator;

    public function __construct(){
        $this->response = new Response();
        $this->validator = new Validator();


    }
    /** Afficher la vue en l'injectant dans la mise en page principale (layout)
     * 
     * @param string $view le nom du fichier de vue
     * @param array $date les données à rendre accessible dans la vue
     * 
     */
    protected function render(string $view, array $data=[]):void
    {
        // Construction complet du chemin vers le fichier de vue :
        $viewPath = dirname(__DIR__,1) . '/Views/' . $view . '.php';

        // Vérification que le fichier de vue existe bien :
        if(!file_exists($viewPath)){
            $this->response->error("La vue n'existe pas à ce chemin : $viewPath", 500);
            return;
        }
        // 'Extract()' transforme les clés d'un tableau en variable (Exemple : $data = ['title'=> 'Accueil'] devient $title = 'Accueil')
        extract($data);
        
        // 'Ob_Start()' : On utilise la mise en tampon de sortie (Output Buffering) pour capturer le HTML de la vue
        ob_start();
        include $viewPath;

        // Ici, On vide le cache, la variable $content contient la vue
        /* $content : capture le HTML de la vue spécifique ($view) et le transmet au fichier layout.php, qui se charge de l'afficher dans sa structure globale.
         Le code de la fonction render() ne l'utilise pas directement, car il passe le relais au layout pour l'affichage final.
         */

        $content = ob_get_clean();

        // Finalement, on inclut le layout principal, qui peut maintenant utiliser la variable $content.
        include dirname(__DIR__, 2).'/views/layout.php';
    }
    /**
     * Récupère et nettoie les données envoyées via une requête POST
     */
    protected function getPostData(): array{

        return $this->validator->sanitize($_POST);
    }

    /**
     * Vérifie si l'utilisateur est connecté, si non on le redirige vers la page LogIn
     */
    protected function requireAuth(): void{

        if(!isset($_SESSION['u_id'])){
            $this->response->redirect('/login');
        }
    }

}

