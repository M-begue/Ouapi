<?php

class CopieRecursive{
	var $copie;
	function copie( $dir) 
	{	  
	  $hdir = opendir( $dir );
	  //echo '<p style="color:white">'.$dir.' [nb:'.count(readdir( $hdir )).']</p>';
	  
	  while ( ($item = readdir( $hdir )) !== FALSE ) {
		if($item==="." || $item==="..") continue;
		
		if ( is_dir( $dir.'/'.$item ) ) 
		{
		  $this->copie( $dir.'/'.$item);
		  //echo '<p style="color:white">'.$dir.' et '.$item.'</p>';
		}
		else 
		{
			//echo '<p style="color:white">'.$dir.'/'.$item.' -> '.$dir.'/../'.$item.'</p>';
			rename($dir.'/'.$item, $dir.'/../'.$item);
		} 
	  }
	  closedir( $hdir );
	}
}

$CopieRecursive=new CopieRecursive();
$CopieRecursive->copie("../data");
?>