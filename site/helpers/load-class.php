<?php

function loadClass($class) {
	require '../../helpers/classes/'.$class.'.php';
}

spl_autoload_register('loadClass');