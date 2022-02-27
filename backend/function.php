<?php 

	function insert($tablename,$data,$connection){
		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				$tablename,
				implode(",", array_keys($data)),":". implode(", :", array_keys($data))
		);

		$statement = $connection->prepare($sql);
		foreach ($data as $key => &$value) {
				$statement->bindParam(':'.$key.'',$value, PDO::PARAM_STR);
			}
			$statement->execute();
	}

	function select($tablename,$connection){
		$sql = sprintf(
				"SELECT * FROM %s",$tablename);
		$statement = $connection->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

	function bookdetail($tablename,$id,$connection){
		$sql = "SELECT $tablename.*, categories.name as categoryname, authors.name as authorname FROM $tablename, categories, authors WHERE $tablename.id=:id and categories.id=$tablename.category_id and authors.id=$tablename.author_id";
		$statement = $connection->prepare($sql);
		$statement->bindParam(':id',$id,PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	function login($email,$password,$table,$connection){
		$sql = "SELECT * FROM $table WHERE email=:email";
		$statement = $connection->prepare($sql);
		$statement->bindParam(':email',$email,PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		if (!empty($result)) {
			if ($result['password']== $password) {
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	function isLoginSessionExpired(){
		$login_session_duration = 3600;

		$current_time = time();
		if (isset($_SESSION['loggedin_time']) and isset($_SESSION['user_id'])) {
			if (((time()- $_SESSION['loggedin_time']) > $login_session_duration)) {
				return true;
			}
		}
		return false;
	}


?>