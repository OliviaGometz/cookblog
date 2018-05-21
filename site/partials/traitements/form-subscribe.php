<?php

session_start();

if (isset($_SESSION['id'])) {
	header('Location: index.php');
	return;
}

require_once('../../helpers/bdd-connexion.php');
require_once('../../helpers/load-class.php');

$pseudo = new FormPseudo;
$email = new FormEmail;
$password = new FormPassword;
$code = new FormCode;

$pseudo->validate(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING));
$email->validate(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
$password->validate(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING));
$code->validate(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));

if (isset($pseudo->val) && isset($email->val) && isset($password->val) && isset($code->val)) {
	$req = $bdd->prepare('
		INSERT INTO users (email, password, pseudo, role)
		VALUES (:email, :password, :pseudo, :role)
	');

	$req->execute(
		[
			'email' => $email->val,
			'password' => $password->val,
			'pseudo' => $pseudo->val,
			'role' => $code->val
		]
	);

	$req->closeCursor();

	$reponse = [
		'success' => true,
		'pseudo' => $pseudo->val,
		'email' => $email->val
	];
}
else {
	$reponse = [
		'pseudo' => $pseudo->errors,
		'email' => $email->errors,
		'password' => $password->errors,
		'code' => $code->errors
	];
}

echo json_encode($reponse);