<form id="subscribe" action="partials/traitements/form-subscribe.php" method="post">
	<fieldset class="<?php isset($_SESSION['pseudo']) ? 'error' : '' ?>">
		<label for="pseudo">
			Pseudo
		</label>
		<input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo">
		<p>
			Entre 3 et 15 lettres, sans chiffres ni caractères spéciaux, débutant par une majuscule.
		</p>

		<?php if (isset($_SESSION['pseudo'])) : ?>
			<ul>
				<?php foreach ($_SESSION['pseudo'] as $value) : ?>
					<li>
						<?php echo $value ?>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	</fieldset>

	<fieldset class="<?php isset($_SESSION['email']) ? 'error' : '' ?>">
		<label for="email">
			E-mail
		</label>
		<input type="text" name="email" id="email" placeholder="Votre email">
		<p>
			Une adresse email valide et accessible.
		</p>

		<?php if (isset($_SESSION['email'])) : ?>
			<ul>
				<?php foreach ($_SESSION['email'] as $value) : ?>
					<li>
						<?php echo $value ?>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	</fieldset>

	<fieldset class="<?php isset($_SESSION['password']) ? 'error' : '' ?>">
		<label for="password">
			Mot de passe
		</label>
		<input type="password" name="password"  id="password" placeholder="Mot de passe">
		<input type="password" name="password2" placeholder="Retapez votre mot de passe">
		<p>
			Entre 6 et 30 caractères.
		</p>

		<?php if (isset($_SESSION['password'])) : ?>
			<ul>
				<?php foreach ($_SESSION['password'] as $value) : ?>
					<li>
						<?php echo $value ?>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	</fieldset>

	<fieldset class="<?php isset($_SESSION['code']) ? 'error' : '' ?>">
		<label for="code">
			Code secret
		</label>
		<input type="password" name="code" id="code" placeholder="Code de validation">
		<p>
			Le code secret vous permettra d'être rédacteur et d'avoir des super-pouvoirs&nbsp;! 
		</p>

		<?php if (isset($_SESSION['code'])) : ?>
			<ul>
				<?php foreach ($_SESSION['code'] as $value) : ?>
					<li>
						<?php echo $value ?>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	</fieldset>

	<input type="submit" value="S'inscrire">

	<?php session_unset() ?>
</form>