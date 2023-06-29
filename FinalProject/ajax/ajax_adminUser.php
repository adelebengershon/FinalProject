<?
	include_once "../application.php";
	
	switch ($_POST['action']){
		case 'add': addUser(); break;
		case 'login': loginUser(); break;
		case 'logout': logout(); break;
	}
	function addUser(){
		$info['email']=$_POST['email'];
		$info['password']=$_POST['password'];
		$id = Admin_Users::insert($info);
		if($id) echo "User was inserted to database";
	}
	function loginUser(){
		$result = (new Admin_Users)->login($_POST['email'], $_POST['password']);
		if($result=='not_user') echo 'There is no admin with this email address in our database';
		else if ($result=='invalid_passport') echo 'Incorrect Password';
		else if ($result=='empty') echo 'Please enter your email address and passwort';
		else echo 'Welcome to your admin area!';
	}
	function logout(){
		if($_SESSION['logged']){
			$_SESSION['logged']=false;
			$_SESSION['admin_id']='';
			echo "Succesfully logged out";
		}
	}
?>