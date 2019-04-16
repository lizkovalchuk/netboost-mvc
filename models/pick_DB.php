<?php

class Pick_DB extends Model{
	function __construct(){
		parent::__construct();
	}

////////////////////// GET BY ID ////////////////////////////
	function getByStudentId($id){
		$sth = $this->db->prepare('SELECT * FROM picks r JOIN 
			(SELECT p.id as p_id, name FROM projects p) p 
			ON r.project_id = p.p_id
					WHERE student_id = :id
					AND status = \'unranked\'');

		//$sth = $this->db->prepare('SELECT * FROM picks');
		$success = $sth->execute(array(':id'=>$id)); 
		return $sth->fetchAll(PDO::FETCH_OBJ);
	}

	public function update($pick){
		//foreach ($picks as $pick ) {
		$sth = $this->db->prepare('UPDATE picks SET
					rating = :rating,
					status = "ranked"
					WHERE id = :id');
		$sth->execute(array(
			':rating'=>(int)$pick->rating,
			':id'=>(int)$pick->id));
		//}
		//var_dump($pick);
	}

	public function createAllPicksByOutlineId($id){
		$sth = $this->db->prepare("INSERT INTO picks(student_id, project_id)  SELECT oa.student_id as sid, p.id as pid 
						FROM outline_assists oa 
							JOIN projects p
						    	ON oa.outline_id = p.outline_id
						    LEFT OUTER JOIN picks pi
						       	ON pi.student_id = oa.student_id
								AND pi.project_id = p.id
						WHERE oa.outline_id = :id
						 	AND p.status = 'approved'
						    AND pi.id IS NULL");

		$sth->execute(array(':id'=>(int)$id));

		$sth2 = $this->db->prepare("UPDATE outlines
								SET closed = 1
								WHERE id = :id");
		return $sth && $sth2->execute(array(':id'=>(int)$id));


	}

	public function getStudentIdFromPickId($id){
		$query = 'SELECT s.id
					FROM picks p
						JOIN students s
							ON p.student_id = s.id
					WHERE p.id = :id';
		$sth = $this->db->prepare($query);
		$sth->execute(array(':id'=>$id));
		return $sth->fetch(PDO::FETCH_OBJ);
	}

}

//class Pick{
//	public static function getPicksFromPost(){
//
//	}
//}
