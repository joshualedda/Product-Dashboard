<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboards extends CI_Controller
{

	public function index()
	{
		$data = $this->prepareUserData();
		$data['products'] = $this->Product->fetchProducts();


		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar', $data);
		$this->load->view('partials/alert');

		$this->load->view('dashboard/dashboard', $data);
		$this->load->view('partials/footer');
	}
	private function prepareUserData()
	{
		$user_id = $this->session->userdata('id');
		$user_data = $this->User->getUserById($user_id);
		$is_logged_in = $this->session->userdata('logged_in');
		$role = isset($user_data['role']) ? $user_data['role'] : null;

		return array('user_data' => $user_data, 'is_logged_in' => $is_logged_in, 'role' => $role);
	}


	public function profile()
	{

		$data['title'] = "Profile";
		$data = $this->prepareUserData();

		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar', $data);
		$this->load->view('partials/alert');
		$this->load->view('dashboard/profile');
		$this->load->view('partials/footer');
	}


	public function updateProfile()
	{
		$result = $this->User->updateUser();

		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Profile updated successfully');
			redirect('profile');
		} else {
			$data['error_message'] = $result['error'];
			$this->profile();
		}
	}
	public function changePassword()
	{
		$result = $this->User->changePassword();
	
		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Password updated successfully.');
		} else {
			$data['error_message'] = $result['error'];
			$this->profile();
		}
	}
	
	




	
}
