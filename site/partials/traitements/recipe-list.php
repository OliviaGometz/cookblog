<?php

require_once('helpers/bdd-connexion.php');
require_once('helpers/load-class.php');

$recipes = [];
$recipesId = [];

//appel principal

$req = $bdd->prepare('
	SELECT recettes.*, users.pseudo FROM recettes INNER JOIN users ON recettes.auteur = users.id
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
		'auteur' => $obj->pseudo,
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

$difficulte[1] = 'Facile';
$difficulte[2] = 'Normale';
$difficulte[3] = 'Complexe';

$prix[1] = 'Bon marché';
$prix[2] = 'Coût raisonnable';
$prix[3] = 'Pour les grandes occasions';

$type[1] = 'Petit-déjeuner';
$type[2] = 'Encas sucré';
$type[3] = 'Apéritif';
$type[4] = 'Déjeuner ou dîner';

$note[1] = 'Plutôt sympa';
$note[2] = 'Bonne découverte';
$note[3] = 'Excellent';
$note[4] = 'Coup de coeur';