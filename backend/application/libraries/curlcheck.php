<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Curlcheck
{
	function getmeta($contents)
	{
		$result = false;
		$title = null;
		$metaTags = null;
		preg_match('/<title>([^>]*)<\/title>/si', $contents, $match );
		
		if(isset($match) && is_array($match) && count($match) > 0)
		{
			$title = strip_tags($match[1]);
		}
		preg_match_all('/<[\s]*meta[\s]*name="?' . '([^>"]*)"?[\s]*' . 'content="?([^>"]*)"?[\s]*[\/]?[\s]*>/si', $contents, $match);	

		if (isset($match) && is_array($match) && count($match) == 3)
		{
			$originals = $match[0];
			$names = $match[1];
			$values = $match[2];
			if (count($originals) == count($names) && count($names) == count($values))
			{
				$metaTags = array();
				for ($i=0, $limiti=count($names); $i < $limiti; $i++) 
				{
					$metaTags[strtolower($names[$i])] = array (
														'html' => htmlentities($originals[$i]),
														'value' => $values[$i]
														);
				}
			}
		}
		 
		$result = array (
		   'title' => $title,
		   'metaTags' => $metaTags
		);
	 
		return($result);
	}



	/* This function validates the url and checks if its of the right form*/
	function validate_url($url)
	{
		// SCHEME
		$urlregex = "~^(https?|ftp)\:\/\/";
			
		// USER AND PASS (optional)
		$urlregex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";
			
		// HOSTNAME OR IP
		//$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*"; // http://x = allowed (ex. http://localhost, http://routerlogin)
		$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)+"; // http://x.x = minimum
		//$urlregex .= "([a-z0-9+\$_-]+\.)*[a-z0-9+\$_-]{2,3}"; // http://x.xx(x) = minimum
		//use only one of the above
			
		// PORT (optional)
		$urlregex .= "(\:[0-9]{2,5})?";
		// PATH (optional)
		$urlregex .= "(\/([a-z0-9+\$,_.+!*'()-]\.?)+)*\/?";//$-_.+!*'(), valid special characters as per RFC 1738
		// GET Query (optional)
		$urlregex .= "(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?";
		// ANCHOR (optional)
		$urlregex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?$~i";
			
		// check
		if (preg_match($urlregex, $url))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function page_exists($url)
	{
	 
		$parts=parse_url($url);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		 
		/* set the user agent - might help, doesn't hurt */
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		 
		/* try to follow redirects */
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		 
		/* timeout after the specified number of seconds. assuming that this script runs 
		on a server, 20 seconds should be plenty of time to verify a valid URL.  */
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		 
		  
		//curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		 
		/* handle HTTPS links */
		if($parts['scheme']=='https')
		{
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		}
		 
		$response = curl_exec($ch);
		
		curl_close($ch);
		 
		/*  get the status code from HTTP headers */
		if(preg_match_all('/HTTP\/1\.\d+\s+(\d+)/', $response, $matches))
		{
			$r=sizeof($matches);
			$c=sizeof($matches[0]);
			$code=intval($matches[$r-1][$c-1]);

			/* see if code indicates success */
			if(($code>=200) && ($code<400))
			{
				$tags=$this->getmeta($response);
				return($tags);	  
			}
			else
			{
				return false;
			}
		} 
		else
		{
			return false;
		}
	}
}
?>
