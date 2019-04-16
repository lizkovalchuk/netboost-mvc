<?php
class coursesController extends Controller{
    //the construct has to call at least the parent constract, which will add a view to the controller. (just copy code)
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->View->render('courses/index','dashboard');
        //$this->View->render('picks/index');
    }
}