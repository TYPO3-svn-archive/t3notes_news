<?php

class tx_t3notesnews_cabagphpproxy {
	function processCurlAdditionalPostParams($postParams) {
		return $postParams;
	}
	
	function processCurlResource($curlResource) {
		
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
			return  $matches[1].$extConf['newsDetailBaseUrl'].urlencode($matches[2]).$matches[3];
		}
	}
}

?>
