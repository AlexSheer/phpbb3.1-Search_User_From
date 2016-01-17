<?php
/**
*
* @package phpBB Extension - Search User From
* @copyright (c) 2015 Sheer
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace sheer\search_user_from\migrations;

class search_user_from_1_0_1 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['search_user_from_version']) && version_compare($this->config['search_user_from_version'], '1.0.1', '>=');
	}

	static public function depends_on()
	{
		return array('\sheer\search_user_from\migrations\search_user_from_1_0_0');
	}

	public function update_schema()
	{
		return array(
		);
	}

	public function revert_schema()
	{
		return array(
		);
	}

	public function update_data()
	{
		return array(
			// Current version
			array('config.update', array('search_user_from_version', '1.0.1')),
		);
	}
}
