<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model{
	public function __construct() {
		parent::__construct();
	}

	public function login($email, $uid){
		$this->db->select('email, key');
		$this->db->from('users');
		$this->db->where('email', $email);
		$this->db->where('key', $uid);
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1){
			return $query->result();
		}else{
			return false;
		}
	}

	public function register($email, $uid)
	{
		/*
		* Insert user data into database
		*/
		$data = array(
			'email' => $email,
			'key' => $uid
		);
		$this->db->insert('users', $data);

		/*
		* Check if user data is inserted into database
		*/
		$check = $this->login($email, $uid);
		return $check;
	}
}

