<?php
require_once 'models/rating_DB.php';
class ratingsController extends Controller{
    //the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		//require_once 'models/project_DB.php';
		//var_dump($_SESSION);
		//get this from session. id in user
		$id = $_SESSION['userId'];
		//get this from session. id in role table.
		$id2 = $_SESSION['roleId'];
		//role from sessions
		$role = $_SESSION['loggedInUserRole'];

		//should use outlines model
		//$model2 = new Projects_DB();
		$model = new Rating_DB();

		$projects = $model->getProjectsByUserId($id2);
		$this->View->projects = $projects;
		// $this->View->outlines = [(object)['id'=>1,'name'=>'Project Mayhem'],
		// 						(object)['id'=>2, 'name'=>'Project Beast']];
		
		$ratings = $model->getRatingItems();
		$this->View->ratings = $ratings;

		// $this->View->ratings = [(object)['id'=>1, 'name'=>'General'],
		// 					(object)['id'=>2, 'name'=>'Response Time'],
		// 					(object)['id'=>3, 'name'=>'Communication']];

		$this->View->render('ratings/index','dashboard');
		//$this->View->render('picks/index');
	}

	public function rateProjects(){
		$model = new Rating_DB();
		
		$p_id = $_POST['project_id'];

		if($_POST['count']== count($_POST)-3)
		{
			foreach ($_POST as $key => $value) {
				if(strpos($key, 'radio') != false){
					$id = substr($key, 0, strlen($key)-6);

					$a = $model->insert((object)['rating_item_id'=>(int)$id, 'rater'=>(int)$_SESSION['userId'],
											'score'=>(int)$value, 'rated'=>$p_id]);
				}
			}
			//return it to profile.
			header("location:".BASE_PATH.'ratings');

		}
		else header("location: ".BASE_PATH."ratings");
		
	}

	public function ratedCompanies(){

		// $this->View->companies = [(object)['name'=>'company1','average'=>4.5],
		// 						(object)['name'=>'Diegos Company','average'=>3]];
		$model = new rating_DB();
		
		$this->View->companies = $model->getTopCompanies();
		$this->View->render('ratings/ratedCompanies');
	}

	//partial action -> returns partial view
	public function ratedCompany($id = null){
		if(is_null($id)){
			//redirect to error page
			// echo "no company";
		}
		$model = new Rating_DB();
		try{
			$this->View->companies = $model->getRatingForCompany($id);
			$this->View->render('ratings/ratedCompany','dashboard',true);
		}
		catch(Exception $e){
						
		}
	}




}