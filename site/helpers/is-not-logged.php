<?php

//nécessite avant un session_start()

if (!isset($_SESSION['id'])) {
	header('Location: index.php');
	return;
}