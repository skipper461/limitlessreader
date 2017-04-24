<?php
   class Util{
	    public static function throwException($id){
				throw new Exception($id);				
			}
			
			public static function startsWith($haystack, $needle)
      {
         $length = strlen($needle);
         return (substr($haystack, 0, $length) === $needle);
      }

      public static function endsWith($haystack, $needle)
      {
        $length = strlen($needle);
        if ($length == 0) {
          return true;
        }

        return (substr($haystack, -$length) === $needle);
      }
			
			public static function removeTag($line, $tag){
				return str_replace("<" . $tag . ">", "", str_replace("</" . $tag . ">", "", $line));
			}
			
			public static function getById($arr, $id){				 
				 foreach ($arr as $obj) {						
						if ($obj->id === $id){							
							return $obj;							
						}
				 }
				 
				 return null;
			}
	 }
?>

