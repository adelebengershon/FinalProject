<?/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "application.php";
	include_once "includes/header.php";
	
	//getAll($orderby='',$order_dir='ASC', $featured='', $show_on_slider='', $active='', $tag='', $type='', $buy_price='', $rent_price='', $sale_price='', $agent_id='', $category='', $price_range='', $keywords=''){
	$assets=Assets::getAll('','','','','Y','',$_GET['type'],'','','','',$_GET['category'],$_GET['price'],$_GET['keywords']);

	?>
<div class="wrapper">
	<div class="container">
		<h2>Search Results</h2>
			<?if($_GET['category']!=NULL){
				switch($_GET['category']){
					case '1' : echo '<h3>Buy</h3>'; break;
					case '2' : echo '<h3>Rent</h3>'; break;
					case '3' : echo '<h3>Sale</h3>'; break;
				}
			}if($_GET['keywords']!=NULL){
				echo '<h3>Results for: '.$_GET['keywords'].'</h3>';
			}if($_GET['type']!= 'all' && $_GET['type']!= NULL){
				echo '<h3>Type: '.$_GET['type'].'</h3>';
			}if($_GET['price']!= 'all' && $_GET['price']!= NULL){
				echo '<h3>Price: '.$_GET['price'].'</h3>';
			}
			if($assets)	{
				?>
				<div class="alllisting-grid-container">
					<?
					foreach ($assets as $asset){?>
							
					<div class="properties grid_asset">
						<div class="image-holder">
							<img src="images/asset_img/<?=$asset['img_name']?>" class="owlimg" alt="properties"/>
							<div class="status <?=$asset['tag']?>"><?=$asset['tag']?></div>
						</div>
						<h4><a href="<?=$config->url?>assets/<?=$asset['url_name']?>"><?=$asset['title']?></a></h4>
						<p class="price">BuyPrice: $<?=$asset['buy_price']?></p>
						<a class=" searchbtn propsearchbtn " href="<?$config->url?>assets/<?=$asset['url_name']?>">View Details</a>
					</div>
					<?}?>
				</div>
			<?}
			else{
				echo '<h1 class="noresult">No results found</h1>';
			}
			?>
	</div>
</div>
	<?
	include "includes/footer.php";
?> 