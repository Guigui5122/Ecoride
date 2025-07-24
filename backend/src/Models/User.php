<?php

namespace App\Models;

use InvalidArgumentException;
use PDO;


class User extends BaseModel{

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
    private bool $u_isActive; // propriété de type Booléen (doit être 'true' ou 'false'), ne peut-être NULL
    private int $crd_sum; // propriété de type Entier (Integer)
    private int $crd_quantity;
    private int $crd_bonus;

    










}