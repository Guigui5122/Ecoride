<?php 
require_once 'UserRepository.php';

use App\Repositories\UserRepository;
use App\Models\User;

$repo = new UserRepository();

$user = new User();
$user->id = 1;
$user->name = 'Alice';

$repo->save($user);
$savedUser = $repo->findById(1);

echo $savedUser ? "OK: {$savedUser->name}" : "Erreur";
