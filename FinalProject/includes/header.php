<?
	//include_once "application.php";
?>
<!doctype HTML>
<html>
	<head>
	
		<meta charset="utf-8"><!--Bootstrap proper responsive behavior -->
		<meta name="viewport" content="width=device-width, initial-scale=1"><!--Bootstrap proper responsive behavior -->
	
      <title> <? $title ?> </title>
	  
		<link rel="stylesheet" href="<?echo $config->url?>owlcarousel/owl.carousel.min.css"><!-- owl carousel css-->
		<link rel="stylesheet" href="<?echo $config->url?>owlcarousel/owl.theme.default.min.css"><!-- owl carousel css-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"><!--Bootstrap css -->
		<link rel="stylesheet" type="text/css" href="<?echo $config->url?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?echo $config->url?>css/admin.css">
	  
	  <meta name="description" content="<? echo $page_description?>"/>
	  <meta name="keyword" content="<? echo $page_keywords?>"/>
	  
	</head>
	<?//print_r($_SESSION);?>
	<body>
		<div class="body">
			<!--navbar -->
				<div class="navbar-wrapper">
					<div class="container">
						<div class="navbar-inverse" role="navigation">
							
							<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
								<div class="container-fluid justify-content-end">
									<li class="nav-item"><a class="" id="navAdmin" style="color:white;" href="<?echo $config->url?>admin/">Admin</a></li>
									<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
										<span class="navbar-toggler-icon"></span>
									</button>
									
									<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
										<ul class="nav navbar-nav navbar-right" id="list">
											<li class="nav-item">
												<a class="nav-link " id="navHome" href="<?echo $config->url?>index.php">Home</a><?//aria-current="page"?>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="navAbout" href="<?echo $config->url?>about.php">About</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="navAgents" href="<?echo $config->url?>allagents.php">Agents</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="navContact" href="<?echo $config->url?>contact.php">Contact</a>
											</li>
										</ul>
									</div>
								</div>
							</nav>
						</div><!--closing of navbar-inverse -->
					</div>
				</div><!--closing of navbar-wrapper -->

<!--header -->	
	<div class="header-wrapper">
		<div class="container">
			<a href="<?echo $config->url?>index.php"><img src="<?echo $config->url?>images/logo.png"></a>
			<ul>
				<li class="buysalerent"><a href="<?echo $config->url?>search.php?category=1">Buy</a></li>
				<li class="buysalerent"><a href="<?echo $config->url?>search.php?category=3">Sale</a></li>
				<li class="buysalerent"><a href="<?echo $config->url?>search.php?category=2">Rent</a></li>
			</ul>
		</div>
	</div>
<!-- closong of header -->	