<?php
class outlineassist_DB extends Model
{
	function __construct(){
		parent::__construct();
	}

	public function getAllAssistingStudents($outline_id){
		$sth = $this->db->prepare("SELECT * 
					FROM outline_assists oa 
						JOIN students s ON oa.student_id = s.id
					WHERE outline_id = :id");
		$sth->execute(array(':id'=>$outline_id));
		return $sth->fetchAll(PDO::FETCH_OBJ);
	}

	public function addStudentAssist(){
		$student_id = $_POST['student_id'];
		$outline_id = $_POST['outline_id'];
		$sth = $this->db->prepare("INSERT INTO outline_assists(
							student_id, outline_id)
							SELECT :sid, :oid
							FROM dual
							WHERE NOT EXISTS (SELECT 1 FROM outline_assists WHERE student_id =:sid
										AND outline_id = :oid)
									");
		return $sth->execute(array(':sid'=>$student_id, ':oid'=>$outline_id));
	}

	public function deleteStudentAssist(){
		$student_id = $_POST['student_id'];
		$outline_id = $_POST['outline_id'];
		$sth = $this->db->prepare("DELETE FROM outline_assists								WHERE student_id =:sid
										AND outline_id = :oid");
		return $sth->execute(array(':sid'=>$student_id, ':oid'=>$outline_id));	
	}
}