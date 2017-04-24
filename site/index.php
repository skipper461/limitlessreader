<?php
   include 'lib/session.php';
?>
<!DOCTYPE html>
<html>
   <head>
	    <link rel="stylesheet" href="style/style.css">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
			<script src="script/script.js"></script>
			<script src="script/jquery.js"></script>
			<title>LR Web</title>
	 </head>
    <body>		  
		   <div class="topBanner">			 
			    <div class="content">
					   <div class="standardPadding">
						    <a href="/">
								   <div class="logo">								   
								   </div>
							  </a>
								<div class="menu">
								 <a href="javascript:showHideMenu()">MENU</a>
								 <div class="page">								    
										<div class="items">
										  <div class="item">
											   <a href="javascript:showHideMenu()">CLOSE</a>
											</div>
										  <?php
											  if (Session::isValid())
											  {
										    ?>
											    <div class="item">
													  <a href="/books">BOOKS</a>
												  </div>
												  <div class="item">
													  <a href="/dictionary">DICTIONARY</a>
												  </div>
												  <div class="item">
													  <a href="/helpers">HELPERS</a>
												  </div>
												  <div class="item">
													  <a href="/videos">VIDEOS</a>
												  </div>
													<div class="item">
													  <a href="/action/signout">SIGN OUT</a>
												  </div>													
										 <?php
										   }
											 else
											 {
										   ?>
											   <div class="item">
													  <a href="/signin">SIGN IN</a>
												 </div>												 								 										 
											 <?php
											 }											 
											 ?>
								    </div>
								 </div>
								</div>
						 </div>
					</div>
			 </div>		   
		   <div class="content">
		      <div class="standardPadding">
					   <?php
						   if (Session::isValid())
							 {
					   ?>
			       Please use the menu to access different sections.
						 <?php
							 }	
						   else
							 {							 
						 ?>
						 Please use the menu to sign in.
						 <?php
							 }											 
						 ?>						 
					</div>	 
			 </div>		
		</body>
</html>