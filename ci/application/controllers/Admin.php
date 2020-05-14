<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Auth_model");
		$this->load->model("Campaign_model");
		$this->load->model("User_model");
		if ($this->Auth_model->_queryGetSession()['user_role_id'] == 2 or $this->Auth_model->_queryGetSession() == null) {
			redirect('home');
		}
	}

	public function index()
	{
		$data['title'] = 'admin | dashboard';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('admin/index');
		$this->load->view('components/footer');
	}

	public function users()
	{
		$data['title'] = 'admin | users';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['users'] = $this->User_model->_queryGetUsers();
		$data['is_suspended'] = 0;
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('components/footer');
	}

	public function suspendUserAction($id)
	{
		$this->User_model->_queryUpdateSuspendUser($id);
		redirect('admin/suspendUsers');
	}

	public function campaigns()
	{
		$data['title'] = 'admin | campaigns';
		$data['create_campaign'] = false;
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['campaigns'] = $this->Campaign_model->_queryGetCampaigns();
//		echo json_encode($data);
//		die();
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('home/index', $data);
		$this->load->view('components/footer');
	}

	public function campaignBy($campaign_id)
	{
		$data['title'] = 'admin | detail campaign';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['campaign'] = $this->Campaign_model->_queryGetCampaignBy($campaign_id);
		$data['donors'] = $this->Campaign_model->_queryGetDonorsCampaignBy($campaign_id);
//		echo json_encode($data);
//		die();
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('home/detail_campaign', $data);
		$this->load->view('components/footer');
	}

	public function suspendUsers()
	{
		$data['title'] = 'admin | suspended users';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['users'] = $this->User_model->_queryGetSuspendedUsers();
		$data['is_suspended'] = 1;
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('components/footer');
	}

	public function payments()
	{
		$data['title'] = 'admin | payments';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['payments'] = $this->Payment_model->_queryGetPayments();
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('admin/payments', $data);
		$this->load->view('components/footer');
	}

	public function createPayment()
	{
		$data['title'] = 'admin | create payment';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['create_payment'] = true;
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('admin/form_payment', $data);
		$this->load->view('components/footer');
	}

	public function createPaymentAction()
	{
		$this->Payment_model->_queryCreatePayment();
		redirect('admin/payments');
	}

	public function editPayment($id)
	{
		$data['title'] = 'admin | edit payment';
		$data['user'] = $this->Auth_model->_queryGetSession();
		$data['create_payment'] = false;
		$data['payment'] = $this->Payment_model->_queryGetPaymentBy($id);
		$this->load->view('components/header', $data);
		$this->load->view('components/nav', $data);
		$this->load->view('admin/form_payment', $data);
		$this->load->view('components/footer');
	}

	public function editPaymentAction($id)
	{
		$this->Payment_model->_queryUpdatePayment($id);
		redirect('admin/payments');
	}

	public function deletePayment($id)
	{
		$this->Payment_model->_queryDeletePayment($id);
		redirect('admin/payments');
	}

	public function unsuspendUserAction($id)
	{
		$this->User_model->_queryUpdateUnsuspendUser($id);
		redirect('admin/users');
	}

	public function deleteCampaign($id)
	{
		$this->Campaign_model->_queryDeleteCampaign($id);
		redirect('admin/campaigns');
	}

	public function logout()
	{
		$this->Auth_model->logout();
		redirect('home');
	}
}
