<?php
   include '../lib/session.php';
	 $id = $_COOKIE["id"];
	 Session::invalidateId($id);	 
	 header("Location: /");
	 die();
?>