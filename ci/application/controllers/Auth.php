<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
		$this->load->library('form_validation');
	}

	public function login()
	{
		$data['user'] = $this->Auth_model->_queryGetSession();
		$this->form_validation->set_rules('emailInput', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('passInput', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			if ($this->Auth_model->_queryGetSession() == null) {
				$data['title'] = 'Sign In';
				$this->load->view('components/header', $data);
				$this->load->view('components/nav', $data);
				$this->load->view('auth/login_body');
				$this->load->view('components/footer');
			} else {
				if ($this->Auth_model->_queryGetSession()['user_role_id'] == 1) {
					redirect('admin');
				} else {
					redirect('home');
				}
			}
		} else {
			$this->_logIn();
		}
	}

	private function _logIn()
	{
		$user = $this->Auth_model->_queryLogin($this->input->post('emailInput'));
		if ($user != null) {
			if (md5($this->input->post('passInput')) == $user['password']) {
				$this->session->set_userdata('userEmail', $user['email']);
				if ($this->Auth_model->_queryGetSession()['user_role_id'] == 1) {
					redirect('admin');
				} else {
					redirect('home');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sign In Failed. Please Try Again</div>');
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User Is Not Registered</div>');
			redirect('auth/login');
		}
	}

	public function register()
	{
		$data['user'] = $this->Auth_model->_queryGetSession();
		$this->form_validation->set_rules('nameInput', 'Name', 'required|trim');
		$this->form_validation->set_rules('emailInput', 'Email', 'required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('passInput1', 'Password', 'required|trim|min_length[3]|matches[passInput2]');
		$this->form_validation->set_rules('passInput2', 'Confirm Password', 'required|trim|matches[passInput1]');

		if ($this->form_validation->run() == false) {
			if ($this->Auth_model->_queryGetSession() == null) {
				$data['title'] = 'Sign Up';
				$this->load->view('components/header', $data);
				$this->load->view('components/nav', $data);
				$this->load->view('auth/register_body');
				$this->load->view('components/footer');
			} else {
				if ($this->Auth_model->_queryGetSession()['user_role_id'] == 2) {
					redirect('admin');
				} else {
					redirect('home');
				}
			}
		} else {
			$this->Auth_model->_queryCreateUser();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registered Successfully. Please Sign In</div>');
			redirect('auth/login');
		}
	}
}
