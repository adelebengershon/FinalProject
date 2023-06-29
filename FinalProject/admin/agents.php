<?
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "../application.php";
	include_once "../includes/header.php";
	?>
<div class="container wrapper">
<input type="button" onclick="location.href='index.php';" value="Go Back" />
	<h3>Agents</h3>
	<br/>
	<?
	switch($_REQUEST['action'])//$_REQUEST works for both : $_GET + $_POST
	{
		case 'add' : add_Agent(); break;
		case 'insert' : insert_Agent(); break;
		case 'edit' : edit_Agent($_REQUEST['id']); break;
		case 'save_edit' : save_Agent($_REQUEST); break;
		case 'delete' : delete_Agent($_REQUEST['id']); break;
		default : show_List(); break;
	}
?>

<?
	function show_List()
	{
		$agents = Agents::getAll();
		?>
			<h5>All existing agents:</h5>
				<table class="agents">
						<thead>
							<tr>
								<?
								foreach ($agents[0] as $key=>$value)//getting the title of each row
								{
									echo "<td>".$key."</td>";
								}
								?>
							</tr>
						</thead>
						<tbody>
							<?
							foreach ($agents as $agent)//getting the title of each row
							{
								echo "<tr>";
								foreach($agent as $value)
								{
									echo "<td>".$value."</td>";
								}
								echo "<td><a href='".parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)."?action=edit&id=".$agent['agent_id']."'>Edit</td></a>";
								echo "<td id='delete'><a onclick='confirm_delete(".$agent['agent_id'].");'>Delete</a></td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
					
					<button onclick = "window.location.href='http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/admin/agents.php?action=add';" >
						Add a new Agent
					</button>

	<?}//closing showlist()
	
	function insert_Agent() 
	{
		if($_POST["agentfirstname"])
			$info["agent_firstname"]=$_POST["agentfirstname"];
		if($_POST["agentlastname"])
			$info["agent_lastname"]=$_POST["agentlastname"];
		if($_POST["agentemail"])
			$info["email"]=$_POST["agentemail"];
		if($_POST["agentAbout"])
			$info["about"]=$_POST["agentAbout"];
		
		if($info) $id = Agents::insert($info);
		
		if($id)
		{
			$message = "Succesfully added another agent";
		}
		echo $message;
		show_List();
	}
	function add_Agent()
	{
		?>
			<h2>Add an agent</h2>
				<form method="post" action="agents.php">
					
					<input type ="hidden" name="action" value="insert"/>
					<br/><label>First Name </label>
					<br/><input type="text" name="agentfirstname"/>
					<br/><label>Last Name </label>
					<br/><input type="text" name="agentlastname"/>
					<br/><label>Email</label>
					<br/><input type="text" name="agentemail"/>
					<br/><label>About </label>
					<br/><textarea name="agentAbout" class="textara"></textarea>
					<br/>
					<br/>
					<br/><input type="submit" value="Add Agent"/>
				</form>	
				<button onclick = "window.location.href='http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/admin/agents.php';" >
						Cancel
				</button>
			<?
				
	}//closing addAgent()
			?>	
<?
function edit_Agent($id)
	{
		$agent = Agents::getOne($id);
		?>
			<div>
				<h4>Edit Agent</h4>
				<form id="editAgent" method="post" ><!--action="<?$config->url?>admin/agents.php"> action is what the form does after submitted --> 
					<input type="hidden" name="action" value="save_edit"/>
					<input type="hidden" name="agent_id" value="<?  echo $agent['agent_id']?>"/>
					
					<div>
					<label for="agent_firstname">First Name</label>
					<input type="text" name="agent_firstname" value="<? echo $agent['agent_firstname']?>">
					</div>
					
					<div>
					<label for="agent_lastname">Last Name</label>
					<input type="text" name="agent_lastname" value="<? echo $agent['agent_lastname']?>"/>
					</div>
					
					<div>
					<label for ="email">Email Address</label>
					<input disabled type="text" name="email" value="<? echo $agent['email']?>"/>
					</div>
					
					<div>
					<label for ="about">About</label>
					<textarea name="about" class="textara"><? echo $agent['about']?></textarea>
					</div>
					<input type="submit" value="Save">
				</form>
			</div>
<?
	}//closing editAgent
	
	function save_Agent($data){

		$arr['agent_firstname']=$data['agent_firstname'];
		$arr['agent_lastname']=$data['agent_lastname'];
		$arr['about']=$data['about'];
		
		if(Agents::update($data['agent_id'], $arr))
		{
			echo"</br>The changes were updated";
		}
		show_List();
	}//closing agent
	
	function delete_Agent($id){
		Agents::delete($id);
		echo "<br/>The entry was deleted";
		show_List();
	}
	?>
</div>
<?
		include "../includes/footer.php";
?>
<script>
		function confirm_delete(id){
			var confirm_it=confirm("Are you sure to delete this entry?");
			if(confirm_it)
				window.location.href="http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/admin/agents.php?action=delete&id="+id
			else return false;	
		}
	
	$(document).ready(function(){
		$(".active").removeClass("active");
		$("#navAdmin").addClass("active");
	});
</script>