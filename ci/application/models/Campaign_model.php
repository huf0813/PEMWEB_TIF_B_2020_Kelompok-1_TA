<?php defined('BASEPATH') or exit('No direct script access allowed');

class Campaign_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url', 'form');
	}

	public function _queryGetCampaigns()
	{
		$this->db->select('title, thumbnail, target, name, campaigns.id, campaigns.finish_at');
		$this->db->select('(select sum(balance) from debits where debits.campaign_id = campaigns.id) as collected');
		$this->db->join('users', 'campaigns.user_id = users.id');
		return $this->db->get('campaigns')->result();
	}

	public function _queryGetCampaignBy($id)
	{
		$this->db->select('finish_at, title, body, thumbnail, target, name, campaigns.id, campaigns.user_id');
		$this->db->select('(select sum(balance) from debits where debits.campaign_id = campaigns.id) as collected');
		$this->db->join('users', 'campaigns.user_id = users.id');
		$this->db->where(array('campaigns.id' => $id));
		return $this->db->get('campaigns')->row_array();
	}

	public function _queryGetDonorsCampaignBy($campaign_id)
	{
		$this->db->select('*');
		$this->db->join('users', 'debits.user_id = users.id');
		$this->db->where(array('campaign_id' => $campaign_id));
		return $this->db->get('debits')->result();
	}

	public function _queryGetDetailCampaign($user_id, $campaign_id)
	{
		$this->db->select('user_id, id, finish_at, title, thumbnail, body, target, created_at, updated_at, (select sum(balance) from debits where debits.campaign_id = campaigns.id) as collected');
		$this->db->where(array('user_id' => $user_id));
		$this->db->where(array('id' => $campaign_id));
		return $this->db->get('campaigns')->row_array();
	}

	public function _queryGetCampaignsByUser($id)
	{
		$this->db->select('title, thumbnail, target, name, finish_at, campaigns.id');
		$this->db->select('(select sum(balance) from debits where debits.campaign_id = campaigns.id) as collected');
		$this->db->join('users', 'campaigns.user_id = users.id');
		$this->db->where(array('user_id' => $id));
		return $this->db->get('campaigns')->result();
	}

	private function _uploadImg($unique)
	{
		$config['upload_path'] = './img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $unique;
		$config['overwrite'] = true;
		$config['max_size'] = 1024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('inputThumbnail')) {
			return $this->upload->data("file_name");
		}
		return "default.png";
	}

	private function _destoryImg($id)
	{
		$campaign = $this->_queryGetCampaignBy($id);
		if ($campaign['thumbnail'] != "default.png") {
			$filename = explode(".", $campaign['thumbnail'])[0];
			return array_map('unlink', glob(FCPATH . "img/$filename.*"));
		}
	}

	public function _queryCreateCampaign($user_id_login)
	{
		if (new DateTime() > new DateTime($this->input->post('inputDate'))) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cannot create campaign in Past</div>');
			redirect('user/myCampaigns');
		}
//		echo json_encode($this->_uploadImg($this->input->post('inputUniqueID')));
//		die();
		$data = array(
			'user_id' => $user_id_login,
			'title' => $this->input->post('inputTitle'),
			'thumbnail' => $this->_uploadImg($this->input->post('inputUniqueID')),
			'body' => $this->input->post('inputBody'),
			'target' => $this->input->post('inputTarget'),
			'finish_at' => $this->input->post('inputDate'),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);
		$this->db->insert('campaigns', $data);
	}

	public function _queryUpdateCampaign($withoutImage)
	{
		if ($withoutImage) {
//			echo json_encode('here');
//			die();
			$data = array(
				'title' => $this->input->post('inputTitle'),
				'body' => $this->input->post('inputBody'),
				'target' => $this->input->post('inputTarget'),
				'updated_at' => date("Y-m-d H:i:s"),
			);
		} else {
//			echo json_encode('here 2');
//			die();
			$this->_destoryImg($this->input->post('inputCampaignID'));
			$data = array(
				'title' => $this->input->post('inputTitle'),
				'body' => $this->input->post('inputBody'),
				'target' => $this->input->post('inputTarget'),
				'thumbnail' => $this->_uploadImg($this->input->post('inputUniqueID')),
				'updated_at' => date("Y-m-d H:i:s"),
			);
		}
		$this->db->where(array('user_id' => $this->input->post('inputUserID')));
		$this->db->where(array('id' => $this->input->post('inputCampaignID')));
		$this->db->update('campaigns', $data);
	}

	public function _queryDeleteCampaign($id)
	{
		$this->_destoryImg($id);
		$this->db->where('id', $id);
		$this->db->delete('campaigns');
	}
}
