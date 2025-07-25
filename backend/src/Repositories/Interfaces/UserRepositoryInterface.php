<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use DateTime;
/**
 * Cette interface permet de définir les méthodes que la classe User doit implémenter, sans en donner le contenu. 
 */
interface UserRepositoryInterface 
{
    // Méthode
    public function save(User $user): ?User;                            // inscription (enregistrement en bdd)
    public function delete(int $u_id): bool;                            // suppression du compte (admin)
    public function getRegisterDate(int $u_id): ?DateTime;              // contient la date d'inscription de l'utilisateur
    
}


