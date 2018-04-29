<?php

try {
	$bdd = new PDO('mysql:host=localhost;dbname=cookblog', 'root', '');
}
catch(Exception $e){
	die('Error: '.$e->getMessage());
}
