<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mobileuserinfo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mobileuser');
		$this->load->dbutil();
	}

	function index()
	{
		
	}
	function xml($phonenumber){
	   $result=$this->mobileuser->get_all_by_phonenumber($phonenumber);
	   $config = array (
	   		'root'    => 'root',
	   		'element' => 'element',
	   		'newline' => "\n",
	   		'tab'    => "\t"
	   );
	   echo $this->dbutil->xml_from_result($result, $config);
	}
	function json($phonenumber){
		$result=$this->mobileuser->get_all_by_phonenumber($phonenumber);
		$ra=$result->result_array();
		echo json_encode($ra[0]);
	}
	
	function adduser($phonenumber, $gender_id=2){
		if($this->mobileuser->add_user($phonenumber, $gender_id)){
		   echo 1;	
		}else{
		   echo 0;
		}
	}
	function changeuser($phonenumber, $gender_id=2){
		if($this->mobileuser->change_user($phonenumber, $gender_id)){
			echo 1;
		}else{
			echo 0;
		}
	}
}
?>