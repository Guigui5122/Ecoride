<?php

namespace App\Services\Interfaces;

use App\Models\Travel;

/**
 * Cette interface permet de définir les méthodes que la classe User doit implémenter, sans en donner le contenu. 
 */

interface UserServiceInterface 
{
    // mettre les méthodes logiques métiers 

    public function updateProfil(array $data): void;                    // mettre le profil a jour (modification de coordonées)    
    public function logIn(string $email, string $password): void;       // connexion au compte
    public function logOut(): void;                                     // déconnexion du compte
    public function searchTravel(int $travelId): ?Travel;                   // rechercher un trajet de covoiturage
    public function uploadPicture(): void;                              // ajouter une image/photo de profil
    public function postReview(int $userId, int $travelId, string $reviewComment, int $reviewScore): void;             // poster un avis sur un trajet     

}