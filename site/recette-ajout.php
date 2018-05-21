<?php
	$title = 'Ajouter une recette';
	require_once('partials/structure/head.php');
	require_once('helpers/is-not-logged.php');
?>

<div id="ajout">
	<?php include_once('partials/templates/recipe-add.php'); ?>
</div>

<?php require_once('partials/structure/end.php'); ?>