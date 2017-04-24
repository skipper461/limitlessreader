<?php
	include 'lib/session.php';
	include 'lib/book.php';	
	include 'util.php';
	
  if (!Session::isValid()){
		header("Location: /");
	  die();
	}
	
	$id = $_GET["id"];
	$bookId = $_GET["bookId"];	 

	$book = null;
	 
	foreach (Book::listAll() as $value) {
	  if ($value->id == $bookId){
		  $book = $value;
			break;
		}	 
	}
	
	$path = 'C:\amir\work\limitlessreader\books\\';
	
	if (!is_null($book)){
	   $path = $path . $book->dirName . "\\" . $id . ".png";		 
		 if (file_exists($path)){
		   $fp = fopen($path, 'rb');   
       header("Content-Type: image/png");
       header("Content-Length: " . filesize($path));
       fpassthru($fp);
       exit;
		  }
	 }	 
	
	
?>