<?php

class Article_DB extends Model{
	function __construct(){
		parent::__construct();
	}

//================ GET BY ID ===============================


	public function getById($id){
		$sth = $this->db->prepare("SELECT * FROM articles WHERE id = :id");
		$sth->execute(array(':id'=>$id));
		$sth->setFetchMode( PDO::FETCH_CLASS, 'Article');
		$data = $sth->fetch(PDO::FETCH_CLASS);

		return $data;
	}

//=================  GET ALL ================================


	public function getAll($search = ""){
		if(!isset($_SESSION["loggedInUserRole"])||$_SESSION["loggedInUserRole"]!="admin"){
			$query = "SELECT a.id, a.title, a.body, a.publish_date, c.name, a.image_url FROM articles a
			JOIN categories c ON a.category_id = c.id WHERE publish_date < now()";
		}
		else{
			$query = "SELECT a.id, a.title, a.body, a.publish_date, c.name, a.image_url FROM articles a
			JOIN categories c ON a.category_id = c.id WHERE 1 = 1";
		}

		if($search!=""){
			$query .= " AND (a.title LIKE \""."%$search%"."\" OR a.body LIKE \""."%$search%"."\")";
		}

		try{
			$sth = $this->db->query($query);
			$sth->execute();
		}
		catch(Exception $e){

		}

		$data = $sth->fetchAll(PDO::FETCH_CLASS, "Article");
		//print_r($data); 
		return $data;
	}



	public function insert($article){
		//var_dump($article);
		$d = substr($article->publish_date,0,2);
		$m = substr($article->publish_date, 3,2);
		$Y = substr($article->publish_date,-4);
		$title = $article->title;
		$body = $article->body;
		//var_dump(strtotime($article->publish_date));
		$image_url = $article->image_url;
		$publish_date = $article->publish_date==""?null:date("Y-m-d H:i:s",strtotime($article->publish_date));
		$user_id = 1;//$article->user_id;
		$category_id = $article->category_id;


		$sth = $this->db->prepare('INSERT INTO articles (title, body, image_url, publish_date,
			user_id, category_id) VALUES (:title, :body,:image_url, :publish_date, :user_id, :category_id)');
		return $sth->execute(array(
					':title'=>$title,
					':body'=>$body, 
					':image_url' => $image_url,
					':publish_date' => $publish_date,
					':user_id'=>$user_id, 
					':category_id' =>$category_id));
	}

	public function delete(){
		$id = $_POST['id'];
		//var_dump($_POST);
		$sth = $this->db->prepare('DELETE FROM articles WHERE Id = :id');
		$sth->execute(array(':id'=>$id));		
	}

	public function update($article){
		//we create an update statement. if the image_url was changed, we update it as well, if not, we don't include it.
		$image_defined = $article->image_url!=null & $article->image_url!="";

		$query = 'UPDATE articles SET
						title = :title,
						body = :body,';
		$query.=($image_defined)?'image_url = :image_url,':'';
		$query.='publish_date = :publish_date,
						category_id = :category_id
						 WHERE Id = :id';
		$sth = $this->db->prepare($query);
		//we have to do the same thing with the array now.
		$params = array(
			':title'=>$article->title,
			':body'=>$article->body,
			':publish_date' => $article->publish_date, 
			':category_id' =>$article->category_id,
			':id'=>$article->id);
		var_dump($params);

		if($image_defined){
			$params[':image_url'] =$article->image_url; 
		}

		return $sth->execute($params);
	}

	public function eraseImage($id){
		$query = 'UPDATE articles SET image_url = null
					WHERE id = :id';
		$sth = $this->db->prepare($query);
		return $sth->execute(array(':id'=>$id));
	}
}