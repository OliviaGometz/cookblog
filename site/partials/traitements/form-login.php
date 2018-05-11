<?php

require_once('../../helpers/bdd-connexion.php');
require_once('../../helpers/load-class.php');

$isAjax = new IsAjax;
$login = new FormLogin;

$login->connexion(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING), filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

if ($login->userId && $login->userRole && $login->userPseudo) {
	session_start();
	$_SESSION['id'] = $login->userId;
	$_SESSION['role'] = $login->userRole;
	$_SESSION['pseudo'] = $login->userPseudo;
	$_SESSION['flash'] = 'justConnected';

	if ($isAjax->val()) {
		echo json_encode(['reload' => true]);
	}
	else {
		header('Location: ../../index.php');
	}
}
else {
	if ($isAjax->val()) {
		echo json_encode($login->errors);
	}
	else {
		$_SESSION['errors'] = $login->errors;
		header('Location: ../../connexion.php');
	}
}