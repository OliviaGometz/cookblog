<form id="recipeAdd" action="partials/traitements/recipe-add.php" method="post">
	<fieldset>
		<label for="nom">
			Nom de la recette
		</label>
		<input type="text" name="nom" id="nom" placeholder="Nom de la recette">
		<p>
			Entre 3 et 50 caractères.
		</p>
	</fieldset>

	<fieldset>
		<label for="description">
			Description
		</label>
		<textarea name="description" id="description" placeholder="Petite description de la recette"></textarea>
		<p>
			Entre 10 et 255 caractères.
		</p>
	</fieldset>

	<input type="submit" value="Ajouter la recette">
</form>