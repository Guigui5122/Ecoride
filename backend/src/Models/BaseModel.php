<?php

namespace App\Models;

use App\Config\Database;
use PDO;


/**
 * classe BaseModels (classe abstraite) qui sert à créer les fonctionnalités communes (fondation)
 * aux autres modèles. Elle ne sera pas instaciable mais sera héritée par d'autres classes.
 */

abstract class BaseModel{

    /**
     * @var PDO l'instance de connection à la base de données
     */
    protected PDO $db;

    /**
     * @var string le nom de la table associée au modèle
     */
    protected string $table;

    public function __construct(?PDO $db = null){
        $this->db->$db ?? Database::getInstance();
    }
};
