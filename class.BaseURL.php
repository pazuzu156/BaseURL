<?php

/**
 *
 * BaseURL Class
 *
 * Class for generating base URLs for your website.
 * Use this class to generate a base URL for easy
 * URLs
 *
 * Also added support for URI strings as well
 *
 * Usage: $my_var = new BaseURL;
 *        $my_var->generate_url();
 *        $my_var->generate_uri();
 *
 * @name       class.BaseURL.php
 * @package    com.kalebklein.testsites
 * @author     Kaleb Klein
 * @copyright  (c) 2012 Kaleb Klein
 * @since      Version 2.0
 *
 */

class BaseURL {
    // Define variables used to construct URL pieces
    private $prefix; // URL prefix http:// or https://
    private $domain; // Domain name example.com

    // Class constructor function
    // Used for initializing the
    // Pre-defined variables created
    //
    // Protection: Public
    public function __construct() {
        $this->prefix = $this->set_prefix(); // Set prefix equal to the set_prefix() method
        $this->domain = $this->get_domain_name(); // Set domain equal to the get_domain_name() method
    }

    // Method for figuing out the prefix for
    // The URL for secure or unsecure URLs
    //
    // Protection: Private
    private function set_prefix() {
        return (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    }

    // Method for getting the domain name
    // Biggest piece of the class to define
    // The domain name without grabbing
    // The file's absolute path
    //
    // Protection: Private
    private function get_domain_name() {
        // Get entire domain name. May or may not include domain prefix.
        // That is why we need the rest of this code
        $s = (isset($_SERVER["HTTP_HOST"])) ? $_SERVER["HTTP_HOST"] : getenv("HTTP_HOST");
        
        // Take the domain name and explode it into an array
        // Taking each piece that is seperated by a .
        $explode = explode(".", $s);
        
        // This is to check if a prefix in the domain
        // Is defined because you do not need to include
        // www. in the URL anymore. So if that is not defined
        // Then we must set var $prefix as www, or if a prefix
        // Is defined, remove the prefix from the array
        // And set $prefix as that value
        // We also need to check if the server is not being run
        // via "localhost"
        $prefix = (($explode[0] != "www" && !isset($explode[2])) && ($explode[0] != "localhost")) ? "www" : array_shift($explode);
        
        array_unshift($explode, $prefix); // Prepend the prefix into the array
        return implode(".", $explode); // Now, just return the array by imploding it back into a string
    }
    
    // Method used to remove the filename
    // From the generated URI string
    // Default disallows the file in
    // The string but can be fixed
    // by adding true into the
    // Method parameters
    // EX: generate_uri(); OR generate_uri(true);
    //
    // Protection: Public
    public function generate_uri($allow_file=FALSE) {
    	// Get entire URI string
    	$s = (isset($_SERVER["REQUEST_URI"])) ? $_SERVER["REQUEST_URI"] : getenv("REQUEST_URI");
    	
    	// Explode the pieces seperated by a /
    	$explode = explode("/", $s);
    	
    	// Remove the end of the array off
    	$suffix = array_pop($explode);
    	
    	// Check if the file is allowed
    	// To be in the URI string or not
    	// If not, run this section, else
    	// Place file back into the array
    	if(!$allow_file) {
    		// If there is no . for the extention in
    		// this string, then just replace the
    		// suffix.
    		if(!strrpos($suffix, ".")) {
    			array_push($explode, $suffix);
    		}
    	} else {
    	    array_push($explode, $suffix);
    	}
    	
    	// Piece the array back together
    	$uri = implode("/", $explode);
    	
    	// Display the uri, appending a / if
    	// the file is disallowed
    	echo ($allow_file) ? $uri : $uri . "/";
    }

    // Method used to generate the entire
    // URL from the pieces created in the
    // Other two methods. Used outside
    // Of the class to display the URL
    //
    // Protection: Public
    public function generate_url() {
        echo $this->prefix . $this->domain;
    }
}

?>
