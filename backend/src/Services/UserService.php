<?php 

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService implements UserServiceInterface{

    public function __construct(private UserRepositoryInterface $userRepository) {}

    /**
     * Fonction qui permet à l'utilisateur de modifier ses coordonnées sur son espace (adresse,cp,ville,tel,photo,mdp))
     * @param array $data renvoi un tableau de données
     * 
     */

    public function updateProfil(User $user, array $data): void // mettre le profil a jour (modification de coordonées)  
    {

        if(isset($data['u_adress'])){
            $user->setAdress($data['u_adress']);
        }
        if(isset($data['u_postal_code'])){
            $user->setPostalCode($data['u_postal_code']);
        }
        if(isset($data['u_city'])){
            $user->setUserCity($data['u_city']);
        }
        if(isset($data['u_phone'])){
            $user->setPhoneNumber($data['u_phone']);
        }
        if(isset($data['u_picture'])){
            $user->setImageUrl($data['u_picture']);
        }
        if(isset($data['u_password'])){
            $user->setPassword($data['u_password']);
        }

    }         
    
/**
 * Vérifie que l'utilisateur existe en recherchant par son mail et son mot de passe
 * @param string $u_email
 * @param string $u_password
 * @return $user quand la connexion à réussie
 */

    public function logIn(string $u_email, string $u_password): User
    {
        $user = $this->userRepository->findByEmail($u_email);

        if(!$user){
            throw new \Exception("Utilisateur non trouvé");
        }
        if(!password_verify($u_password, $user->getPassword())){
            throw new \Exception("Mot de passe incorrect");
        }
        return $user;
    }
    

}