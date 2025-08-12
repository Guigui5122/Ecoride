<?php

namespace App\Services\Interfaces;

use App\Models\Travel;
use App\Models\User;

/**
 * Cette interface permet de définir les méthodes que la classe User doit implémenter, sans en donner le contenu. 
 */

interface UserServiceInterface 
{
    // mettre les méthodes logiques métiers 

    public function updateProfil(User $user, array $data): void;                    // mettre le profil a jour (modification de coordonées)    
    public function logIn(string $email, string $password): User;       // connexion au compte
    //public function logOut(): void;                                     // déconnexion du compte (Controller)
    
    //public function uploadPicture(): void;                              // ajouter une image/photo de profil

}