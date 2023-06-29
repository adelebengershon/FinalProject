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
	<h3>All Categories within an asset</h3>
	<br/>
	<?
	switch($_REQUEST['action'])//$_REQUEST works for both : $_GET + $_POST
	{
		case 'delete' : delete_Cat($_REQUEST['id']); break;
		default : show_List(); break;
	}

	function show_List()
	{
		$cats = Asset_Category::getAll();
		?>
			<h5>All Cats-Assets:</h5>
				<table class="agents">
						<thead>
							<tr>
								<?
								foreach ($cats[0] as $key=>$value)//getting the title of each row
								{
									echo "<td>".$key."</td>";
								}
								?>
							</tr>
						</thead>
						<tbody>
							<?
							foreach ($cats as $cat)//getting the title of each row
							{
								echo "<tr>";
								foreach($cat as $value)
								{
									echo "<td>".$value."</td>";
								}
								
								echo "<td id='delete'><a onclick='confirm_delete(".$cat['asset_id'].");'>Delete</a></td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>

	<?}
	
	function delete_Cat($id){
		Asset_Category::delete($id);
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
				window.location.href="http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/admin/categories.php?action=delete&id="+id
			else return false;	
		}
	
	$(document).ready(function(){
		$(".active").removeClass("active");
		$("#navAdmin").addClass("active");
	});
</script>