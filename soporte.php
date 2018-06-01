<?php
	require_once 'auth.php';
	//require_once 'validate.php';
	require_once 'dbJSON.php';
  require_once 'dbMySql.php';

	$auth = new Auth();
	//$validator = new Validator();

  // 	$typeDB = 'json';
  	$typeDB = 'mysql';

	switch ($typeDB) {
		case 'json':
			$dbJSON = new dbJSON();
			break;
		case 'mysql':
			$dbMYSQL= new dbMYSQL();
			break;
		default:
			$db = NULL;
			break;
	}
