<?
	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';

	include_once "../application.php";
	include_once "../includes/header.php";

?>
<div class="wrapper">
	<div class="container">
		<h2>Welcome to admin area</h2> 
		
		<?	
		if($_SESSION['logged']==false)
		{?>
		<h4 class="plslogin">Please login:</h4>

		<form id="adminLogin">
			<input type="hidden" name="action" value="login"/>
			<label>Email Address</label>
			<input type="email" name="email"/>
			<label>Password</label>
			<input type="password" name="password"/>
			<br/>
			<input type="submit" value="Login" id="submitAdminLogin"/>
			
		</form>
		<?}	
		if($_SESSION['logged']){?>
		
		<h3>Add an Admin User</h3>
		<form id="addUserForm">
			<input type ="hidden" name="action" value="add"/>
			<label>Email Address</label>
			<input type="email" name="email"/>
			<br/><br/>
			<label>Password</label>
			<input type="password" name="password"/>
			<br/><br/>
			<input type="submit" value="Add User" id="submitNewUser"/>
		
		</form>
		<br/>
		<br/>
		<input type="button" onclick="location.href='assets.php';" value="Go to Assets" />
		<br/>
		<br/>
		<input type="button" onclick="location.href='agents.php';" value="Go to Agents" />
		<br/>
		<br/>
		<input type="button" onclick="location.href='contacts.php';" value="Go to Contacts" />
		<br/>
		<br/>
		<input type="button" onclick="location.href='subscriptions.php';" value="Go to Subscriptions" />
		<br/>
		<br/>
		<form id="logoutform">
			<input type ="hidden" name="action" value="logout"/>
			<input type="submit" value="Logout" id="logout"/>
		</form>
<?}?>
	</div>
</div>
<?	include "../includes/footer.php";
?>
<script>
	$(function() {
		$(".active").removeClass("active");
		$("#navAdmin").addClass("active");
		
		$("#logoutform").submit(function(e){
			e.preventDefault();
			var data=$("#logoutform").serialize();
			$.ajax('../ajax/ajax_adminUser.php',{
				data:data,
				type:"post",
				success:function(result){
					alert(result);
					window.location.assign("http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/admin/index.php");
				},
				error:function (xhr, status, error){
					console.log(xhr.statusText);
					console.log(error);
					console.log(xhr.responseText);
					alert("someting went wrong");
				}
			});//end ajax
		});
		
		$("#addUserForm").submit(function(e){
			e.preventDefault();
			var data=$("#addUserForm").serialize();
			$.ajax('../ajax/ajax_adminUser.php',{
				data:data,
				type:"post",
				success:function(result){
					alert(result);
				},
				error:function (xhr, status, error){
					console.log(xhr.statusText);
					console.log(error);
					console.log(xhr.responseText);
					alert("someting went wrong");
				}
			});//end ajax
		});//end of submit addUserForm
		
		$("#adminLogin").submit(function(e){
			e.preventDefault();
			var data=$("#adminLogin").serialize();
			$.ajax('../ajax/ajax_adminUser.php',{
				data:data,
				type:"post",
				success:function(result){
					alert(result);
					window.location.assign("http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/admin/");
				},
				error:function (xhr, status, error){
				console.log(xhr.statusText);
				console.log(error);
				console.log(xhr.responseText);
				alert("someting went wrong");
				}
			});//ajax
		});//end of submit loginAdminForm
	});
</script>