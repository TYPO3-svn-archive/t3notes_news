<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Sonja Scholz <ss@cabag.ch>, cab services ag
*  			
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Controller for the News object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

class Tx_T3notesNews_Controller_NewsController extends Tx_Extbase_MVC_Controller_ActionController {
	private $tx_t3notes_auth;
	
	/**
	 * index action
	 *
	 * @param int $page The page variable.
	 * @return string The rendered index action
	 */
	public function listAction($page = 1) {
		// Instanciate a singleton tx_t3notes_auth object - singleton handled by TYPO3
		$tx_t3notes_auth = t3lib_div::makeInstance('tx_t3notes_auth');
		
		$curlParamter = array();
		$url = $this->settings['newsRequestURL'];
		
		$curlResult = $tx_t3notes_auth->request($url,$curlParamter,2);
		
		$dataArray = t3lib_div::xml2tree($curlResult);
		
		if(is_array($dataArray)) {
			$dataArray = $dataArray['news'][0]['ch']['newsentry'];
			
			$finalArray = array();
			foreach($dataArray as $key => $currentArray) {
				if(!empty($currentArray['ch']['PhotoPreviewURL'][0]['values'][0]) && strlen($currentArray['ch']['PhotoPreviewURL'][0]['values'][0]) > 3) {
					$currentArray['photoAvailable'] = true;
					$currentArray['PhotoPreviewURL'] = $currentArray['ch']['PhotoPreviewURL'][0]['values'][0];
				}
				
				$currentArray['Publikation'] = $currentArray['ch']['Publikation'][0]['values'][0];
				$currentArray['Titel'] = $currentArray['ch']['Titel'][0]['values'][0];
				$currentArray['Teaser'] = $currentArray['ch']['Teaser'][0]['values'][0];
				$currentArray['DocURL'] = trim($currentArray['ch']['DocURL'][0]['values'][0]);
				$currentArray['DocURL'] = urlencode($currentArray['DocURL']);
				
				$finalArray[$key] = $currentArray;
			}
			
			$lastPage = Tx_ExtbasePager_Utility_Pager::prepareArray($finalArray, $page, 10);
			
			$this->view->assign('dataArray', $finalArray);
			$this->view->assign('lastPage', $lastPage);
			
			
			try {
				$this->view->render();
			}catch(Exception $e) {
				print_r($e->getMessage());
			}
		}
	}
}
?>
