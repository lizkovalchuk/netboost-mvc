<?php
class Database extends PDO{
	public function __construct(){
		parent::__construct('mysql:host='.DB_PATH.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
		parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}