<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Lotus Notes News'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Lotus Notes News');

$pluginSignature = strtolower(t3lib_div::underscoredToUpperCamelCase($_EXTKEY));

$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature. '_pi1'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_news.xml');


$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature.'_pi1'] = 'layout,select_key,pages';


?>