<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LibraryModel extends CI_Model{
	public function __construct() {
		parent::__construct();
	}

	public function getData($key){
		$id_user = $this->db->get_where('users', ['key' => $key])->row()->id;
		$result = $this->db->select('id, id_manga')->from('library')->where('id_user', $id_user)->get()->result_array();
		return $result;
	}

	public function addData($key, $id_manga)
	{
		$id_user = $this->db->get_where('users', ['key' => $key])->row()->id;
		$data = array(
			'id_user' => $id_user,
			'id_manga' => $id_manga
		);
		$this->db->insert('library', $data);
		return $this->db->affected_rows();
	}

	public function deleteData($key, $id_manga)
	{
		$id_user = $this->db->get_where('users', ['key' => $key])->row()->id;
		$this->db->delete('library', ['id_user' => $id_user, 'id' => $id_manga]);
		return $this->db->affected_rows();
	}
}
