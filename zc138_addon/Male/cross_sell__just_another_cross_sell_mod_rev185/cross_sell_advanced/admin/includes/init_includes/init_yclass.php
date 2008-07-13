<?php
	// y stands for yellow1912 :p. I simply add this to store all the functions frequently used in my mods
	
	// PHP4 always pass object by value (default) while PHP5 pass by reference
	if (version_compare(phpversion(), '5.0') < 0) {
	    eval('
	    function clone($object) {
	      return $object;
	    }
	    ');
	}
	
	class yclass{
		function db_result_to_string($glue, $db_result){
			$temp_array = array();
			if($this->is_obj($db_result,'queryFactoryResult')){
				// We need to clone, because we don't want to touch the real object
				while(!$db_result->EOF){
					$temp_array[] = $db_result->fields['products_'.XSELL_FORM_INPUT_TYPE];
					$db_result->MoveNext();
				}
				$db_result->Move(0);
				$db_result->MoveNext();
			}
			
			return implode($glue,$temp_array);
		}
		
		// This function does not work for all languages! BEWARE
		function array_to_upper(&$entries){
			foreach($entries as $entry){
				$entry = strtoupper($entry);
			}
		}
		
		// http://us3.php.net/manual/en/function.is-object.php#66370
		function is_obj( &$object, $check=null, $strict=true ){
			if (is_object($object)) {
		    	if ($check == null) {
		        	return true;
		      	} else {
		        	$object_name = get_class($object);
		        	return ($strict === true)?( $object_name == $check ):( strtolower($object_name) == strtolower($check) );
		      	}   
		  	} else {
		    	return false;
		  	}
		}
	}
?>