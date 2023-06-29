<?
	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "application.php";
	include_once "includes/header.php";
	
	$assets=Assets::getAll('','','','','Y','','','','','');
	//$asset=Assets::getOne('16');
?>
<div class="wrapper">
	<div class="container">
		<h2>Assets</h2>
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
	</div>
</div>

<?
	include "includes/footer.php";
?>
<script>
	$(document).ready(function(){
		$(".active").removeClass("active");
		$("#").addClass("active");
	});
</script>