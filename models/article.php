<?php
class Article{
	function __construct(){
		$this->title = (isset($this->title)) ? $this->title : "";
		$this->body = (isset($this->body)) ? $this->body : "";
		$this->image_url = (isset($this->image_url)) ? $this->image_url : "";
		$this->user_id = (isset($this->user_id))? $this->user_id : 0;
		$this->category_id = (isset($this->category_id))? $this->category_id : 4;
		$this->id = (isset($this->id))? $this->id : 0;
		$this->publish_date = (isset($this->publish_date)&&$this->publish_date!="")? $this->publish_date : null;
	}
	

	public static function getArticleFromPost(&$fileMessage){
		if(isset($_POST))
		{
			$article = new Article();
			foreach ($_POST as $key => $value) {	
				$article->$key = $value;
			}

			require_once '../web/utils/uploadHelper.php';
			
			if(isset($_FILES['image_url'])&&$_FILES['image_url']['name']!="") {
				var_dump($_FILES);
				$bool = uploadHelper::uploadFile('image_url',$fileMessage);
				if ($bool == true) {
					$article->image_url = $bool;
				}
				else{
					$article->image_url = null;
				}
			}
			if(property_exists($article,'previousImage')&&$article->previousImage!=""){
				Article::eraseImage($article->previousImage);
			}
			$publish_date = $article->publish_date;
			$article->publish_date = (!isset($publish_date)&&$publish_date!="")?$publish_date:null;
			// $article->body = $article->body);
			// $article->title = Article::filterText($article->title);

			return $article;
		}
		else
			return new Article();
	}

	public static function eraseImage($image_url){
		if(!is_null($image_url)){
			return unlink('../web/uploads/articles/'.$image_url);
		}
		else return false;
	}

	public static function filterText($text){
		if($text==""){return $text;}
		$ch = curl_init();
		$text = str_replace(' ', '__', $text);
		curl_setopt($ch, CURLOPT_URL, "https://www.purgomalum.com/service/json?text=".$text."&fill_char=*");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, "censor-character=*&content=This text does not actually contain any bad words!");
		// curl_setopt($ch, CURLOPT_POST, 1);

		// $headers = array();
		// $headers[] = "X-Mashape-Key: tdaN60qDtImsh3fcsEYJ5sSsLnjcp11aNfnjsnZeNie1EzLvmD";
		// $headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Accept: application/json";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		$result = json_decode($result);
		//var_dump($result->result);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		return str_replace('__',' ',$result->result);
	}
}