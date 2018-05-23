<?php

require_once('../../helpers/bdd-connexion.php');
require_once('../../helpers/load-class.php');

$reponse = [];

$req = $bdd->prepare('
	SELECT id, nom, quantifiable FROM unites ORDER BY id ASC
');

$req->execute();

while ($unites = $req->fetch(PDO::FETCH_OBJ)) {
	$reponse[$unites->nom] = [
		'id' => $unites->id,
		'quantifiable' => $unites->quantifiable,
	];
}

$req->closeCursor();

echo json_encode($reponse);