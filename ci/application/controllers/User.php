<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Campaign_model");
		$this->load->model("User_model");
		$this->load->model("Auth_model");
		$this->load->model("Payment_model");
		$this->load->library('form_validation');
		if ($this->Auth_model->_queryGetSession()['user_role_id'] == 1) {
			redirect('admin');
		}
	}

	public function profileAPI()
	{
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['balance'] = $this->User_model->_queryGetBalance($this->Auth_model->_queryGetSession()['id']);
		echo json_encode($data);
	}


	public function profile()
	{
		$data['title'] = 'user | profile';
		$data['user'] = $this->Auth_model->_queryGetSession();
		if ($data['user'] != null) {
			$this->load->view('components/header', $data);
			$this->load->view('components/nav', $data);
			$this->load->view('user/profile', $data);
			$this->load->view('components/footer');
		} else {
			// login habis
			redirect('home');
		}
	}

	public function topUp()
	{
		$data['title'] = 'user | top up';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['payments'] = $this->Payment_model->_queryGetPayments();
//		echo json_encode($data);
//		die();
		if ($data['user'] != null) {
			$this->load->view('components/header', $data);
			$this->load->view('components/nav', $data);
			$this->load->view('user/top_up', $data);
			$this->load->view('components/footer');
		} else {
			redirect('home');
		}
	}

	public function topUpAction()
	{
		$data['user'] = $this->Auth_model->_queryGetSession();
		if ($data['user'] != null) {
			$this->User_model->_queryCreateTopUp();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Top Up Successfully</div>');
			redirect('/user/profile');
		} else {
			redirect('home');
		}
	}

	public function debitCampaignAction($id)
	{
		$data['user'] = $this->Auth_model->_queryGetSession();
		if ($data['user'] != null) {
			$this->User_model->_queryCreateDebit($id);
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Donate Successfully</div>');
			redirect('/user/profile');
		} else {
			redirect('home');
		}
	}

	public function myCampaigns()
	{
		$data['title'] = 'user | my campaigns';
		$data['create_campaign'] = true;
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['campaigns'] = $this->Campaign_model->_queryGetCampaignsByUser($this->Auth_model->_queryGetSession()['id']);
		if ($data['user'] != null) {
//			$this->load->view('user/my_campaigns', $data);
//			echo json_encode($data);
//			die();
			$this->load->view('components/header', $data);
			$this->load->view('components/nav', $data);
			$this->load->view('home/index', $data);
			$this->load->view('components/footer');
		} else {
			// login habis
			redirect('home');
		}
	}

	public function myCampaignBy($campaign_id)
	{
		$data['title'] = 'user | detail campaign';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['campaign'] = $this->Campaign_model->_queryGetCampaignBy($campaign_id);
		$data['donors'] = $this->Campaign_model->_queryGetDonorsCampaignBy($campaign_id);
		if ($data['user'] != null) {
			$this->load->view('components/header', $data);
			$this->load->view('components/nav', $data);
			$this->load->view('home/detail_campaign', $data);
			$this->load->view('components/footer');

		} else {
			// login habis
			redirect('home');
		}
	}

	public function createCampaign()
	{
		$data['title'] = 'user | create campaign';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['campaign'] = null;
		if ($data['user'] != null) {
//			echo json_encode($data);
//			die();
			$this->load->view('components/header', $data);
			$this->load->view('components/nav', $data);
			$this->load->view('user/form_campaign', $data);
			$this->load->view('components/footer');
		} else {
			redirect('home');
		}
	}

	public function createCampaignAction()
	{
		$data['user'] = $this->Auth_model->_queryGetSession();
		if ($data['user'] != null) {
			$this->Campaign_model->_queryCreateCampaign($this->Auth_model->_queryGetSession()['id']);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Created Successfully</div>');
			redirect('/user/myCampaigns');
		} else {
			redirect('home');
		}
	}

	public function editCampaign($campaign_id)
	{
		$data['title'] = 'user | edit campaign';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['campaign'] = $this->Campaign_model->_queryGetDetailCampaign($this->Auth_model->_queryGetSession()['id'], $campaign_id);
		if ($data['user'] != null) {
//			echo json_encode($data);
//			die();
			$this->load->view('components/header', $data);
			$this->load->view('components/nav', $data);
			$this->load->view('user/form_campaign', $data);
			$this->load->view('components/footer');
		} else {
			redirect('home');
		}
	}

	public function editCampaignAction()
	{
		if (new DateTime() > new DateTime($this->input->post('inputDate'))) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cannot edit campaign in Past</div>');
			redirect('user/myCampaigns');
		}
		$data['user'] = $this->Auth_model->_queryGetSession();

		$this->form_validation->set_rules('inputTitle', 'Title', 'required|trim');
		$this->form_validation->set_rules('inputBody', 'Body', 'required|trim');
		$this->form_validation->set_rules('inputTarget', 'Target', 'required|trim');
		$this->form_validation->set_rules('inputDate', 'Date', 'required|trim');

		if ($this->form_validation->run() != false) {
			if ($data['user'] != null) {
				$this->Campaign_model->_queryUpdateCampaign(empty($_FILES['inputThumbnail']['name']));
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edited Successfully</div>');
				redirect('/user/myCampaigns');
			} else {
				redirect('home');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to updates</div>');
			$url = '/user/editCampaign/' . $this->input->post('inputCampaignID');
			redirect($url);
		}

	}

	public function deleteCampaignAction($campaign_id)
	{
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['campaign'] = $this->Campaign_model->_queryGetDetailCampaign($data['user']['id'], $campaign_id);
		if ($data['user'] != null) {
			$this->Campaign_model->_queryDeleteCampaign($data['campaign']['id']);
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Deleted Successfully</div>');
			redirect('user/myCampaigns');
		} else {
			redirect('home');
		}
	}

	public function editProfile()
	{
		$data['title'] = 'user | edit profile';
		$data['user'] = $this->Auth_model->_queryGetSession();
		if ($data['user'] != null) {
			$this->load->view('components/header', $data);
			$this->load->view('components/nav', $data);
			$this->load->view('user/form_profile', $data);
			$this->load->view('components/footer');
		} else {
			redirect('home');
		}
	}

	public function editProfileAction()
	{
		$this->form_validation->set_rules('inputName', 'Name', 'required|trim');
		$this->form_validation->set_rules('inputEmail', 'Email', 'required|trim');
		$this->form_validation->set_rules('inputPhone', 'Phone', 'required|trim');
		$updateWithPass = false;
		if ($this->input->post('passInput1') != null && $this->input->post('passInput2') != null) {
			$this->form_validation->set_rules('passInput1', 'Password', 'required|trim|min_length[3]|matches[passInput2]');
			$this->form_validation->set_rules('passInput2', 'Confirm Password', 'required|trim|matches[passInput1]');
			$updateWithPass = true;
		}

		$data['user'] = $this->Auth_model->_queryGetSession();
		if ($this->form_validation->run() != false) {
//			echo json_encode('berhasil');
//			die();
			if ($data['user'] != null) {
				$this->User_model->_queryUpdateProfile($updateWithPass);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edited Successfully</div>');
				redirect('/user/profile');
			} else {
				redirect('home');
			}
		} else {
//			echo json_encode($this->form_validation->run());
//			die();
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Update Profile failed</div>');
			redirect('/user/editProfile');
		}
	}

	public function invoice()
	{
		$data['title'] = 'user | invoice';
		$data['user'] = $this->Auth_model->_queryGetSession();
		if ($data['user'] != null) {
			$data['debits'] = $this->User_model->_queryGetInvoices($data['user']['id'], true);
			$data['topups'] = $this->User_model->_queryGetInvoices($data['user']['id'], false);
			$this->load->view('components/header', $data);
			$this->load->view('components/nav', $data);
			$this->load->view('user/invoice', $data);
			$this->load->view('components/footer');
		} else {
			redirect('home');
		}
	}

	public function logOut()
	{
		$this->Auth_model->logout();
		redirect('home');
	}
}
