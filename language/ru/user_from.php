<?php
/**
*
* @package phpBB Extension - Search User From
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
	'USER_FROM'				=> 'Откуда',
	'USER_FROM_EXPLAIN'		=> 'Вы можете задавать несколько аргументов поиска, разделив их пробелами, например указать: <strong>rig* риг*</strong>. Используйте * в качестве шаблона. Обратите внимание, что можно использовать такие шаблоны, как например <strong>*пляв*</strong>. Обратите внимание на то, что поиск по аргументам <strong>*пляв, пляв* и *пляв*</strong>, выдаст различные результаты.',
));
