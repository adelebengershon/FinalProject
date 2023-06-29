<?
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "application.php";
	include_once "includes/header.php";
	
	//contactus_id	contactus_firstname	contactus_lastname	contactus_email	message	timestamp
	if(isset($_POST['firstname']))
		$info['contactus_firstname']=$_POST['firstname'];
	if(isset($_POST['lastname']))
		$info['contactus_lastname']=$_POST['lastname'];
	if(isset($_POST['email']))
		$info['contactus_email']=$_POST['email'];
	if(isset($_POST['message']))
		$info['message']=$_POST['message'];
//print_r($info);
	if(isset($info)) $id=Contact_Us::insert($info);
if(isset($id))
{
	header('Location: http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/thankscontact.php');
	exit;
}
?> 
<img class="contactimg" src="<?=$config->url?>images/ContactPage.jpg">
<div class=" container contact-body">
	<h2>Contact</h2> 
	<div class="grid-container">
		<div class="grid-child flex1">
			<h5>Address</h5>
			Bootstrap Realestate Inc.
			</br>8290 Walk Street, Australia
			<h5>Email</h5>
			hello@bootstrapreal.com
			<h5>Phone</h5>
			(123) 456-7890
		</div>

		<div class ="grid-child flex2">
			<h5>Online Form</h5>
			<form method="post" action="" id="contactForm">
				<div class="contact-name">
					<div class="firstname">
						<label for="firstname">First Name</label>
						<input type="text" name="firstname" placeholder="First Name" id="firstname"/>
					</div>
					<div class="lastname">
						<label for="lastname">Last Name</label>
						<input type="text" name="lastname" placeholder="Last Name" id="lastname"/>
					</div>
				</div>
				<div>
				<label for="email">Email Address</label>
				<input type="text" name="email" placeholder="Email Address" id="email" />
				</div>
				
				<label for="message">Write Your Message Here:</label>
				<div>
					<textarea name="message" id="message" class="contact_message" placeholder="Why are you reaching out to us?"></textarea>
				</div>
				<input type="submit" value="Send">
			</form>
		</div>	
	</div>
</div>
<?
	include "includes/footer.php";
?>
<script>
	$(document).ready(function(){
		$(".active").removeClass("active");
		$("#navContact").addClass("active");		
	});
</script>