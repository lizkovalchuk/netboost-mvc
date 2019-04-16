<?php
class Rating_DB extends Model{
	function __construct(){
		parent::__construct();
	}

	public function getProjectsByUserId($id){
		//should join them with picks on student_id and with assign column true
		$user_id = $_SESSION['userId'];
		//ADD CONSTRAINT SO RATED COMPANIES DON'T SHOW UP!!
		$query = 'SELECT pr.id, pr.name
					FROM picks pi
				   	JOIN projects pr
				    	ON pr.id = pi.project_id
				    JOIN outlines o
				    	ON o.id = pr.outline_id
				    JOIN students s
				    	ON s.id = pi.student_id
				    JOIN users u
				    	ON u.id = s.user_id
				    LEFT OUTER JOIN ratings r
				    	ON r.rater_user_id = u.id
				WHERE pi.assign = 1
					AND o.completed = 1
				    AND r.id is NULL
					AND pi.student_id = '.$id;

		// $sth = $this->db->query('SELECT * FROM outlines p1 
		// 	JOIN (SELECT pi.student_id as sid, pi.project_id, pi.assign as pid 
		// 			FROM picks pi) p2
		// 		ON p1.id = p2.pid 
		// 	JOIN (SELECT o.id as oid 
		// 			FROM projects o) o
		// 		ON p1.id = o.oid
		// 	WHERE p1.completed = 1 
		// 	AND sid = '.$id);

		$sth = $this->db->query($query);
		//var_dump($sth);
		//return;
		//$sth->bindValue(':id',1,PDO::PARAM_INT);
		$sth->execute(array(":id"=>$id));
		$rows = $sth->fetchAll(PDO::FETCH_OBJ);
		//$sth->execute(array(':id'=>$id));
		return $rows;
	}

	public function getRatingItems(){
		$sth = $this->db->query('SELECT * FROM rating_items');
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_OBJ);	
	}

	public function insert($rating){
		$sth = $this->db->prepare('INSERT INTO ratings 
			(rater_user_id, rated_user_id, score, 
			rating_item_id) VALUES (:rater, :rated, :score, :item)');

		return $sth->execute(array(':rater'=>$rating->rater, ':rated'=>$rating->rated, ':score'=>$rating->score, ':item'=>$rating->rating_item_id));
	}

	public function getTopCompanies(){
		$query = 'SELECT c.id, c.name, ri.name as rname, avg(r.score) as average, (SELECT    AVG(score)
                                                                                  FROM      ratings ra
                                                                                  WHERE     ra.rated_user_id = r.rated_user_id ) AS totalAverage
					FROM companies c
						JOIN ratings r
							ON c.user_id = r.rated_user_id
                        JOIN rating_items ri
                        	ON r.rating_item_id = ri.id
					GROUP BY c.id, c.name,ri.name
					ORDER BY avg(r.score)
					LIMIT 20';
		$sth = $this->db->query($query);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_OBJ);
	}

	public function getRatingForCompany($id){
		$query = "SELECT c.id, c.name, ri.name as rname, avg(r.score) as average, (SELECT    AVG(score)
                                                  FROM      ratings ra
                                                  WHERE     ra.rated_user_id = r.rated_user_id ) AS totalAverage
					FROM companies c
						JOIN ratings r
							ON c.user_id = r.rated_user_id
                        JOIN rating_items ri
                        	ON r.rating_item_id = ri.id
                    WHERE c.id = $id
					GROUP BY c.id, c.name,ri.name
					ORDER BY avg(r.score)
					LIMIT 20";
		$sth = $this->db->query($query);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_OBJ);	
	}
}