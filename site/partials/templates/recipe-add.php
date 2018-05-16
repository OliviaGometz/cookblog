<form id="recipeAdd" action="partials/traitements/recipe-add.php" method="post">
	<fieldset>
		<label for="nom">
			Nom de la recette
		</label>
		<input type="text" name="nom" id="nom" placeholder="Nom de la recette">
		<p>
			Entre 3 et 50 caractères (espaces compris).
		</p>
	</fieldset>

	<fieldset>
		<label for="description">
			Description
		</label>
		<textarea name="description" id="description" placeholder="Petite description de la recette" minlength="20" maxlength="255"></textarea>
		<p>
			Entre 20 et 255 caractères (espaces compris).
		</p>
	</fieldset>

	<fieldset>
		<label for="duree">
			Durée totale
		</label>
		<input type="number" name="duree1" id="duree" placeholder="0" min="0" max="24">h
		<input type="number" name="duree2" placeholder="0" min="0" max="55" step="5">min
		<p>
			Total des temps de préparation et de cuisson. N'inclus pas le temps de pose que s'il te fait pas exéder 24h au total.
		</p>
	</fieldset>

	<input type="submit" value="Ajouter la recette">
</form>