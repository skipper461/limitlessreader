<?php  
   include '../lib/session.php';
	 include '../lib/cambridge.php';
	 if (!Session::isValid()){
		  header("Location: /");
	    die();
	 }	
?>