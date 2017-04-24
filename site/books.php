<?php
   include 'lib/session.php';
	 if (!Session::isValid()){
		  header("Location: /");
	    die();
	 }	 
?>
<?php
   include 'lib/book.php';
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
											<div class="item selected">BOOKS</div>
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
								    </div>
								 </div>
								</div>
						 </div>
					</div>
			 </div>		   
		   <div class="content">
		      <div class="standardPadding">
					   <div class="pageTitle">BOOKS</div>
						 <?php
						    foreach (Book::listAll() as $value) {
						 ?>
						    <div class="standardPaddingTopBottom">
								   <a class="normal" href="books/<?php echo $value->id; ?>"><?php echo $value->name ?><a/>
								</div>	 
						 <?php
								}
						 ?>
					</div>	 
			 </div>		
		</body>
</html>