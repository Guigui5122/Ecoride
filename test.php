<?php 

require_once __DIR__ . 'vendor/autoload.php';

use App\Repositories\UserRepository;
use App\Models\User;

// Création connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=ecoride_database;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Création repository
$repo = new UserRepository($pdo);

// Création utilisateur test
$user = new User();
$user->setLastname("Dupont");
$user->setFirstname("Jean");
$user->setPseudo("jdupont");
$user->setEmail("jean.dupont@example.com");
$user->setAdress("12 rue de Paris");
$user->setPostalCode("75000");
$user->setUserCity("Paris");
$user->setPhoneNumber("0601020304");
$user->setPassword("monMotDePasse123");

// Sauvegarde
if ($repo->save($user)) {
    echo "Utilisateur enregistré avec ID : " . $user->getId();
} else {
    echo "Erreur d'enregistrement";
}
