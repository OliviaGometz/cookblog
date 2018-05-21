<?php

session_start();

if (!isset($_SESSION['id'])) {
	header('Location: index.php');
	return;
}

session_unset();
session_destroy();