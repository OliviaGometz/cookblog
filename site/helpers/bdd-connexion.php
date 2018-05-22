<?php

try {
	$bdd = new PDO('mysql:host=localhost;dbname=cookblog', 'root', '', array('charset' => 'utf8'));
	$bdd->query('SET CHARACTER SET utf8');
}
catch(Exception $e){
	die('Error: '.$e->getMessage());
}
