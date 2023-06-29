<?
	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "application.php";
	include "includes/header.php";

	$asset=Assets::getOnebyURL($_GET['url_name']);//asset_id title location agent_id buy_price rent_price sale_price type kitchen bedroom parking living_room description img_name show_on_slider featured tag active url_name
	$agent=Agents::getOne($asset['agent_id']);//agent_id agent_firstname agent_lastname email about	
	$cats=Categories::getAll('','', $asset['asset_id']);
?>	
<div class="wrapper">
	<div class="container">
		<?
			echo '<h1>'.$asset['title'].'</h1>';
			echo '<h2> in '.$asset['location'].'</h2>';
		?>
		<div class="asset-grid-container">
			<div class="grid-child1">
				</br><img class="assetimg" src="<?=$config->url?>images/asset_img/<?=$asset['img_name']?>">
			</div>
			<div class="grid-child2">
				<h5 class="h5des">Brief Description</h5>
				<p class="asset_desc">
				This asset is located in a perfect location with easy access to public transport. Shops are nearby with all you need. There are many parks around, where one can walk and relax.
				The place is freshly renovated, looking beautifully. Exactly what you are looking for.
				</br>Bedroom: <?=$asset['bedroom'];?>
				</br>Kitchen: <?=$asset['kitchen'];?>
				</br>Living room: <?=$asset['living_room'];?>
				</br>Parking; <?=$asset['parking'];?>
				</br>Type: <?=$asset['type'];?>
				</br>
				</br>Categories:
				<?foreach($cats as $cat){
					echo '</br>'.$cat['category'];
				}?>
				</p>
				</br><h3>Agent</h3>
				<h4><a href="<?=$config->url?>agents/<?=$agent['url_name']?>"><?echo $agent['agent_firstname']." ".$agent['agent_lastname']?></a></h4>
			</div>
		</div>
	</div>
</div>


<?
	include "includes/footer.php";
?>