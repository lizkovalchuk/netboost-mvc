<?php
require_once 'models/pick_DB.php';
class picksController extends Controller{
    //the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['student']])){
            return;
        }

		$model = new Pick_DB();

		//WE GRAB ID FROM SESSION;
		$id = $_SESSION["roleId"];

		$this->View->picks = $model->getByStudentId($id);

		$this->View->render('picks/index','dashboard');
		//$this->View->render('picks/index');
	}

	public function submitPicks(){
		if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['student']])){
            return;
        }
		$model = new Pick_DB();
		
		if($_POST['count']== count($_POST)-2)
		{

			foreach ($_POST as $key => $value) {
				if($key!='sendPicks'&&$key!='count'){
					$id = substr($key, 0, strlen($key)-6);
					$owner = $model->getStudentIdFromPickId($id);
					if (!AuthorizationHelper::checkAuthorization(['roleId'=>[$owner->id]])) {
						return;
					}
					$model->update((object)[	'id'=>(int)$id,
												'rating'=>(int)$value]);
				}
			}
			//return it to profile.
			header("location:".BASE_PATH.'picks/thankyou');

		}
		else header("location: ".BASE_PATH."picks");
	}

	public function thankyou() {
		$this->View->render('picks/thankyou','dashboard');
	}

// the action create is just for testing purposes

	// public function create($id = null){
	// 	if($id!=null){
	// 		require_once 'models/pick_DB.php';
	// 		$model = new Pick_DB();	
	// 		try {
	// 			echo $model->createAllPicksByOutlineId($id);
	// 			//echo "$id";
	// 		} catch (Exception $e) {
				
	// 		}
	// 	}
	// }

}