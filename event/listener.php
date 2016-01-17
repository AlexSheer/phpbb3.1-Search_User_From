<?php
/**
*
* @package phpBB Extension - Search User From
* @copyright (c) 2015 Sheer
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace sheer\search_user_from\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
/**
* Assign functions defined in this class to event listeners in the core
*
* @return array
* @static
* @access public
*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'									=> 'load_language_on_setup',
			'core.memberlist_modify_sql_query_data'				=> 'memberlist_modify_query',
			'core.memberlist_modify_ip_search_sql_query'		=> 'memberlist_modify_search_ip_query',
		);
	}

	/** @var \phpbb	emplate	emplate */
	protected $template;


	/** @var \phpbb\db\driver\driver_interface $db */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/**
	* Constructor
	*/
	public function __construct(
		\phpbb\template\template $template,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\request\request_interface $request
	)
	{
		$this->template = $template;
		$this->db = $db;
		$this->request = $request;
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'sheer/search_user_from',
			'lang_set' => 'user_from',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function memberlist_modify_query($event)
	{
		$sql_from = $event['sql_from'];
		$sql_where = $event['sql_where'];

		$user_from = $this->request->variable('user_from', '', true);

		$this->template->assign_vars(array(
			'USER_FROM'	=> $user_from,
			)
		);

		if($user_from)
		{
			$sql_from .= ', ' . PROFILE_FIELDS_DATA_TABLE . ' pf ';
			$pieces = explode(' ', $user_from);
			$sql_where .= ' AND (pf.pf_phpbb_location COLLATE utf8_general_ci ';

			$sql_where .= $this->db->sql_like_expression(str_replace('*', $this->db->get_any_char(), $pieces[0]));
			for ($i = 1; $i < sizeof($pieces); $i++)
			{
				$sql_where .= ' OR pf.pf_phpbb_location COLLATE utf8_general_ci ';
				$sql_where .= $this->db->sql_like_expression(str_replace('*', $this->db->get_any_char(), $pieces[$i]));
			}
			$sql_where .= ') AND u.user_id = pf.user_id';

			$event['sql_where'] = $sql_where;
			$event['sql_from'] = $sql_from;
		}
	}

	public function memberlist_modify_search_ip_query($event)
	{
		$sql = $event['sql'];
		$ips = $event['ips'];
		$sql .= 'UNION
					(SELECT user_id
						FROM ' .USERS_TABLE. '
						WHERE user_ip ' . ((strpos($ips, '%') !== false) ? 'LIKE' : 'IN') . ' ('.$ips.')
					)';
		$event['sql'] = $sql;
	}
}
