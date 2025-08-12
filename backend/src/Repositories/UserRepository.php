<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use PDO;
use PDOException;



class UserRepository implements UserRepositoryInterface{
    
    private PDO $pdo;
    private string $table = 'users'; 


    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    /**
     * Trouve un utilisateur par son email
     * @return static|null l'objet user trouvé ou null
    */
    public function findByEmail(string $u_email): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE u_email= :u_email");
        $stmt->execute([':u_email' => $u_email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data; 
    }
    


    /**
     * La fonction permet d'insérer un utilisateur ou de le mettre à jour
     * @param $user
     * @return bool
     * 
     */
    public function save(User $user): bool
    {
        try{
        // logique pour insert ||update
        // vérifier si l'utilisateur existe deja ou pas 
        if($user->getId() === null){

            // insérer un utilisateur en bdd 

            $sql = "INSERT INTO {$this->table} (u_lastname, u_firstname, u_pseudo, u_email, u_adress, u_postal_code, u_city, u_dob, u_phone, u_password)
            VALUES 
            (:u_lastname,:u_firstname, :u_pseudo, :u_email, :u_adress, :u_postal_code, :u_city, :u_dob, :u_phone, :u_password)";

        } else {
            
            // mise a jour de l'utilisateur
            $sql = "UPDATE {$this->table} SET
                u_lastname = :u_lastname,
                u_firstname = :u_firstname,
                u_pseudo = :u_pseudo,
                u_email = :u_email,
                u_adress = :u_adress,
                u_postal_code = :u_postal_code,
                u_city = :u_city,
                u_dob = :u_dob,
                u_phone = :u_phone,
                u_password = :u_password
                WHERE u_id = :u_id"; 
        }

            // Requête préparée permet de cacher les informations  + protection contre les attaques SQL
        $stmt = $this->pdo->prepare($sql); 
        
        // Remplace les params

        $params = [
                ':u_lastname' => $user->getLastname(),
                ':u_firstname' => $user->getFirstname(),
                ':u_pseudo' => $user->getPseudo(),
                ':u_email' => $user->getEmail(),
                ':u_adress' => $user->getAdress(),
                ':u_postal_code' => $user->getPostalCode(),
                ':u_city' => $user->getUserCity(),
                ':u_dob' => $user->getDob(),
                ':u_phone' => $user->getPhone(),
                ':u_password' => password_hash($user->getPassword(), PASSWORD_ARGON2ID)
            ];

            // L'utilisateur est déjà présent dans la base
            if($user->getId() !== null){
                $params[':u_id'] = $user->getId();
            }

            // Exécution de la requête
            $result = $stmt->execute($params);

            if ($result && $user->getId() === null){
                // Transmet l'id auto incrementé à PDO
                $user->setId((int)$this->pdo->lastInsertId());
            }

        return $result;

        }catch(PDOException $error){
        echo "La sauvegarde à échouée" . $error->getMessage();

        return false;
        }
    }


/**
 * La fonction permet à l'administrateur de suspendre un compte Utilisateur
 * @param $user 
 * @return bool
 */


    public function suspendAccount(User $user): bool 
    {
        try{

            if($user->getIsActive() === false){
                echo "Le compte utilisateur est déjà inactif";
                return false;
                
            } 
            
            $sql = "UPDATE {$this->table} SET u_isActive = 0 WHERE u_id = :u_id";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute([':u_id' => $user->getId()]);

            if($result){
                $user->setU_isActive(false);
                echo "Le compte a bien été suspendu.";
                return true;
            } else {
                echo "La suspension à échouée.";
                return false;
            }
            
        }catch(PDOException $error){
            echo "Le compte n'a pas été suspendu, veuillez réésssayer." . $error->getMessage();
            return false;
        } 
    }


/**
 * Fonction pour récupérer la date d'inscription de l'utilisateur 
 * @param int $u_id
 * @return ?string 
 * le champ 'u_register_date' est géré par la bdd en type CURRENT_TIMESTAMP définit automatiquement
 * à l'enregistrement de l'utilisateur
 */

    public function getRegisterDate(int $u_id): ?string
    {
        $sql = "SELECT u_register_date FROM {$this->table} WHERE u_id = :u_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $u_id]);

        $date = $stmt->fetchColumn();
        
        return $date ?: null;
    }
}








