<aside class="popin" style="display: none">
	<?php if (isset($_SESSION['id'])) : ?>
	

	<?php else : ?>
	<div id="connexion" class="popin-content">
		<?php include_once('partials/templates/form-login.php'); ?>
	</div>
	<div id="inscription" class="popin-content">
		<?php include_once('partials/templates/form-subscribe.php'); ?>
	</div>

	<?php endif ?>
</aside>