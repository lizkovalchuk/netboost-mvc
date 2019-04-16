<?php
class Category_DB extends Model{
	public function getAll(){
		$sth = $this->db->query("SELECT * FROM categories");
		try{
			$sth->execute();
		}
		catch(PDOException $e){

		}

		return $sth->fetchAll(PDO::FETCH_OBJ);
	}

}