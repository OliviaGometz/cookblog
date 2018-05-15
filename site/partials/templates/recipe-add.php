<form id="recipe-add" action="partials/traitements/recipe-add.php" method="post">
	<fieldset>
		<label for="nom">
			Nom de la recette
		</label>
		<input type="text" name="nom" id="pseudo" placeholder="Nom de la recette">
		<p>
			Entre 3 et 15 lettres, sans chiffres ni caractères spéciaux, débutant par une majuscule.
		</p>
	</fieldset>

	<input type="submit" value="Ajouter la recette">
</form>