<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Auth_model");
		$this->load->model("Payment_model");
		$this->load->library('form_validation');
	}

	public function _queryGetUsers()
	{
		$this->db->where(array('user_role_id' => 2));
		$this->db->where('is_suspended_by_admin is null');
		return $this->db->get('users')->result();
	}

	public function _queryGetSuspendedUsers()
	{
		$this->db->where(array('user_role_id' => 2));
		$this->db->where('is_suspended_by_admin is not null');
		return $this->db->get('users')->result();
	}

	public function _queryGetSession()
	{
		$this->db->where(array('email' => $this->session->userdata('email')));
		$query = $this->db->get('users');
		return $query->row_array();
	}

	public function _queryGetPayments()
	{
		return $this->db->get('payments')->result();
	}

	public function _queryTopUps($id)
	{
		$this->db->select_sum('balance');
		$this->db->from('topups');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return ($query->row_array()['balance'] == null) ? 0 : $query->row_array()['balance'];
	}

	public function _queryDebits($id)
	{
		$this->db->select_sum('balance');
		$this->db->from('debits');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return ($query->row_array()['balance'] == null) ? 0 : $query->row_array()['balance'];
	}

	public function _queryGetBalance($id)
	{
		return $this->_queryTopUps($id) - $this->_queryDebits($id);
	}

	public function _queryGetInvoices($id, $debits_boolean)
	{
		if ($debits_boolean) {
			$this->db->select('*');
			$this->db->select('(select title from campaigns where campaigns.id=debits.campaign_id) as donate_to');
			$this->db->from('debits');
		} else {
			$this->db->select('*');
			$this->db->select('(select bank from payments where payments.id=topups.payment_id) as payment_provider');
			$this->db->from('topups');
		}
		$this->db->where('user_id', $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function _queryCreateTopUp()
	{
		$data = array(
			'user_id' => $this->Auth_model->_queryGetSession()['id'],
			'payment_id' => $this->input->post('inputPayment'),
			'balance' => $this->input->post('inputBalance'),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->insert('topups', $data);
	}

	public function _queryCreateDebit($id)
	{
		if ($this->Auth_model->_queryGetSession()['id'] == $this->Campaign_model->_queryGetCampaignBy($id)['user_id']) {
			$url = 'home/campaign/' . $id;
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cannot Donate To Yourself</div>');
			redirect($url);
		}
		if (($this->_queryGetBalance($this->Auth_model->_queryGetSession()['id']) - $this->input->post('inputMoney')) < 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Balance isnt enough</div>');
			redirect('user/topUp');
		}
		$data = array(
			'user_id' => $this->Auth_model->_queryGetSession()['id'],
			'campaign_id' => $id,
			'balance' => $this->input->post('inputMoney'),
			'message' => $this->input->post('inputMessage'),
			'anonymous' => ($this->input->post('inputAnon') == null) ? 0 : 1,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->insert('debits', $data);
	}

	public function _queryUpdateProfile($withPass)
	{
		if ($withPass) {
			$data = array(
				'name' => $this->input->post('inputName'),
				'email' => $this->input->post('inputEmail'),
				'phone' => $this->input->post('inputPhone'),
				'password' => md5($this->input->post('passInput1')),
				'updated_at' => date("Y-m-d H:i:s"),
			);
		} else {
			$data = array(
				'name' => $this->input->post('inputName'),
				'email' => $this->input->post('inputEmail'),
				'phone' => $this->input->post('inputPhone'),
				'updated_at' => date("Y-m-d H:i:s"),
			);
		}
		$this->db->where(array('id' => $this->input->post('inputUserID')));
		$this->db->update('users', $data);
	}

	public function _queryUpdateSuspendUser($user_id)
	{
		$data = array(
			'is_suspended_by_admin' => date("Y-m-d H:i:s"),
		);
		$this->db->where(array('id' => $user_id));
		$this->db->update('users', $data);
	}

	public function _queryUpdateUnsuspendUser($user_id)
	{
		$data = array(
			'is_suspended_by_admin' => null,
		);
		$this->db->where(array('id' => $user_id));
		$this->db->update('users', $data);
	}

	public function logOut()
	{
		$this->session->unset_userdata('userEmail');
		$this->session->unset_userdata('user_role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">See You</div>');
	}
}
