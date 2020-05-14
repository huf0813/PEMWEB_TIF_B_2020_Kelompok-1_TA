<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function _queryGetSession()
	{
		$this->db->where(array('email' => $this->session->userdata('userEmail')));
		$this->db->where('is_suspended_by_admin is null');
		$query = $this->db->get('users');
		return $query->row_array();
	}

	public function _queryLogin($user_login_email)
	{
		$this->db->where(array('email' => $user_login_email));
		$this->db->where('is_suspended_by_admin is null');
		$query = $this->db->get('users');
		return $query->row_array();
	}

	public function _queryCreateUser()
	{
		$data = array(
			'name' => $this->input->post('nameInput'),
			'email' => $this->input->post('emailInput'),
			'phone' => '0',
			'password' => md5($this->input->post('passInput1')),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
			'user_role_id' => 2,
		);
		$this->db->insert('users', $data);
	}

	public function logOut()
	{
		$this->session->unset_userdata('userEmail');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">See You</div>');
	}
}
