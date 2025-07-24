<?php

namespace App\Models;

use InvalidArgumentException;
use PDO;


class User extends BaseModel
{

    protected string $table = 'users';

    // Propriétés de la classe

    private ?int $u_id = null; // propriété de type Entier (Integer) ou Null
    private string $u_lastname; // propriété de type Chaîne de Caractères (String)
    private string $u_firstname;
    private string $u_pseudo;
    private string $u_picture;
    private string $u_email;
    private string $u_adress;
    private string $u_postal_code;
    private string $u_city;
    private \DateTimeImmutable $u_dob; // appel la fonction DateTimeImmutable uniquement lors d'un appel a la fonction
    // on ne met pas de setter pour la date de naissance qui ne doit pas changer !
    private string $u_phone;
    private string $u_password;
    private \DateTimeImmutable $u_register_date; // idem pour la date d'inscription, elle est unique et ne changera pas
    // on ne met pas de setter pour la date d'inscription qui ne doit pas changer !
    private bool $u_isActive; // propriété de type Booléen (doit être 'true' ou 'false'), ne peut-être NULL
    private int $crd_sum; // propriété de type Entier (Integer)
    private int $crd_quantity;
    private int $crd_bonus;

    // Getters (ils récupèrent les données)
/**
 * Récupère l'identifiant de l'utilisateur
 * @param ?int $u_id est un entier mais peut-être Null (au moment de la création d'un nouvel utilisateur)
 * il sera auto incrémenté à la création de l'utilisateur dans la base de donnée.
 * 
 */
    public function getId(): ?int
    {
        return $this->u_id;
    }
/**
 * Récupère le nom de famille de l'utilisateur
 * @param string $u_lastname sera saisi par l'utilisateur dans le formulaire d'inscription (Required)
 *  */    
    public function getLastName(): string
    {
        return $this->u_lastname;
    }
 /**
 * Récupère le prénom de l'utilisateur
 * @param string $u_firstname sera saisi par l'utilisateur dans le formulaire d'inscription (Required)
 *  */   
    public function getFirstname(): string
    {
        return $this->u_firstname;
    }
/**
 * Récupère le pseudo de l'utilisateur
 * @param string $u_pseudo sera saisi par l'utilisateur dans le formulaire d'inscription (Required)
 *  */    
    public function getPseudo(): string
    {
        return $this->u_pseudo;
    }
/**
 * Récupère l'url de la photo de profil l'utilisateur
 * @param string $u_picture sera ajouter par l'utilisateur dans son espace utilisateur (après inscription)
 *  */    
    public function getPicture(): string
    {
        return $this->u_picture;
    }
/**
 * Récupère l'email de l'utilisateur
 * @param string $u_email sera saisi par l'utilisateur dans le formulaire d'inscription (Required)
 *  */    
    public function getEmail(): string
    {
        return $this->u_email;
    }
/**
 * Récupère l'adresse (rue, avenue, etc..) de l'utilisateur
 * @param string $u_adress sera saisi par l'utilisateur dans le formulaire d'inscription 
 *  */    
    public function getAdress(): string
    {
        return $this->u_adress;
    }
/**
 * Récupère le code postal de l'utilisateur
 * @param string $u_postal_code sera saisi par l'utilisateur dans le formulaire d'inscription 
 *  */    
    public function getPostalCode(): string
    {
        return $this->u_postal_code;
    }
/**
 * Récupère la ville de l'utilisateur
 * @param string $u_city sera saisi par l'utilisateur dans le formulaire d'inscription 
 *  */    
    public function getUserCity(): string
    {
        return $this->u_city;
    }
/**
 * Récupère la date de naissance de l'utilisateur
 * @param \DateTimeImmutable  $u_dob sera saisi par l'utilisateur dans le formulaire d'inscription (Required)
 *  */    
    public function getDob(): \DateTimeImmutable
    {
        return $this->u_dob;
    }
/**
 * Récupère le numéro de téléphone de l'utilisateur
 * @param string $u_phone sera saisi par l'utilisateur dans le formulaire d'inscription 
 *  */    
    public function getPhone(): string
    {
        return $this->u_phone;
    }
/**
 * Récupère la date d'inscription de l'utilisateur
 * @param \DateTimeImmutable  $u_register_date sera enregistrée en base automatiquement 
 * lors de la validation de l'inscription de l'utilisateur cela servira pour calculer l'ancienneté de l'utilisateur, et sa fidelité. 
 *  */    
    public function getRegisterDate(): \DateTimeImmutable
    {
        return $this->u_register_date;
    }
/**
 * Récupère le status de l'utilisateur (actif ou non)
 * @param bool $u_isActive servira à savoir si l'utilisateur est actif ou non (gestion administrateur).
 * Par exemple, si l'utilisateur n'a pas validé son mail de confirmation, ou si le paiement est en attente...
 * L'admin pourra également suspendre le compte : u_isActive = 'false';
 *  */
    public function getIsActive(): bool
    {
        return $this->u_isActive;
    }
/**
 * Récupère le total de Crédit de l'utilisateur
 * @param int $crd_sum pour connaître la valeur des crédits de l'utilisateur
 *  */  
    public function getCreditSum(): int
    {
        return $this->crd_sum;
    }
/**
 * Récupère la quantité de Crédit de l'utilisateur
 * @param int $crd_quantity pour connaître le nombre de crédit disponible
 *  */  
    public function getCreditQte(): int
    {
        return $this->crd_quantity;
    }
/**
 * Récupère le bonus de Crédit de l'utilisateur
 * @param int $crd_bonus pour gérer les bonus (gain de crédit selon le choix des trajets écologiques ou non)
 *  */  
    public function getCreditBonus(): int
    {
        return $this->crd_bonus;
    }



}
