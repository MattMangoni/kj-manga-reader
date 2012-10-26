<?php

class Reader {

	/**
	 * Converts a given string to a slug
	 * @param string $str
	 * @return string
	 */
	public static function to_slug($str)
	{
	    if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
			$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
			$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
			$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
			$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
			$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
			$str = strtolower( trim($str, '-') );

	    	return $str;
	}

	/**
	 * Creates an array from the files in a given directory
	 * @param string $directory
	 * @return array
	 */
	public static function scan_directory($directory)
	{
	 	// create an array to hold directory list
	    $results = array();

	    // create a handler for the directory
	    $handler = opendir($directory);

	    // open directory and walk through the filenames
	    while ($file = readdir($handler)) {

	      // if file isn't this directory or its parent, add it to the results
	      if ($file != "." && $file != "..") {
	        $results[] = $file;
	      }

	    }

	    // tidy up: close the handler
	    closedir($handler);

	    // done!
	    return $results;
	}

	public static function create_chapter_dir($directory)
	{
		if ( mkdir( path('public').'uploads'.DIRECTORY_SEPARATOR.$directory ) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function unzip($zip_path, $unzip_path)
	{
	    $zip = new ZipArchive;
	    $res = $zip->open($zip_path);

	    if ($res === TRUE) {
	         $zip->extractTo($unzip_path);
	         $zip->close();
	    }
 	}
}