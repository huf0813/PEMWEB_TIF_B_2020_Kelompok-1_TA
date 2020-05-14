<?php defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
	public function _queryGetPayments()
	{
		return $this->db->get('payments')->result();
	}

	public function _queryGetPaymentBy($id)
	{
		$this->db->where(array('id' => $id));
		return $this->db->get('payments')->row_array();
	}

	public function _queryCreatePayment()
	{
		$data = array(
			'bank' => $this->input->post('inputBank'),
			'number' => $this->input->post('inputNumber'),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->insert('payments', $data);
	}

	public function _queryUpdatePayment($id)
	{
		$data = array(
			'bank' => $this->input->post('inputBank'),
			'number' => $this->input->post('inputNumber'),
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->where(array('id' => $id));
		$this->db->update('payments', $data);
	}

	public function _queryDeletePayment($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('payments');
	}
}
