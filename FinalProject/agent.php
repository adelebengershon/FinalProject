<?
	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "application.php";
	include_once "includes/header.php";
	
	$agent=Agents::getOnebyURL($_GET['url_name']);//agent_id agent_firstname agent_lastname email about	
	$assets=Assets::getAll('','','','','Y','','','','','',$agent['agent_id']);
?>	
<div class="wrapper">
	<div class="container">
		<h1><?echo $agent['agent_firstname']." ".$agent['agent_lastname']?></h1>
		<h5>Email</h5><?echo $agent['email']?>
		<h5>About</h5><p><?=$agent['about']?></p>
		<h5>Assets</h5>
		<?
			foreach ($assets as $asset){?>
				<a href="<?=$config->url?>assets/<?=$asset['url_name']?>"><li><?=$asset['title']?></li></a>
			<?}?>
	</div>
</div>


<?
	include "includes/footer.php";
?>