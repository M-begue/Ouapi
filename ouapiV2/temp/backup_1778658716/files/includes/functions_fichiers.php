<?php

class FileRecursive{
	var $copie;
	
	function copie($dir, $dest, $filetype = '', $recursive = 1, $prefix = '', $create_dir = 1) 
	{	  
	  $hdir = opendir( $dir );
	  
	  while ( ($item = readdir( $hdir )) !== FALSE ) 
	  {		
	  	if($item=="." || $item==".." || $item=="temp") continue;
		
		if ( is_dir( $dir.'/'.$item ) && $recursive == 1 ) 
		{
			if (!is_dir($dest.'/'.$item) && $create_dir ==1)
				mkdir($dest.'/'.$item,0777,true);		
			
			$this->copie($dir.'/'.$item, $dest.'/'.$item, $filetype, $recursive, $prefix);
		}
		elseif (!is_dir( $dir.'/'.$item ))
		{
		   if (($filetype != '' && strtoupper(substr(strrchr($item, '.'), 1)) == strtoupper($filetype)) || $filetype == '')
		   {
			   $res = copy($dir.'/'.$item, $dest.'/'.$prefix.$item);
			   //echo 'Filtre: '.$filetype.' => (R�sultat: '.$res.') '.$dir.'/'.$item.' => '.$dest.'/'.$prefix.$item.'<br/>';
			}
		} 
		else
		{
			continue;
		}
		//echo 'Filtre: '.$filetype.' => '.$dir.'/'.$item.' => '.$dest.'/'.$prefix.$item.'<br/>';
	  }
	  closedir( $hdir );
	}
	
	function delete($dir, $filetype = '', $recursive = 1, $prefix = '') 
	{	  
	  $hdir = opendir( $dir );
	  
	  while ( ($item = readdir( $hdir )) !== FALSE ) 
	  {		
	  	if($item=="." || $item=="..") continue;
		
		if ( is_dir( $dir.'/'.$item ) && $recursive == 1 ) 
		{
		  $this->delete($dir.'/'.$item, $filetype, $recursive, $prefix);
		}
		elseif (!is_dir( $dir.'/'.$item ))
		{
			if (($filetype != '' && strtoupper(substr(strrchr($item, '.'), 1)) == strtoupper($filetype)) || $filetype == '')
			{
				if	(preg_match('#^'.$prefix.'#',$item))
				{
					$res = unlink($dir.'/'.$item);
					//echo '<b>Filtre: '.$filetype.' => (R�sultat: '.$res.') '.$dir.'/'.$item.'</b><br/>';
				}
			}
		} 
		else
		{
			continue;
		}
		//echo 'Filtre: '.$filetype.' => '.$dir.'/'.$item.'<br/>';
	  }
	  closedir( $hdir );
	}
}
?>