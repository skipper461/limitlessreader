<?php
   include '../lib/session.php';
	 
	 header("Content-Type: application/json");
	 
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(isset($_POST['username']) && $_POST['username'] == 'amir.skipper@gmail.com'){
         if(isset($_POST['password']) && $_POST['password'] == 'kirebabam31sante'){
             $id = Session::insertId();
						 if(isset($_POST['setcookie']) && $_POST['setcookie'] == 'yes'){
						    setcookie("id", $id,  time() + (10 * 365 * 24 * 60 * 60), "/", null, false, true);
								echo "{\"result\": \"good\"}";
						 }
						 else{
							 echo "{\"result\": \"good\" ,\"id\":\"" . $id . "\"}";
						 }						 
						 
						 return;
         }    
      }
   }	 
	 
	 echo "{\"result\": \"bad\"}";
?>