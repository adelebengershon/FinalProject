<?
	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "application.php";
	include_once "includes/header.php";
?>
<img class="contactimg" src="<?echo $config->url?>images/about1.jpg">
<div class=" container contact-body">
	
	<div class="aboutdiv">
			<div class="p_about">
			<h2>Who we are:</h2>
			We are all about Real Estate!
			<br/>Making the market better! Making the market clear!
			<br/>We are here for you!
			</div>
	</div>
</div>
<?
	include "includes/footer.php";
?>
<script>
	$(document).ready(function(){
		$(".active").removeClass("active");
		$("#navAbout").addClass("active");		
	});
</script>