<?php
require_once('config/definitions.php');
require_once('libs/Bootstrap.php');

require_once('libs/Controller.php');
require_once('libs/Model.php');
require_once('libs/View.php');
require_once('libs/Database.php');
require_once('utils/authorizationHelper.php');
require_once('utils/validation.php');
require_once('utils/validationError.php');
require_once('utils/generalUtils.php');
require_once('utils/emailHelper.php');
require_once('utils/homeError.php');

//require('config/database.php');

try{
	$app = new Bootstrap();
}
catch(PDOException $e) {
    var_dump($e);
}

