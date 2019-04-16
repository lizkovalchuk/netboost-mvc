<?php
echo "hola";
echo __FILE__;
var_dump($_GET);
$path = str_replace('netboost','Netboost',$_SERVER['REQUEST_URI']);
if (isset($_GET['url'])) {
	$path = str_replace($_GET['url'], '', $path);
}
echo "<hr/>";
var_dump($path);
echo "<hr/>";
var_dump($_SERVER);