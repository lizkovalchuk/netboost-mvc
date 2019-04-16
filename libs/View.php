<?php 
class View{
	function __construct(){
		
	}

	public function render($name, $layout = 'public', $noInclude = false){
		$path = 'views/layouts/'.$layout.'/';
		if(!$noInclude)
			require $path.'header.php';
		require 'views/'.$name.'.php';
		if(!$noInclude)
			require $path.'footer.php';
	}
}