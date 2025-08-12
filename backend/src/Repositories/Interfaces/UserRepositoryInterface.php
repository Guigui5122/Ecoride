<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
// use DateTime;
/**
 * Cette interface permet de définir les méthodes que la classe User doit implémenter, sans en donner le contenu. 
 */
interface UserRepositoryInterface 
{
    // Méthode
    public function findByEmail(string $u_email): ?User;
    public function save(User $user): bool;                             // inscription (enregistrement en bdd)
    public function suspendAccount(User $user): bool;                   // suspension du compte (accessible pour l'admin)
    public function getRegisterDate(int $u_id): ?string;              // on obtient la date d'inscription de l'utilisateur
    
}


