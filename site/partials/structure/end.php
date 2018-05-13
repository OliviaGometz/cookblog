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

	<aside class="message">
		<?php
			if (isset($_SESSION['message'])) {
				include_once('partials/templates/message-'.$_SESSION['message'].'.php');
			}
		?>
	</aside>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>

<?php
	echo '<br>SESSION :<br>';
	var_dump($_SESSION);
	echo '<br><br>POST :<br>';
	var_dump($_POST);
?>