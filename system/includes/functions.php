<?php

function print_array(array $array){
  	    static $level = 1;
  	
  	    if($level < 1){
  	    	$level = 1;
  	    }

  	    $spacing = str_repeat("&nbsp;", $level*2);
  	    $counter = 0;

  	    echo "Array(";
  		foreach ($array as $key => $value) {
  			 $counter++;
  			 
  			 echo "<br>$spacing [$key] => ";
  			 if(is_array($value)){
  			 	$level++;
  			 	print_array($value);
  			 }else{
  			 	echo $value;

  			 	if($counter == count($array)){
  			 		$level--;
  			 	}
  			 }
  		}
  		echo "<br>$spacing); <br>";
 }