<?php

class tx_t3notesnews_cabagphpproxy {
	function processCurlAdditionalPostParams($postParams) {
		//print_r($postParams);
		return $postParams;
	}
	
	function processCurladditionalURLPart($additionalURLPart) {
		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['t3notes_news']);
		$newsValidFileExtension = explode(',',$this->extConf['newsValidFileExtension']);
		
		// get the path info to select the filename
		$pathinfo = pathinfo($additionalURLPart);
		
		// check if this is a path to a file and if the file is in the valid file types list
		if(!empty($pathinfo['extension']) && (array_search($pathinfo['extension'], $newsValidFileExtension) !== false)) {
			// return the path again and encode the filename only
			return $pathinfo['dirname'].'/'.rawurlencode($pathinfo['basename']);
		} else {
			return $additionalURLPart;
		}
	}
	
	function processCurlResource($curlResource) {
		//print_r($curlResource);
		$tx_t3notes_auth = t3lib_div::makeInstance('tx_t3notes_auth');
		
		// add cookie information
		$this->cookie = $tx_t3notes_auth->getRequestCOOKIE();
		curl_setopt($curlResource, CURLOPT_COOKIE, $this->cookie);
		
		return $curlResource;
	}
	
	function processData($data,$dataAdditionalInfos) {
		if((stristr($dataAdditionalInfos['content_type'], 'application') === false)) {
			// get list of HTML attributes to replace from extension configuration
			$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['t3notes_news']);
			$newsDetailReplaceList = explode(',',$this->extConf['newsDetailReplaceList']);
			foreach($newsDetailReplaceList as $search) {
				$data = preg_replace_callback('/('.$search.')([^"]*)(")/is', "tx_t3notesnews_cabagphpproxy::encode", $data);
			}
		}
		
		return $data;
	}
	
	static function encode($matches) {
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['t3notes_news']);
		if(substr($matches[2],0,8) === 'notes://' || substr($matches[2],0,7) === 'http://' || substr($matches[2],0,8) === 'https://') {
			// don't change anything with the notes:// links, they're already fine
			return  $matches[1].$matches[2].$matches[3];
		} else {
			// encode the matched link and add the base url configured in the ext emconf
			//$matches[2] = rawurldecode($matches[2]);
			//$matches[2] = $matches[2];
			$matches[2] = str_replace('%20',' ',$matches[2]);
			//echo $matches[2];
			return  $matches[1].$extConf['newsDetailBaseUrl'].rawurlencode($matches[2]).$matches[3];
			//return  $matches[1].$matches[2].$matches[3];
		}
	}
}

?>
