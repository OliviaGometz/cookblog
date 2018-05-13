<form id="subscribe" action="partials/traitements/form-subscribe.php" method="post">
	<fieldset>
		<label for="pseudo">
			Pseudo
		</label>
		<input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo">
		<p>
			Entre 3 et 15 lettres, sans chiffres ni caractères spéciaux, débutant par une majuscule.
		</p>
	</fieldset>

	<fieldset>
		<label for="email">
			E-mail
		</label>
		<input type="text" name="email" id="email" placeholder="Votre email">
		<p>
			Une adresse email valide et accessible.
		</p>
	</fieldset>

	<fieldset>
		<label for="password">
			Mot de passe
		</label>
		<input type="password" name="password"  id="password" placeholder="Mot de passe">
		<input type="password" name="password2" placeholder="Retapez votre mot de passe">
		<p>
			Entre 6 et 30 caractères.
		</p>
	</fieldset>

	<fieldset>
		<label for="code">
			Code secret
		</label>
		<input type="password" name="code" id="code" placeholder="Code de validation">
		<p>
			Le code secret vous permettra d'être rédacteur et d'avoir des super-pouvoirs&nbsp;! 
		</p>
	</fieldset>

	<input type="submit" value="M'inscrire">
</form>