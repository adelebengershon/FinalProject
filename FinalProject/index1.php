<?
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "application.php";
	include "includes/header.php";
?>
<!--slider 	-->
<div class="slider">
	<div id="carouselExampleInterval" class="carousel slide " data-bs-ride="carousel" data-bs-touch="true"> 
		<div class="carousel-inner">
			<?//asset_id title location agent_id buy_price rent_price sale_price type kitchen bedroom parking living_room description img_name show_on_slider featured tag active url_name
				$assets = Assets::getAll('','','','Y','Y');
				//print_r($assets); 
				$i=0;
				foreach ($assets as $asset)
				{?>
				<div class="carousel-item block<? if ($i==0) echo 'active '?> " data-bs-interval="1000">
					<img src="images/asset_img/<?=$asset['img_name']?>" class="d-block w-100" alt="...">
					<div class=" carousel-caption d-none d-md-block slidercaption topleft container">
						<h2><a href="<?=$config->url?>assets/<?=$asset['url_name']?>"><?=$asset['bedroom']?> Bed Rooms and <?=$asset['living_room']?> Dinning Room Aparment </a></h2><?//if($asset['sale_price'] != null){echo "on Sale";}?>
						<p class="location"> <?=$asset['location']?></p>
						<p class="para">Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>
						<button>$ <?=$asset['buy_price']?></button>
					</div>
				</div>
				<?
				$i++;
				}
				?>
		</div><!--closing inner -->	
	  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	  </button>
	  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
	   <span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	  </button>
	</div>
</div>
<!--end of slider -->

<!--search -->
	<div class="search-wrapper">
		<div class="container">
			<h3>Buy, Sale & Rent</h3>
			<div class="flexparent">
				<div class="flexchild">
				<form>
					<input type="text" class="searchtext form" placeholder="Search of Properties">
					<div class="three-choose">
						<div class="options">
							<select class="form">
								<option>Buy</option>
								<option>Rent</option>
								<option>Sale</option>
							</select>
						</div>
						<div class="options">
						  <select class="form">
							<option>Price</option>
							<option>$150,000 - $200,000</option>
							<option>$200,000 - $250,000</option>
							<option>$250,000 - $300,000</option>
							<option>$300,000 - above</option>
						  </select>
						</div>
						<div class="options">
							<select class="form">
								<option>Property</option>
								<option>Apartment</option>
								<option>Building</option>
								<option>Office Space</option>
							</select>
						</div>
					
					<div >
						<button class="searchbtn">Find Now</button>
					</div>
					</div>
				</form>
				</div>
				<div class="srchlogin flexchild">
					<div><p>Join now and get updated with all the properties deals.</p></div>
					<div><button id="myBtn">Sign Up</button></div>
				</div>
			</div>
		</div>
	</div>
	
<!--end of search -->

<!--banner-->
	<div class="banner-wrapper">
		<div class="container">
			<div class="banner-title">
				<h2>Featured Properties</h2>
				<a href="alllistings.php" class="viewall">View All Listing</a>
			</div>
			<div class="owl-carousel">
			
			<?
			$assets = Assets::getAll('','','Y','','Y');
			//print_r($assets);
			foreach ($assets as $asset)
			{
			?>
				<div class="properties">
					<div class="image-holder">
						<img src="images/asset_img/<?=$asset['img_name']?>" class="owlimg" alt="properties"/>
						<div class="status <?=$asset['tag']?>"><?=$asset['tag']?></div>
					</div>
					<h4><a href="<?=$config->url?>assets/<?=$asset['url_name']?>"><?=$asset['title']?></a></h4>
					<p class="price">Price: $<?=$asset['buy_price']?></p>
					
					<div class="listing-details">
						<div class="toolt"><?=$asset['bedroom']?><span class="toolttext">Bedroom</span></div>
						<div class="toolt"><?=$asset['living_room']?><span class="toolttext">Living Room</span></div>
						<div class="toolt"><?=$asset['parking']?><span class="toolttext">Parking</span></div>
						<div class="toolt"><?=$asset['kitchen']?><span class="toolttext">Kitchen</span></div>
					</div>
					<a class=" searchbtn propsearchbtn " href="<?$config->url?>assets/<?=$asset['url_name']?>">View Details</a>
				</div>
				
			<?}?>
			</div>
		</div>
	</div>
<!--end of banner-->
<?

	if($_POST['modalemail']){
			$info['email']=$_POST['email'];
	}
	//print_r($info);
	if($info) $id=Subscriptions::insert($info);

?> 
<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close"></span>
	<h3>Sign Up To Our Newsletter</h3>
	<p>Join today and get updated with all the properties deal happening around.</p>
		<form method="post">
			<input type="text" placeholder="Enter Your email address" class="form" name="modalemail">
			<input type="submit" value="Notify Me!" class="searchbtn">
		</form>
  </div>
</div>

<?
	include "includes/footer.php";
?>
<script>
	$(document).ready(function(){
		$(".active").removeClass("active");
		$("#navHome").addClass("active");
		
		
		
		
		// Get the modal
		var modal = document.getElementById("myModal");

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on the button, open the modal
		btn.onclick = function() {
		  modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		  if (event.target == modal) {
			modal.style.display = "none";
		  }
		}
	});
</script> 