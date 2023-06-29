<?
	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "application.php";
	include_once "includes/header.php";
?>

<img class="contactimg" src="<?echo $config->url?>images/thankyou.png">

<?
	include "includes/footer.php";
?>
<script>
	$(document).ready(function(){

		const myTimeout = setTimeout(goBack, 5000);
		function goBack() {
		  window.location.href = "http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/";
		}
		
	});
</script>