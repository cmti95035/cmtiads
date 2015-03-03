<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Mobileuser
 *
 * This model represents mobile user data. It operates the following tables:
 * - md_mobile_users
 * - md_genders
 *
 * @package	Q
 * @author	Qingfeng Huang
 */
class Mobileuser extends CI_Model
{
	private $table_name			= 'md_mobile_users';			// user 
	private $gender_table_name	= 'md_genders';	// user gender

	function __construct()
	{
		parent::__construct();

	}

	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @return	object
	 */
	function get_user_by_id($user_id)
	{
		$this->db->where('id', $user_id);
		

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @return	object
	 */
	function get_user_by_phonenumber($phonenumber)
	{
		$this->db->where('phone', $phonenumber);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	function get_all_by_phonenumber($phonenumber)
	{
		$this->db->where('phone', $phonenumber);
		return $this->db->get($this->table_name);
	}
}
?>
