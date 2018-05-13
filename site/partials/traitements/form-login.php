<?php

require_once('../../helpers/bdd-connexion.php');
require_once('../../helpers/load-class.php');

$login = new FormLogin;
$login->connexion(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING), filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

if ($login->userId && $login->userRole && $login->userPseudo) {
	session_start();
	$_SESSION['id'] = $login->userId;
	$_SESSION['role'] = $login->userRole;
	$_SESSION['pseudo'] = $login->userPseudo;
	$_SESSION['message'] = 'logged';

	$reponse = [
		'success' => true
	];
}
else {
	$reponse = $login->errors;
}

echo json_encode($reponse);