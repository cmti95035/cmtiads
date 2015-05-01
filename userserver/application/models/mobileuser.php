<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Mobileuser
 *
 * This model represents mobile user data. It operates the following tables:
 * - md_mobile_users
 *
 * @package	Q
 * @author	Qingfeng Huang
 */
class Mobileuser extends CI_Model
{
	private $table_name			= 'md_mobile_users';			// user 

	function __construct()
	{
		parent::__construct();

	}
	function get_all_by_phonenumber($phonenumber)
	{
		$this->db->where('phone', $phonenumber);
		return $this->db->get($this->table_name);
	}
}
?>
