<?php

require_once('../../helpers/bdd-connexion.php');
require_once('../../helpers/load-class.php');

$nom = new RecipeNom;
$desc = new RecipeDesc;

$nom->validate(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING));
$desc->validate(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));

if (isset($nom->val) && isset($desc->val)) {
	$req = $bdd->prepare('
		INSERT INTO recettes (nom, description)
		VALUES (:nom, :description)
	');

	$req->execute(
		[
			'nom' => $nom->val,
			'description' => $desc->val
		]
	);

	$reponse = [
		'ok' => 'tout est ok !'
	];
}
else {
	$reponse = [
		'nom' => $nom->errors,
		'description' => $desc->errors
	];
}

echo json_encode($reponse);