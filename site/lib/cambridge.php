<?php 
   class Word {
	   public $id = null;
		 public $caption = null;
     public $parentWordId = null;
		 public$parentPartId = null;
		 public $parts = null;
	 }
	 
	 class Part {
	   public $id = null;
		 public $wordId = null;
     public $caption = null;
		 public $pronunciation = null;
		 public $meanings = null;
		 public $differentForms = null;
	 }
	 
	 class Meaning {
	   public $id = null;
		 public $partId = null;
     public $text = null;
		 public $example = null;
	 }
	 
	 class DifferentForm {
	   public $id = null;
		 public $partId = null;
     public $desc = null;
		 public $text = null;
	 }
	 
	 class Cambridge {
		 public static function search($phrase){
		   $database = new PDO('sqlite:C:\amir\work\limitlessreader\dictionaries\cambridge\cambridge.sqlite');		
		 
		 }
	 }
?>