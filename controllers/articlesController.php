<?php
//controller definition. every controller extends the base controller
require_once 'utils/articleMessages.php';
require_once 'models/article_DB.php';
require_once 'models/article.php';
require_once 'models/category_DB.php';


class articlesController extends Controller{
	//the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
    public function __construct(){
		parent::__construct();
    }

    //this defines an action that will be called when the user goes to controller/action
    //the structure will mostly follow this structure, require the model, interact with the db and  render a view.
    //if a path don't end in a render call, at least has to call another action, if not, nothing will be sent to the user.
    public function index($message = null, $color = "black"){
        $this->View->msgBool = false;
        if($message!=null){
            $this->View->msg = $message;
            $this->View->msgColor = $color;
            $this->View->msgBool = true;
        }

        //create a new instance of the model that will access the db.

        $model = new Article_DB();
        
        //do the db interaction
        try{
            //add whatever we will need to the View that is inside the controller
    	   $this->View->articles = $model->getAll();
           $dashboard = isset($_SESSION['loggedInUserRole'])?'dashboard':'public';
           $this->View->render('articles/index', $dashboard);
        }
        catch(Exception $e){
            $this->dataError();
        }
    }


    public function add($message = null){
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['admin']])){
            return;
        } 
        $this->View->msgBool = false;
        if(!is_null($message)){
            $this->View->msg = $message;
            $this->View->msgBool = true;
            $this->View->msgColor = 'red';
        }
        $model2 = new category_DB();
        $this->View->article = Article::getArticleFromPost($message);
        try{
            $this->View->categories = $model2->getAll();
            $this->View->render('articles/add','dashboard');
        }
        catch (Exception $e)
        {
            header("location:".BASE_PATH."articles/dataError");
        }
    }

    public function addPost(){
    	//check if valid
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['admin']])){
            return;
        }
        $message = null;
        $article = Article::getArticleFromPost($message);

        if(is_null($message)){
            $model = new Article_DB();
    		try{ 
                //var_dump(Article::getArticleFromPost());

                $result = $model->insert($article);
                if(!$result){
                    $this->add();
                }
                else{
                    //redirect to error page
                    header("location:".BASE_PATH.'articles/added');
                }
                //header('location: index');
            }
            catch(Exception $e){
                //$this->add();
                header("location:".BASE_PATH."articles/dataError");
            }
    	}
        else{
            $this->add($message);
            //$this->View->render('articles/add','dashboard');
        }

    }

    //edit action (HTTPGET)
    public function edit($id = null, $message = null){
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['admin']])){
            return;
        } 

        $this->View->msgBool = false;
        if(!is_null($message)){
            $this->View->msg = $message;
            $this->View->msgBool = true;
            $this->View->msgColor = 'red';
        }
        //WE LOAD The required classes
        //The article.php is just a class which has a con
        
        if($id!=null){
            
            $model2 = new category_DB();

            $this->View->categories = $model2->getAll();

            
            //we create a new instance of the model db
            $model = new Article_DB();
            //we start a try catch, since we will need to access the db
            try{
                //we get our object from the db
                $article = $model->getById($id);

                //if we got what we were looking for
                if($article!=null && $article!=false){
                    //we send it to the view
                    $this->View->article = $article;
                    //and we render the view
                    $this->View->render('articles/edit','dashboard');
                }
                //if we don't find what we found
                else{
                    //we send the user back to the index.
                    $this->notExist();
                }
            }
            catch(Exception $e){
                //if there was an error, we send the user back to the index.
                header("location:".BASE_PATH."articles/dataError");
            return;
                //header('location: '.BASE_PATH.'articles/index');
            }
        }
    }

    public function editPost(){
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['admin']])){
            return;
        }
        $message = null;
        $article = Article::getArticleFromPost($message);
        if(is_null($message)){            
            $model2 = new category_DB();

            try{
                $this->View->categories = $model2->getAll();
                //we get our object from the db
                //if we got what we were looking for
                $model = new Article_DB();

                //we send it to the view
                //$this->View->article = $article;
                //and we render the view
                //if it works, back to index.
                if($model->update($article)){
                    header('location:'.BASE_PATH.'articles/updated');
                }
                else{
                    $this->edit($_POST['id'],DATA_ERROR);
                }
                //$this->View->render('articles/edit','dashboard');
            }
            catch(Exception $e){
                // var_dump($e);
                header("location:".BASE_PATH."articles/dataError");

                //if there was an error, we send the user back to the index.
                //header('location: '.BASE_PATH.'articles/index');
            }
        }
                //if we don't find what we found
        else{
            if(isset($_POST)&&isset($_POST['id'])){
                $this->edit($_POST['id'],$message);
            }
            else{
                $this->error();
            }
        }

    }

    public function delete($id = null){
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['admin']])){
            return;
        }
        $model = new Article_DB();
        try{
            $article = $model->getById($id);
            if($article){
                $this->View->article = $article;
                $this->View->render('articles/delete','dashboard');
            }
            else{
                header('location: '.BASE_PATH.'articles/notExist');
            }
        }
        catch(Exception $e){
            header("location:".BASE_PATH."articles/dataError");
        }
        
    }
            
    public function deletePost(){
        if(!AuthorizationHelper::checkAuthorization(['loggedInUserRole'=>['admin']])){
            return;
        }
        if(true){
            $model = new Article_DB();
            try{
                $model->delete();
                header('location:'.BASE_PATH.'articles/deleted');
            }
            catch (Exception $e){
                header("location:".BASE_PATH."articles/dataError");
            }
        }
    }


    //SPECIAL ACTIONS

    public function eraseImage($id = null){
        if(is_null($id)){
            $this->error("No article specified");
            return;
        }

        $model = new Article_DB();
        try{
            $article = $model->getById($id);
            if($article!= false){
                $model->eraseImage($id);
                if(Article::eraseImage($article->image_url)){
                    $this->edit($id,"image deleted.");
                }
                else{
                    $this->edit($id,"image wasn't deleted from storage, but was deleted from the database.");
                }
            }
        }
        catch(Exception $e){
            $this->dataError();
        }

    }

    public function error($error = "Sorry, something went wrong.", $View = 'articles/error',$nolayout = false){
        $layout = "public";
        if (isset($_SESSION['loggedInUserRole'])) {
            $layout = "dashboard";
        }
        $this->View->msg = $error;
        $this->View->render($View,$layout,$nolayout);
        //$this->index($error,'red');
    }

    public function search($search = null){
        //create a new instance of the model that will access the db.

        $model = new Article_DB();
        //do the db interaction
        try{
            //add whatever we will need to the View that is inside the controller
            $this->View->articles = $model->getAll($search);
            $this->View->render('articles/articleList','',true);
        }
        catch(Exception $e){
            //if something goes wrong, either call an action or render a view.
            $this->dataError();
            return;
        }
    }


    //MESAGES 

    public function added(){
        $this->index(articleMessages::ARTICLE_CREATED,"green");
    }
    public function deleted(){
        $this->index(articleMessages::ARTICLE_DELETED,"green");
    }
    public function updated(){
        $this->index(articleMessages::ARTICLE_UPDATED,"green");
    }
    public function dataError($view = false){
        $this->error(articleMessages::DATA_ERROR,'articles/error',true);
    }
    public function notExist(){
        $this->error(articleMessages::ARTICLE_NOTEXIST);
    }

}