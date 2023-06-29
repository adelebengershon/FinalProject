<!--footer--><?//php error_reporting(0); ?> 

	<div class="footer-wrapper">
		<div class="container">
			<div class="row">
				<div class="footer-div">
					<h4>Information</h4>
					<ul>
						<li><a href="<?echo $config->url?>about.php">About</a></li>
						<li><a href="<?echo $config->url?>allagents.php">Agents</a></li>
						<li><a href="<?echo $config->url?>contact.php">Contact</a></li>
					</ul>
				</div>
				
				
				<div class="footer-div">
				<?

	if($_POST['subemail'])
			$info['email']=$_POST['subemail'];
	//print_r($info);
		if($info) $id=Subscriptions::insert($info);

?> 
				
					<h4>Newsletter</h4>
					<p>Get notified about the latest properties in our marketplace.</p>
					<form method="post">
						<input type="text" placeholder="Enter Your email address" class="form" name="subemail">
						<input type="submit" value="Notify Me!" class="searchbtn">
					</form>
				</div>
				<div class="footer-div">
					<h4>Follow us</h4>
					<a href="#"><img src="<?echo $config->url?>images/facebook.png" alt="facebook"></a>
					<a href="#"><img src="<?echo $config->url?>images/twitter.png" alt="twitter"></a>
					<a href="#"><img src="<?echo $config->url?>images/linkedin.png" alt="linkedin"></a>
					<a href="#"><img src="<?echo $config->url?>images/instagram.png" alt="instagram"></a>
				</div>
				<div class="footer-div">
					<h4>Contact us</h4>
					<p>
						<b>Bootstrap Realestate Inc.</b>
						<br>
						8290 Walk Street, Australia
						<br>
						hello@bootstrapreal.com
						<br>
						(123) 456-7890					
					</p>
				</div>
			</div><!--closing of row-->
			<p class="copyright">Copyright 2013. All rights reserved.</p>
		</div>
	</div>
<!--end of footer-->


		
		</div> <!-- end of body div-->
		<script src=" <?echo $config->url?>/js/jquery.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script><!--Bootstrap JS-->
		<script src="<?echo $config->url?>owlcarousel/owl.carousel.min.js"></script><!--owl carousel java script-->
		<script src=" <?echo $config->url?>/js/script.js"></script>
	</body>
</html>