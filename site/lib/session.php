<?php
include 'uuid.php';

class Session
{
   public static function isValid($id  = NULL)
	 {
	    if (is_null($id)){
		     $id = $_COOKIE["id"];				 
			}
			 
			if (is_null($id)){
			   return false;
			}
			
      $connection = Session::getConnection();
			
			if (!is_null($connection)){
			   $stmt = $connection->prepare("SELECT * FROM tblsession WHERE id = ? and valid = 1");
				 $stmt->bind_param('s', $id);				 
				 $stmt->execute();			   
			
			   while ($stmt->fetch()) {
				    return true;
			   }
			
			   $stmt->close();
			   $connection->close();
			}
			
	    return false;	
	 }

	 public static function insertId(){
	    $connection = Session::getConnection();
		  if (!is_null($connection)){
		    $id = UUID::v4();
				$stmt = $connection->prepare("INSERT INTO tblsession VALUES (?, 1)");				
				$stmt->bind_param('s', $id);
		    $stmt->execute();
				if ($stmt->affected_rows == 1){
				   return $id;	
				}
		  }
			
			return null;
	 }
	 
	 public static function invalidateId($id){
	    $connection = Session::getConnection();			
			
			if (!is_null($id)){
		     if (!is_null($connection)){
		        $stmt = $connection->prepare("UPDATE tblsession SET valid = 0 WHERE id = ?");				
				    $stmt->bind_param('s', $id);
		        $stmt->execute();
				    if ($stmt->affected_rows == 1){
				       return true;	
				   }
		     }
			}
			
			return false;
	 }
	 
   private static function getConnection()
	 {
      $servername = "localhost";
		  $username = "root";
		  $password = "root";
		  $dbname = "limitlessreader";
		
		  $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
		  if ($conn->connect_error) {
         return null;
      }
			
			return $conn;
	 }			
}
?>