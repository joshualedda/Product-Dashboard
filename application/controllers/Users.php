<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('products');
		}

		$data['title'] = "Login";

		$this->load->view('partials/header', $data);
		$this->load->view('partials/alert');
		$this->load->view('auth/login');
		$this->load->view('partials/footer');
	}

	public function register()
	{
		$data['title'] = "Register";
		$this->load->view('partials/header', $data);
		$this->load->view('partials/alert');
		$this->load->view('auth/register');
		$this->load->view('partials/footer');
	}

	public function registerProcess()
	{

		$result = $this->User->registerUser();


		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Registered Succesfully');
			redirect('register');
		} else {
			$data['error_message'] = $result['error'];
			$this->register();
		}
	}

	public function check_email($email)
	{
		$this->load->model('User');
		if ($this->User->is_email_exists($email)) {
			$this->form_validation->set_message('check_email', 'The email already exists.');
			return false;
		}
		return true;
	}

	public function loginProcess()
{
    $result = $this->User->loginUser(); 

    if ($result['success']) { 
        $user = $result['user']; 

        $user_data = array(
            'id' => $user['id'],
            'email' => $user['email'],
            'logged_in' => true
        );

        $this->session->set_userdata($user_data); 

        if ($user['role'] == 0) {
            redirect('dashboard');
        } elseif ($user['role'] == 1) {
            redirect('dashboard/admin');
        }
    } else {
        $data['error_message'] = $result['error'];
		$this->session->set_flashdata('error_message', 'Invalid Crediantials.');

        $this->index();
    }
}


	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		$this->session->set_flashdata('success', 'Logged out successfully.');
		redirect('users');
	}
}
