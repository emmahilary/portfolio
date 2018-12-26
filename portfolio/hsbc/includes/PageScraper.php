<?php

// The file path to the Ganon DOM parser
// https://github.com/Shemahmforash/Ganon
define( 'GANON_LOCATION', 'includes/libraries/ganon.php' );

/**
 * A class that provides the functionality to scrape
 * data off of any web site.
 */
class PageScraper{
	
	/**
	 * @var string The URL of the page being scraped.
	 */
	private $url 	= '';
	
	/**
	 * @var resource The cURL handle for the connection.
	 */
	private $cURL 	= null;
	
	/**
	 * @var object The parsed HTML of the page being scraped.
	 */
	private $html 	= '';
	
	/**
	 * Initializes the cURL connection and stores its handle.
	 * 
	 * @constructor
	 */
	public function __construct(){
		
		$this->cURL = curl_init();
		
		curl_setopt( $this->cURL, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $this->cURL, CURLOPT_HEADER, false );
		curl_setopt( $this->cURL, CURLOPT_FOLLOWLOCATION, true );
	}
	
	/**
	 * Allows you to specify the URL to scrape.
	 * 
	 * @param string $url The URL to be scraped.
	 */
    public function setURL( $url ){
		
		$this->url = $url;
		curl_setopt( $this->cURL, CURLOPT_URL, $this->url );
	}
	
	/**
	 * Retrieves the text contained by the provided selector
	 * from the page being scraped.
	 * 
	 * @param string $selector A CSS-style selector that specifies the target data.
	 * @return string The text data that was found within the tag selected.
	 */
	public function scrape( $selector ){
		
		// check if the HTML was already loaded
		if( !$this->html ){
			$response = curl_exec( $this->cURL );

			$httpCode = curl_getinfo( $this->cURL, CURLINFO_HTTP_CODE );

			if( $httpCode == 200 ){

				require_once( GANON_LOCATION );

				// server responded with a page, everything went OK
				$this->html = str_get_dom( $response );

			} else {
				// there was an HTTP error
				trigger_error( "PageScraper: The remote server responded
								  with an HTTP error code $httpCode.",
							   E_USER_ERROR );
				return false;
			}
		}
		
		$html = $this->html;
		
		if( $html( $selector, 0 ) ){
			$data = $html( $selector, 0 )->getPlainText();
		} else {
			trigger_error( "PageScraper: There was nothing found with 
								the selector '$selector'.",
						    E_USER_ERROR );
			$data = false;
		}
		
		return $data;
	}
    
    public function scrapeAll( $selector ){
		
		// check if the HTML was already loaded
		if( !$this->html ){
			$response = curl_exec( $this->cURL );

			$httpCode = curl_getinfo( $this->cURL, CURLINFO_HTTP_CODE );

			if( $httpCode == 200 ){

				require_once( GANON_LOCATION );

				// server responded with a page, everything went OK
				$this->html = str_get_dom( $response );

			} else {
				// there was an HTTP error
				trigger_error( "PageScraper: The remote server responded
								  with an HTTP error code $httpCode.",
							   E_USER_ERROR );
				return false;
			}
		}
		
		$html = $this->html;
		
		return $html( $selector );
	}
	
	/**
	 * Frees up the resources used by cURL.
	 * 
	 * @destructor
	 */
	
	function __destruct(){
		curl_close( $this->cURL );
	}
	
}