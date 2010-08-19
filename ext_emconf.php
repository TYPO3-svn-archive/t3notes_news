<?php

########################################################################
# Extension Manager/Repository config file for ext "t3notes_news".
#
# Auto generated 19-08-2010 15:35
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Lotus Notes News',
	'description' => 'Shows news which are provided by a Lotus Notes server.',
	'category' => 'plugin',
	'author' => 'Sonja Scholz',
	'author_email' => 'ss@cabag.ch',
	'author_company' => 'cab services ag',
	'shy' => '',
	'dependencies' => 'cms,extbase,fluid,extbase_pager',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.0.5',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '',
			'fluid' => '',
			'extbase_pager' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:16:{s:9:"ChangeLog";s:4:"e91e";s:21:"ext_conf_template.txt";s:4:"ee99";s:12:"ext_icon.gif";s:4:"6262";s:17:"ext_localconf.php";s:4:"deb2";s:14:"ext_tables.php";s:4:"1fb7";s:14:"ext_tables.sql";s:4:"68b3";s:16:"kickstarter.json";s:4:"b39a";s:37:"Classes/Controller/NewsController.php";s:4:"9b1d";s:41:"Configuration/FlexForms/flexform_news.xml";s:4:"b2e4";s:25:"Configuration/TCA/tca.php";s:4:"eb44";s:34:"Configuration/TypoScript/setup.txt";s:4:"a2e5";s:40:"Resources/Private/Language/locallang.xml";s:4:"f513";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"4cd9";s:42:"Resources/Private/Templates/News/list.html";s:4:"f3a0";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:44:"hooks/class.tx_t3notesnews_cabagphpproxy.php";s:4:"d00f";}',
);

?>