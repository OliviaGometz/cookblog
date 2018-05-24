<?php

require_once('helpers/bdd-connexion.php');
require_once('helpers/load-class.php');

$recipes = [];
$recipesId = [];

//appel principal

$req = $bdd->prepare('
	SELECT * FROM recettes
');

$req->execute();

while ($obj = $req->fetch(PDO::FETCH_OBJ)) {
	$recipes[$obj->id] = [
		'nom' => $obj->nom,
		'description' => $obj->description,
		'duree' => $obj->duree,
		'difficulte' => (int)$obj->difficulte,
		'prix' => (int)$obj->prix,
		'type' => (int)$obj->type,
		'ajout' => $obj->ajout,
		'auteur' => (int)$obj->auteur,
		'note' => (int)$obj->note
	];

	$recipesId[] = (int)$obj->id;
}

$req->closeCursor();

//appel étapes

foreach ($recipesId as $value) {
	$reqSteps = $bdd->prepare('
		SELECT numero, instruction FROM etapes WHERE recette = :recette
	');

	$reqSteps->execute(
		[
			'recette' => $value
		]
	);

	while ($obj = $reqSteps->fetch(PDO::FETCH_OBJ)) {
		$recipes[$value]['etapes'][$obj->numero] = $obj->instruction;
	}

	$reqSteps->closeCursor();
}

//appel ingrédients

foreach ($recipesId as $value) {
	$reqIng = $bdd->prepare('
		SELECT unites.nomBase, unites.nomPlus, unites.charniere, recettesingredients.quantite, ingredients.nom FROM recettesingredients INNER JOIN ingredients ON recettesingredients.ingredient = ingredients.id INNER JOIN unites ON recettesingredients.unite = unites.id WHERE recettesingredients.recette = :recette
	');

	$reqIng->execute(
		[
			'recette' => $value
		]
	);

	while ($obj = $reqIng->fetch(PDO::FETCH_OBJ)) {
		$recipes[$value]['ingredients'][] = [
			'nom' => $obj->nom,
			'quantite' => (int)$obj->quantite,
			'nomBase' => $obj->nomBase,
			'nomPlus' => $obj->nomPlus,
			'charniere' => (int)$obj->charniere
		];
	}

	$reqIng->closeCursor();
}