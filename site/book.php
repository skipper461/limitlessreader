<?php
   include 'lib/session.php';
	 if (!Session::isValid()){
		  header("Location: /");
	    die();
	 }	 
?>
<?php
   include 'lib/book.php';
	 include 'lib/util.php';
	 $id = $_GET["id"];
	 $book = Book::get($id);
?>
<!DOCTYPE html>
<html>
   <head>
	    <link rel="stylesheet" href="/style/style.css">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
			<script src="/script/script.js"></script>
			<script src="/script/jquery.js"></script>
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
											<div class="item selected"><a href="/books">BOOKS</a></div>
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
			    <?php
					   if (!is_null($book))
						 {
					?>
					   <div class="standardPadding">
						   <div class="pageTitle"><?php echo $book->title ?>
							   <span class="authors">
									 by
									 <?php
						         foreach ($book->authors as $author){
						       ?>
									 <span><?php echo $author ?></span>									
									 <?php
									   }
									 ?>
							   </span>
						   </div>
               <div class="bigPaddingBottom">
							   <?php
						       foreach ($book->chapters as $chapter){
						     ?>
								 <div class="standardPaddingTopBottom">
								   <a class="normal" href="#<?php echo $chapter->id ?>"><?php echo $chapter->name ?></a>
								 </div>
							   <?php
								   }
							   ?>
						   </div>
							 <?php
						      foreach ($book->chapters as $chapter){
						   ?>
							 <div class="standardPaddingTopBigBottom">							   
								 <div class="title contentPaddingBottom" id="<?php echo $chapter->id;?>"><?php echo $chapter->name ?></div>
								 <?php
						       foreach ($chapter->paragraphs as $paragraph){
						     ?>
								 
								   <?php
						         foreach ($paragraph->items as $item){
						       ?>
									   <div class="normalText contentPaddingTopBottom line-height">
										   <?php
											   if ($item->type == "text"){
												   echo $item->obj->content;
												 }
												 else{
													 echo "<img src='/imgs/" .  $item->obj->src  . "' />";
													 foreach ($item->obj->captions as $caption){
														 echo "<div class=\"standardPaddingTop\">" .  $caption  . "</div>";
													 }
												 }
											 ?> 											 											 
										 </div>
									 <?php
								     }
							     ?>
								 
								 <?php
					         }
					       ?>	
							 </div>	 
						   <?php
					      }
					     ?>	 
						 </div>
					<?php
					   }
					?>
			 </div>		
		</body>
</html>	 