<?php

$path_dirname = realpath(dirname(__FILE__));
//$path_dirname = substr($path_dirname,0,count($path_dirname)-12);

//var_dump($path_dirname);
//define('BASE_PATH', realpath(dirname(__FILE__)));
//echo $_SERVER["DOCUMENT_ROOT"];
//var_dump($_SERVER);
//echo realpath(dirname(__FILE__));
//echo realpath('/');
//var_dump($_GET['url']);
$path = str_replace('netboost','Netboost',$_SERVER['REQUEST_URI']);

if (isset($_GET['url'])) {
	$path = str_replace($_GET['url'], '', $path);
}
//echo "$path";
//echo $path;
define('BASE_PATH', ''.$path);
//define('BASE_PATH', $path_dirname);
//for development issues
define('PATH_URL', '');

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

//THIS IS FOR HEROKU DB
//for ip or localhost
//define('DB_PATH','us-cdbr-iron-east-05.cleardb.net');
//db name
//define('DB_NAME', 'heroku_b3fb7f7f46a6afe');
//db username
//define('DB_USERNAME', 'b6ce454fc9b1bd');
//db password
//define('DB_PASSWORD', 'aee105f2');

//THIS IS FOR DIGITAL OCEAN
////for ip or localhost/
//THIS IS FOR DIGITAL OCEAN
//for ip or localhost
define('DB_PATH','159.203.13.209');
//db name
define('DB_NAME', 'netboost');
//db username
define('DB_USERNAME', 'netboost');
//db password
define('DB_PASSWORD', 'phpfinalproject');


////THIS IS FOR DIGITAL OCEAN
////for ip or localhost
//define('DB_PATH','mysql5018.site4now.net');
////db name
//define('DB_NAME', 'db_a38ec9_mvc');
////db username
//define('DB_USERNAME', 'a38ec9_mvc');
////db password
//define('DB_PASSWORD', 'starcraft0');
//
