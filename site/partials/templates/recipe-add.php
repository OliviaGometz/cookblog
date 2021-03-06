<form id="recipeAdd" action="partials/traitements/recipe-add.php" method="post" enctype="multipart/form-data">
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
		<div>
			<textarea name="description" id="description" placeholder="Petite description de la recette" minlength="20" maxlength="255" class="js-textarea"></textarea>
		</div>
		<p>
			Entre 20 et 255 caractères (espaces compris).
		</p>
	</fieldset>

	<fieldset>
		<label>
			Ingrédients
		</label>
		<select name="person">
			<option value="1">Pour 1 personne</option>
			<option value="2">Pour 2 personnes</option>
			<option value="4">Pour 4 personnes</option>
			<option value="6">Pour 6 personnes</option>
		</select>
		<div class="ingredients">
			<ul>
				<li>
					<input type="text">
					<select></select>
					<div class="actions">
						<span class="close">x</span>
					</div>
				</li>
			</ul>
			<span class="btn">Ajouter un ingrédient</span>
		</div>
		<p>
			Ingrédients&nbsp;: entre 2 et 30 caractères, au pluriel, 2 ingrédients minimum, 30 ingrédients maximum.
		</p>
	</fieldset>
<!--
	<fieldset>
		<label>
			Ustensiles
		</label>
		<input type="text" name="ustensile" placeholder="Ustensile 1">
		<p>
			N'indiquez que les ustensiles qu'on ne trouve pas dans toutes les cuisines (mixeur, plancha...)&nbsp;: il est inutile de lister les ustensiles courants (cuillère à soupe, casserole, saladier...).
		</p>
	</fieldset>
-->
	<fieldset>
		<label>
			Étapes
		</label>
		<div class="etapes">
			<ol>
				<li>
					<textarea  class="js-textarea" minlength="20" maxlength="800"></textarea>
					<div class="actions">
						<span class="up">up</span>
						<span class="down">down</span>
						<span class="close">x</span>
					</div>
				</li>
			</ol>
			<span class="btn">Ajouter une étape</span>
		</div>
		<p>
			Entre 20 et 800 caractères (espaces compris) par étape&nbsp;: 3 étapes minimum, 30 étapes maximum.
		</p>
	</fieldset>

	<fieldset>
		<label for="duree">
			Durée totale
		</label>
		<input type="number" name="dureeHour" id="duree" placeholder="0" min="0" max="24">h
		<input type="number" name="dureeMin" placeholder="0" min="0" max="55" step="5">min
		<p>
			Total des temps de préparation et de cuisson (inutile d'inclure les éventuels temps de pose).
		</p>
	</fieldset>

	<fieldset>
		<label for="difficulte">
			Difficulté
		</label>
		<select name="difficulte" id="difficulte">
			<option value="" disabled selected >Choisis...</option>
			<option value="1">Facile</option>
			<option value="2">Normale</option>
			<option value="3">Complexe</option>
		</select>
	</fieldset>

	<fieldset>
		<label for="prix">
			Estimation du prix
		</label>
		<select name="prix" id="prix">
			<option value="" disabled selected >Choisis...</option>
			<option value="1">Bon marché</option>
			<option value="2">Coût raisonnable</option>
			<option value="3">Pour les grandes occasions</option>
		</select>
	</fieldset>

	<fieldset>
		<label for="type">
			Pour quel repas&nbsp;?
		</label>
		<select name="type" id="type">
			<option value="" disabled selected >Choisis...</option>
			<option value="1">Petit-déjeuner</option>
			<option value="2">Encas sucré</option>
			<option value="3">Apéritif</option>
			<option value="4">Déjeuner ou dîner</option>
		</select>
	</fieldset>

	<fieldset>
		<label for="image">
			Photo du plat
		</label>
		<input type="file" name="image" id="image">
		<p>
			Photographie en couleurs respectant les spécifications suivantes&nbsp;:
			<ul>
				<li>2&nbsp;Mo maximum</li>
				<li>1920px de large et 1080px de haut minimum</li>
				<li>Format PNG, JPG ou JPEG</li>
			</ul>
		</p>
		<div class="preview"></div>
	</fieldset>

	<fieldset>
		<label for="note">
			Ton appréciation
		</label>
		<select name="note" id="note">
			<option value="" disabled selected >Choisis...</option>
			<option value="1">Plutôt sympa</option>
			<option value="2">Bonne découverte</option>
			<option value="3">Excellent</option>
			<option value="4">Coup de coeur</option>
		</select>
	</fieldset>

	<input type="submit" value="Ajouter la recette">
</form>