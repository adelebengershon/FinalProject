<?
Class Admin_Users{
	
	static function insert($info){
		global $db;
		$id=$db->insert('Admin_Users', $info);
		self::update($id, $info);//self ie inside this class
		return $id;
	}
	
	static function update($id, $info){
		global $db;
		if(isset($info['password'])){
			$info['password'] = md5(md5($id).$info['password'].$id);//encrypts the given password
		}
		$db->update('Admin_Users', $id, $info, 'adminId');
	}//update($table_name ,$id ,$info, $p_key = 'id') 
	
	function login($email='', $password=''){
		if(!$email || !$password) return "empty";
		global $db;
		$admin=$db->getOneByKey('Admin_Users',$email,'email');//checking if the given email exists in database      getOneByKey($table_name, $id = 0, $p_key = 'id', $column_name= '*')
		if (!$admin) return "not_user";//if not found
		if ($admin['password']==md5(md5($admin['adminId']).$password.$admin['adminId'])){//checking if given password is the same as the inserted password usind md5
			$_SESSION['admin_id']=$admin['adminId'];//if same safe the id in session
			$_SESSION['logged']=true;//and safe in session that is logged in
			return $admin;
		}	
		else return "invalid_passport";//if not same password ->invalid
	}
	
	function getOne($id=''){
		global $db;
		return $db->getOneByKey('Admin_Users', $id);
		
	}
	function getOneByEmail($email=''){
		global $db;
		return $db->getOneByKey('Admin_Users', $email,'email');
	}
	
	
	function getAll($orderby='',$order_dir='ASC', $active=''){
		global $db;
		$sql="SELECT * FROM Admin_Users WHERE 1";
		
		if($active){
			$sql .= " AND Admin_Users.Active='".$active."'";
		}
		if($orderby){
			$sql .= " ORDER BY ".$orderby ." ". $order_dir;
		}
		return $db->query($sql);
	}
	
	function resetPassword($email){
		$user = self::getOneByEmail($email);
		if(!$user) return "no_user";
		$char="1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()";
		$charSize = strlen($char);//getting the length of the given string
		
		$temp_pass = "";
		$pass_size = 8;
		for($i=0;$i < $pass_size;$i++){
			$temp_pass .= $char[rand(0, $charSize-1)];//adding to temp password 8x a ramdnom character from the char, giving min value and max
		}
		$user['password'] = $temp_pass;
		self::update($user['adminId'], $user);
		mail($user['email'], "Reset Password", "Hello, Your new password is as following: ".$temp_pass);
		return "reset_succesful";
	}
}

?>