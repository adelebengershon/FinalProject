<?
	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "application.php";
	include_once "includes/header.php";
?>
<!--slider 	-->
<div class="owl-carousel" id="top_slider">
	<div class="slider">
		<div id="carouselExampleInterval" class="carousel slide " data-bs-ride="carousel" data-bs-touch="true"> 
			<div class="carousel-inner">
				<?$assets = Assets::getAll('','','','Y','Y');
					$i=0;
					foreach ($assets as $asset)
					{?>
						<div class="carousel-item  block <?if ($i==0) echo 'active'?>" data-bs-interval="2000">
							<img src="images/asset_img/<?=$asset['img_name']?>" class="d-block w-100" alt="...">
							<div class=" carousel-caption d-none d-md-block slidercaption topleft container">
								<h2><a href="<?$config->url?>assets/<?=$asset['url_name']?>"><?=$asset['bedroom']?> Bed Rooms and <?=$asset['living_room']?> Dinning Room Aparment </a></h2><?if($asset['sale_price'] != null) echo "<h2>on Sale</h2>";?>
								<p class="location"> <?=$asset['location']?></p>
								<p class="para">Until he extends the circle of his compassion to all living things, man will not himself find peace.</p>
								<button onclick="window.location.href='<?$config->url?>assets/<?=$asset['url_name']?>'">$ <?=$asset['buy_price']?></button>
							</div>
						</div>
					<?
					$i++;
					}
					?>
			</div>
		</div>
	</div>
</div>
<!--end of slider -->
<!--search -->
	<div class="search-wrapper">
		<div class="container">
			<h3>Buy, Sale & Rent</h3>
			<div class="flexparent">
				<div class="flexchild">
				<form action="search.php" method="get">
					<input type="text" class="searchtext form" placeholder="Search of Properties" name="keywords">
					<div class="three-choose">
						<div class="options">
							<label class="srchlbl">Category</label>
							<select class="form" name="category" id="srchcategory">
								<option value="all">--select--</option>
								<option value="1" >Buy</option>
								<option value="2" >Rent</option>
								<option value="3" >Sale</option>
							</select>
						</div>
						<div class="options">
							<label class="srchlbl">Price</label>
						  <select class="form" name="price" id="srchprice">
							<option value="all">--select--</option>											
						  </select>
						</div>
						<div class="options" >
							<label class="srchlbl">Type</label>
							<select class="form" name="type">
								<option value="all">--select--</option>
								<option value="Apartment">Apartment</option>
								<option value="Building">Building</option>
								<option value="Office Space">Office Space</option>
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
			<div class="owl-carousel" id="asset_slider">
			
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
					<p class="price">BuyPrice: $<?=$asset['buy_price']?></p>
					
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

	if(isset($_POST['email']))
			$info['email']=$_POST['email'];
	//print_r($info);
		if(isset($info)) $id=Subscriptions::insert($info);

?> 
<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close"></span>
	<h3>Sign Up To Our Newsletter</h3>
	<p>Join today and get updated with all the properties deal happening around.</p>
		<form method="post">
			<input type="text" placeholder="Enter Your email address" class="form" name="email">
			<input type="submit" value="Notify Me!" class="searchbtn">
		</form>
  </div>
</div>


<?
	include "includes/footer.php";
?>
<script>
	$(document).ready(function(){
	     $('#top_slider').owlCarousel({
			  items:1,
			   interval: 3000,
			   loop:true,
			   autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				rewind: true,
			});

       
			
		 $("#asset_slider").owlCarousel({
				nav: false,
				items: 5,
				loop:true,
				margin:3,
				center: false,
				autoplay: true,
				autoplayTimeout: 1500,
				autoplayHoverPause: true,
				rewind: true,
				responsiveClass:true,
				responsive:{
					0:{
						items:1,
						nav:true
					},
					600:{
						items:3,
						nav:false
					},
					1000:{
						items:5,
						nav:true,
						loop:false
					}
				}
			});	
			
			
			
		$(".active").removeClass("active");
		$("#navHome").addClass("active");
		
		//Change Price in Search, reagrd category
		$("#srchcategory").change(function(){
			switch($(this).val()){
				case '1':
					$("#srchprice").html("<option value='all'>All</option><option value='to2000000'>Less than $2'000'000</option><option value='2000000to50000000'>$2'000'000 - $50'000'000</option><option value='50000001to1000000000'>$50'000'001 - $1'000'000'000</option><option value='1000000001plus'>$1'000'000'001 - above</option>");
					break;
				case '2':
					$("#srchprice").html("<option value='all'>All</option><option value='to5000'>Less than $5000</option><option value='5000to9000'>$5000 - $9000</option><option value='9001to12000'>$9001 - $12000</option><option value='12001plus'>$12001 - above</option>");
					break;
				case '3':
					$("#srchprice").html("<option value='all'>Can't choose price</option>");
					break;
			}
		});
		
		
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