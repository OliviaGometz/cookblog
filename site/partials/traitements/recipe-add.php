<?php

session_start();
require_once('../../helpers/bdd-connexion.php');
require_once('../../helpers/load-class.php');

$nom = new RecipeNom;
$desc = new RecipeDesc;
$duree = new RecipeDuree;
$difficulte = new Select;
$prix = new Select;
$type = new Select;
$ajout = date('y-m-d H:i:s');
$auteur = (int)$_SESSION['id'];
$note = new Select;
$image = new Image;
$etapes = new RecipeEtapes;

$nom->validate(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING));
$desc->validate(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
$duree->validate(filter_input(INPUT_POST, 'dureeHour', FILTER_SANITIZE_STRING), filter_input(INPUT_POST, 'dureeMin', FILTER_SANITIZE_STRING));
$difficulte->validate(filter_input(INPUT_POST, 'difficulte', FILTER_SANITIZE_STRING), [1, 2, 3], 'une difficulté');
$prix->validate(filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_STRING), [1, 2, 3], 'une estimation du prix');
$type->validate(filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING), [1, 2, 3, 4], 'un type de repas');
$note->validate(filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING), [1, 2, 3, 4], 'une appréciation');
$image->validate($_FILES['image'], $ajout, $auteur);

$steps = [];
for ($i=1; $i<=30; $i++) {
	$steps[$i] = filter_input(INPUT_POST, 'etape'.$i, FILTER_SANITIZE_STRING);
}
$etapes->validate($steps);

if (isset($nom->val) && isset($desc->val) && isset($duree->val) && isset($difficulte->val) && isset($prix->val) && isset($type->val) && isset($ajout) && isset($auteur) && isset($note->val) && isset($image->val) && isset($etapes->val)) {

	$imgUpload = move_uploaded_file($_FILES['image']['tmp_name'], $image->val);

	if (!$imgUpload) {
		$reponse = [
			'imgUpload' => 'Une erreur s\'est produite lors de l\'enregistrement de l\'image sur notre serveur. Veuillez contacter Olivia pour résoudre le problème.'
		];
	}
	else {
		$req = $bdd->prepare('
			INSERT INTO recettes (nom, description, duree, difficulte, prix, type, ajout, auteur, note)
			VALUES (:nom, :description, :duree, :difficulte, :prix, :type, :ajout, :auteur, :note)
		');

		$req->execute(
			[
				'nom' => $nom->val,
				'description' => $desc->val,
				'duree' => $duree->val,
				'difficulte' => $difficulte->val,
				'prix' => $prix->val,
				'type' => $type->val,
				'ajout' => $ajout,
				'auteur' => $auteur,
				'note' => $note->val
			]
		);

		$req->closeCursor();

		$reqId = $bdd->prepare('
			SELECT id FROM recettes WHERE ajout = :ajout AND auteur = :auteur
		');

		$reqId->execute([
			'ajout' => $ajout,
			'auteur' => $auteur
		]);

		$recipe = $reqId->fetch(PDO::FETCH_OBJ);
		$reqId->closeCursor();

		

		if (!isset($recipe->id)) {
			$reponse = [
				'recipeUpload' => 'Une erreur s\'est produite lors de l\'enregistrement de la recette sur notre serveur. Veuillez contacter Olivia pour résoudre le problème.'
			];
		}
		else {
			$reqEtapes = $bdd->prepare('
				INSERT INTO etapes (recette, numero, instruction)
				VALUES '.$etapes->val
			);

			$reqEtapes->execute([
				'recette' => $recipe->id
			]);

			$reqEtapes->closeCursor();

			$reponse = [
				'ok' => 'tout est ok !'
			];
		}
	}
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
		'image' => $image->errors
	];
}

echo json_encode($reponse);