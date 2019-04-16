<?php
require_once 'models/outlineassist_DB.php';
require_once 'models/student_DB.php';

class outlineassistsController extends Controller{

	public function index($id=null){
		if($id!=null){
			$model = new student_DB();
			$model2 = new outlineassist_DB();
			$this->View->students = $model->getAllStudents();
			$this->View->selectedStudents = $model2->getAllAssistingStudents($id);
			$this->View->outlineId = $id;
			//var_dump($this->View->selectedStudents);
			$this->View->render('outlineassists/index','dashboard');
		}
		else header("location:".BASE_PATH."outlineassists/error/1");
	}

	//meant to be in ajax
	public function addStudent(){
		$model2 = new outlineassist_DB();
		$model2->addStudentAssist();
		$this->View->selectedStudents = $model2->getAllAssistingStudents($_POST['outline_id']);
		$this->View->render('outlineassists/student_list','dashboard',true);
	}

	public function search(){

	}

	public function deleteStudent(){

		$model2 = new outlineassist_DB();
		$model2->deleteStudentAssist();
		$this->View->selectedStudents = $model2->getAllAssistingStudents($_POST['outline_id']);
		$this->View->render('outlineassists/student_list','dashboard',true);
	}

	public function error($error = null){
		if($error == 1){
			$this->View->error = "No outline was not specified.";
		}
		$this->View->render('outlineassists/error','dashboard');
	}
}