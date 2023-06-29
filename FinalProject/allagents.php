<?
	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "application.php";
	include_once "includes/header.php";
	
	$agents=Agents::getAll();
?>
<div class="wrapper">
	<div class="container">
		<h2>All of our amazing Agents</h2>
		<?
			foreach ($agents as $agent){?>
				<li><a href="<?=$config->url?>agents/<?=$agent['url_name']?>"><?echo $agent['agent_firstname']." ".$agent['agent_lastname']?></a></li>
		<?}?>
	</div>
</div>



<?
	include "includes/footer.php";
?>
<script>
	$(document).ready(function(){
		$(".active").removeClass("active");
		$("#navAgents").addClass("active");
	});
</script>