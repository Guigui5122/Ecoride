<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use DateTime; // pour gérer l'implémentation de la date d'inscription

interface UserRepositoryInterface 
{
    public function save(User $user): ?User;                            // inscription (enregistrement en bdd)
    public function logIn(): void;                                      // connexion au compte
    public function logOut(): void;                                     // déconnexion du compte
    public function delete(int $u_id): int;                            // suppression du compte (admin)
    public function searchTravel(int $t_id): int;                       // rechercher un trajet de covoiturage
    public function updateProfil(): void;                               // mettre le profil a jour (modification de coordonées)    
    public function uploadPicture(): void;                              // ajouter une image/photo de profil
    public function postReview(string $rw_comment): string;             // poster un avis sur un trajet     
    public function registerDate(DateTime $u_register_date): array;     // contient la date d'inscription de l'utilisateur

}
