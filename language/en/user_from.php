<?php
/**
*
* @package phpBB Extension - Search User From (English)
* @copyright (c) 2015 Sheer
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'USER_FROM'				=> 'From',
	'USER_ID'				=> 'User ID',
	'USER_FROM_EXPLAIN'		=> 'You can specify multiple search arguments, separated by spaces, such as point: <strong>rig* риг*</strong>. Use * as a wildcard. Note that you can use templates such as for example <strong>*lond*</strong>. Please note that the search arguments <strong>*york, york* и *york*</strong>,  will give different results.',
));
