<?php
    $myPDO = new PDO('sqlite:C:\amir\work\limitlessreader\dictionaries\cambridge\cambridge.sqlite');	
    $result = $myPDO->query("SELECT Caption FROM Word");
		foreach($result as $row)
    {
        print $row['Caption'] . "\n";
    }
?>
?>