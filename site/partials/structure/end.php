	<?php //if (isset($_SESSION['flash'])) : ?>
	<!--	<div class="flash">
			<?php if ($_SESSION['flash'] == 'justConnected') : ?>
				Bonjour <?php echo $_SESSION['pseudo'] ?>, comment ça va aujourd'hui&nbsp;?
			<?php endif ?>
			<?php if ($_SESSION['flash'] == 'justRegistered') : ?>
				Merci pour ton inscription, <?php echo $_SESSION['pseudo'] ?>&nbsp;!
			<?php endif ?>
		</div>-->
	<?php
		
		//unset($_SESSION['flash']);
		//endif;

		echo '<br>SESSION :<br>';
		var_dump($_SESSION);
		echo '<br><br>POST :<br>';
		var_dump($_POST);
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>