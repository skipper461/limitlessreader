<?php

class Chapter
{
	public $name = null;
	public $id = null;
	public $paragraphs = null;
	
	function __construct() {
     $this->paragraphs = array();		 
  }
}

class Paragraph
{	
	public $items = null;
	
	function __construct() {
     $this->items = array();		 
  }	
}

class Item
{	
	public $type = null;
	public $obj = null;		
}

class Image
{
	public $src = null;
	public $captions = null;
	
	function __construct() {
     $this->captions = array();		 
  }	
}

class Text
{	
	public $content = null;
}

class Book
{
	public $name = null;
	public $id = null;
	public $title = null;
	public $fullPath = null;
	public $dirName = null;
	public $authors = null;
	public $chapters = null;
	
	private static $path = "C:\amir\work\limitlessreader\books";
	
	function __construct() {
     $this->authors = array();
		 $this->chapters = array();
  }
	
	public static function get($id){
	   try{
		 if (!is_null($id)){
			  $books = self::listAll();
			  $chapter = null;
				$paragraph = null;
				$item = null;
				$img = null;
				
				foreach ($books as $book) {
				   if ($book->id == $id){
					    $file = fopen($book->fullPath, "r") or Util::throwException("Unable to open the file.");
							if ($file){
								$bookObj = new Book();
								$mood = 0;								
								$bookObj->id = $id;
								
								while (($line = fgets($file)) !== false) {								 
									$line = trim($line);
									
									if ($mood == 0){
										if ($line == "<book>"){
										   	$mood = 1;											
										}										
									}
									
									if ($mood == 1){
									  if ($line == "<metadata>"){
										   $mood = 2;											
										}										
									}

								  if ($mood == 2){
									  if ($line == "<about>"){
										   $mood = 3;
										}								
										if ($line == "<index>"){
										   $mood = 5;											 
										}								
									}									
									
									if ($mood == 3){
									  if (Util::startsWith($line, "<title>")){
										  $bookObj->title = Util::removeTag($line, "title");											
										}
										
										if (Util::startsWith($line, "<authors>")){
										  $mood = 4;
										}
										
										if (Util::startsWith($line, "</about>")){
										  $mood = 2;
										}
									}
									
									if ($mood == 4){
										if (Util::startsWith($line, "<author>")){
										  $bookObj->authors[] = Util::removeTag($line, "author");
										}
										
										if (Util::startsWith($line, "</authors>")){
										  $mood = 3;
										}
									}																
									
									if ($mood == 5){
								    if (Util::startsWith($line, "<item>")){
											$mood = 6;
									  } 										
							    }
									
									if ($mood == 6){
										if (Util::startsWith($line, "<id>")){
										  $chapter = new Chapter();
											$chapter->id = Util::removeTag($line, "id");											
									  }										
										if (Util::startsWith($line, "<text>")){											
											$chapter->name = Util::removeTag($line, "text");											
											$bookObj->chapters[] = $chapter;											
									  }
										if ($line == "</metadata>"){
										   $mood = 1;											
										}										
							    }
									
									if ($mood == 1){
									  if ($line == "<chapters>"){
										   $mood = 7;											
										}										
									}
									
									if ($mood == 7){
									  if (Util::startsWith($line, "<id>")){
										   $chapId = 	Util::removeTag($line, "id");											 
											 $chapter = Util::getById($bookObj->chapters, $chapId);											 
										}
										
										if (Util::startsWith($line, "<paragraph>")){
										   $mood = 8;
											 $paragraph = new Paragraph();
										}
									}
									
									if ($mood == 8){
									  if (Util::startsWith($line, "<text>")){
											$text = new Text();											
											$item = new Item();
											$item->type = "text";
											$item->obj = $text;
											$text->content = Util::removeTag($line, "text");
										}
										
										if (Util::startsWith($line, "<img>")){
											$img = new Image();											
											if (!is_null($item)){												
												$paragraph->items[] = $item;
											}
											
											$item = new Item();
											$item->type = "image";
											$item->obj = $img;
											$mood = 9;
										}
										
										
										if (Util::startsWith($line, "</paragraph>")){
										  $chapter->paragraphs[] = $paragraph;
											if ($item->type == "text"){
											   $paragraph->items[] = $item;
											}
											
											$mood = 7;
										}
									}
									
									if ($mood == 9){										
										if (Util::startsWith($line, "<src>")){
										   $img->src = $id . '/' . Util::removeTag($line, "src");											 
										}
										
										if (Util::startsWith($line, "<caption>")){
										   $img->captions[] = Util::removeTag($line, "caption");	
										}
										
										if (Util::startsWith($line, "</img>")){										  
											$paragraph->items[] = $item;
											$mood = 8;
										}
									}									
								}
								
								fclose($myfile);								
								
								return $bookObj;
							}
				   }				 
			  }
		 }
		 } catch(Exception $e){			 
		 }	 
		 
		 return null;
	}

  public static function listAll(){				 	   
     $books = array();

     $dir = dir(self::$path);

     while (false !== ($entry = $dir->read())) {
        if ($entry != '.' && $entry != '..') {
           if (is_dir(self::$path . '/' .$entry)) {
              $fs = strpos($entry, ' ');
														
							if ($fs != false) {
								$book = new Book();
								$book->id = substr($entry, 0, -(strlen($entry) - $fs));
								$book->name = substr($entry, $fs + 3);								
								$book->dirName = $entry;							
							  $book->fullPath = self::$path . "\\" . $entry .  "\\" . $book->name .  ".xml";
								$books[] = $book; 
							}							
          }
       }
    }

		return $books;
	}
}

?>