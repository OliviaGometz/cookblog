<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Welcome to Home</title>
	</head>

	<body>
		<h1>
			<?php echo site_url('utilisateur/profil') ?>
		</h1>

		<p>
			Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
		</p>
	</body>
</html>