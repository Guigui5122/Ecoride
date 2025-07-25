<?php

namespace App\Models;

use InvalidArgumentException;


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

    // Getters (récupèrent les données)
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

    // Setters (servent à modifier les propriétés, ex: modification adresse, n° de téléphone, etc...)

    // Setter pour le nom de l'utilisateur

    public function setLastname(string $u_lastname): self
    {
        //On vérifie si le nom de famille est vide (empty), après avoir supprimé les espaces (trim) OU si la longueur (strlen) dépasse 50 caractères 
        if (empty(trim($u_lastname)) || strlen($u_lastname) > 50) {
            throw new InvalidArgumentException("Le nom de famille saisi est invalide.");
        }
        $this->u_lastname = trim($u_lastname);
        return $this;
    }

    // Setter pour le prénom de l'utilisateur
    public function setFirstname(string $u_firstname): self
    {
        //On vérifie si le prénom est vide (empty), après avoir supprimé les espaces (trim) OU si la longueur (strlen) dépasse 50 caractères 
        if (empty(trim($u_firstname)) || strlen($u_firstname) > 50) {
            throw new InvalidArgumentException("Le prénom saisi est invalide.");
        }
        $this->u_firstname = trim($u_firstname);
        return $this;
    }

    // Setter pour le pseudo de l'utilisateur
    public function setPseudo(string $u_pseudo): self
    {
        //On vérifie si le pseudo est vide (empty), après avoir supprimé les espaces (trim) OU si la longueur (strlen) dépasse 20 caractères 
        if (empty(trim($u_pseudo)) || strlen($u_pseudo) > 20) {
            throw new InvalidArgumentException("Le pseudo choisi est invalide.");
        }
        $this->u_pseudo = trim($u_pseudo);
        return $this;
    }

    // Setter pour l'image de profil de l'utilisateur
    /**
     * @param string $u_picture 
     * Ici, la variable contient l'url d'un fichier qui sera chargé par l'utilisateur depuis son espace, (ou lors de l'inscription?)
     * Une vérification de l'URL est faite dans le setter, pour empêcher l'injection d'url malveillante
     * De même, sur l'extension du fichier qui sera chargé
     */
    public function setImageUrl(string $url): void
    {

        //On vérifie si le champ : photo de profil est vide (empty), après avoir supprimé les espaces (trim) OU si la longueur (strlen) dépasse 20 caractères 
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("URL du fichier invalide.");
        }
        // On vérifie ensuite que l'extension du fichier concerne bien une image, ou une photo
        $availableExtensions = ['jpeg', 'webp', 'svg']; // seulement 3 choix car ce sont les formats les plus répandues, moins lourd et de qualités suffisantes, sauf le SVG qui est plus lourd mais utile pour le responsive
        //strtolower - met en minuscule l'extension du fichier : JPG = jpg
        //pathinfo — retourne des informations sur un chemin système (src php manual)
        //parse_url - analyse l'url et extrait le 'path'
        $extension = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
        // On verifie si l'extension est bien autorisée (présent dans $availableExtension)
        if (!in_array($extension, $availableExtensions)) {
            //Si non, on renvoi un message
            throw new InvalidArgumentException('Le format du fichier n\'est pas valide');
        }
        $this->u_picture = $url;
        return;
    }

    // Setter pour l'email de l'utilisateur
    public function setEmail(string $u_email): self
    {
        if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("E-mail invalide.");
        }

        $this->u_email = trim(strtolower($u_email));
        return $this;
    }

    // Setter pour le prénom de l'utilisateur
    public function setAdress(string $u_adress): self
    {
        //On vérifie si le champ : adresse est vide (empty), après avoir supprimé les espaces (trim) OU si la longueur (strlen) dépasse 50 caractères 
        if (empty(trim($u_adress)) || strlen($u_adress) > 50) {
            throw new InvalidArgumentException("L'adresse saisie est invalide.");
        }
        $this->u_adress = trim($u_adress);
        return $this;
    }

    // Setter pour le code postal de l'utilisateur
    public function setPostalCode(string $u_postal_code): self
    {
        //On vérifie si le champ : code postal est vide (empty), après avoir supprimé les espaces (trim) OU si la longueur (strlen) dépasse 10 caractères 
        if (empty(trim($u_postal_code)) || strlen($u_postal_code) > 10) {
            throw new InvalidArgumentException("Le code postal saisi est invalide.");
        }
        $this->u_postal_code = trim($u_postal_code);
        return $this;
    }

    // Setter pour la ville de l'utilisateur
    public function setUserCity(string $u_city): self
    {
        //On vérifie si le champ : Ville est vide (empty), après avoir supprimé les espaces (trim) OU si la longueur (strlen) dépasse 50 caractères 
        if (empty(trim($u_city)) || strlen($u_city) > 50) {
            throw new InvalidArgumentException("La ville saisie est invalide.");
        }
        $this->u_city = trim($u_city);
        return $this;
    }

    // Setter pour le numéro de téléphone de l'utilisateur
    public function setPhoneNumber(string $u_phone): self
    {
        //On vérifie si le champ : Phone est vide (empty), après avoir supprimé les espaces (trim) OU si la longueur (strlen) dépasse 20 caractères 
        if (empty(trim($u_phone)) || strlen($u_phone) > 20) {
            throw new InvalidArgumentException("Le numéro saisi est invalide.");
        }
        $this->u_phone = trim($u_phone);
        return $this;
    }

    // Setter pour le mot de passe de l'utilisateur avec hashage 
    public function setPassword(string $u_password): self
    {
        //On vérifie si le champ : Password est inférieur à 9 caractères 
        if (strlen($u_password) <9 ){
            throw new InvalidArgumentException("Mot de passe saisi est trop court");
        } // si non, on hash le mdp avec l'algorithme Aragon2Id pour le stocker en bdd 
        $this->u_password = password_hash($u_password, PASSWORD_ARGON2ID);
        return $this;
    }

        // Setter pour le le status du compte de l'utilisateur
     public function setU_isActive($u_isActive): self
    {
        $this->u_isActive = $u_isActive;

        return $this;
    }

   
        // Setter pour la somme des crédits de l'utilisateur (solde = valeur = cumul)
    public function setCrdSum($crd_sum): self
    {
        $this->crd_sum = $crd_sum;

        return $this;
    }

        // Setter pour la quantité des crédits de l'utilisateur (nb de crédit = pour fixer le prix d'un trajet par ex.)
    public function setCrdQuantity($crd_quantity): self
    {
        $this->crd_quantity = $crd_quantity;

        return $this;
    }
        // Setter pour les Bonus de crédit de l'utilisateur
    public function setCrdBonus($crd_bonus): self
    {
        $this->crd_bonus = $crd_bonus;

        return $this;
    }





}



