<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Campaign_model");
		$this->load->model("User_model");
		$this->load->model("Auth_model");
		if ($this->Auth_model->_queryGetSession() != null) {
			if ($this->Auth_model->_queryGetSession()['user_role_id'] == 1) {
				redirect('admin');
			}
		}
	}

	public function index()
	{
		$data['title'] = "home | campaigns";
		$data['create_campaign'] = false;
		$data['campaigns'] = $this->Campaign_model->_queryGetCampaigns();
		$data['user'] = $this->Auth_model->_queryGetSession();
//		echo json_encode($data);
//		die();
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('home/index', $data);
		$this->load->view('components/footer');
	}

	public function campaign($id)
	{
		$data['title'] = "campaign | detail campaign";
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['campaign'] = $this->Campaign_model->_queryGetCampaignBy($id);
		$data['donors'] = $this->Campaign_model->_queryGetDonorsCampaignBy($id);
//		echo json_encode($data);
//		die();
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('home/detail_campaign', $data);
		$this->load->view('components/footer');
	}

	public function donateToCampaign($id)
	{
		$data['user'] = $this->Auth_model->_queryGetSession();
		if ($data['user'] == null) {
			redirect('auth/login');
		}
		if ($this->Auth_model->_queryGetSession()['id'] == $this->Campaign_model->_queryGetCampaignBy($id)['user_id']) {
			$url = 'home/campaign/' . $id;
			redirect($url);
		}
		$data['title'] = "home | donate";
		$data['campaign'] = $this->Campaign_model->_queryGetCampaignBy($id);
//		echo json_encode($data);
//		die();
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('home/donate_campaign', $data);
		$this->load->view('components/footer');
	}

	public function donateToCampaignAction($id)
	{
		$this->User_model->_queryCreateDebit($id);
		redirect('user/profile');
	}
}
