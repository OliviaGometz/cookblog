<?php

require_once('../../helpers/bdd-connexion.php');
require_once('../../helpers/load-class.php');

$nom = new RecipeNom;
$desc = new RecipeDesc;
$duree = new RecipeDuree;
$difficulte = new Select;
$prix = new Select;
$type = new Select;

$note = new Select;

$nom->validate(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING));
$desc->validate(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
$duree->validate(filter_input(INPUT_POST, 'dureeHour', FILTER_SANITIZE_STRING), filter_input(INPUT_POST, 'dureeMin', FILTER_SANITIZE_STRING));
$difficulte->validate(filter_input(INPUT_POST, 'difficulte', FILTER_SANITIZE_STRING), [1, 2, 3], 'une difficulté');
$prix->validate(filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_STRING), [1, 2, 3], 'une estimation du prix');
$type->validate(filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING), [1, 2, 3, 4], 'un type de repas');

$note->validate(filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING), [1, 2, 3, 4], 'une appréciation');

if (isset($nom->val) && isset($desc->val)) { //compléter
	$req = $bdd->prepare('
		INSERT INTO recettes (nom, description)
		VALUES (:nom, :description)
	');

	$req->execute(
		[
			'nom' => $nom->val,
			'description' => $desc->val,
			'duree' => $duree->val,
			'difficulte' => $difficulte->val,
			'prix' => $prix->val,
			'type' => $type->val,
			'note' => $note->val,
		]
	);

	$reponse = [
		'ok' => 'tout est ok !'
	];
}
else {
	$reponse = [
		'nom' => $nom->errors,
		'description' => $desc->errors,
		'duree' => $duree->errors,
		'difficulte' => $difficulte->errors,
		'prix' => $prix->errors,
		'type' => $type->errors,
		'note' => $note->errors,
	];
}

echo json_encode($reponse);