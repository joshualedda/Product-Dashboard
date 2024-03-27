<?php

class User extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	//if email exist
	public function is_email_exists($email)
	{
		$sql = "SELECT COUNT(*) as count FROM users WHERE email = ?";
		$query = $this->db->query($sql, array($email));

		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->count > 0;
		}

		return false;
	}

	//handle login
	public function loginUser()
	{
		$this->form_validation->set_rules('email', 'Contact Number/Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			return array('success' => false, 'error' => validation_errors());
		}

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$email = $this->security->xss_clean($email);
		$password = $this->security->xss_clean($password);

		$sql = "SELECT * FROM users WHERE email = ?";
		$query = $this->db->query($sql, array($email));

		if ($query->num_rows() == 1) {
			$user = $query->row_array();
			$hashed_password = $user['password'];

			if (password_verify($password, $hashed_password)) {
				return array('success' => true, 'user' => $user);
			}
		}

		return array('success' => false, 'error' => 'Invalid email or password.');
	}


	//register
	public function registerUser()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('password_confirmation', 'Confirm Password', 'required|matches[password]');

		if ($this->form_validation->run() == false) {
			return array('success' => false, 'error' => validation_errors());
		}

		// Get user input data
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// passwordhash
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
		$query = $this->db->query($sql, array($first_name, $last_name, $email, $hashed_password));

		if ($query) {
			return array('success' => true);
		} else {
			return array('success' => false, 'error' => 'Error registering user.');
		}
	}

	//dashboard
	public function getUserById($user_id)
	{
		$sql = "SELECT * FROM users WHERE id = ?";

		$query = $this->db->query($sql, array($user_id));

		if ($query->num_rows() == 1) {
			return $query->row_array();
		}

		return null;
	}

	//update user
	public function updateUser()
	{

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');

		if ($this->form_validation->run() == FALSE) {
			return array('success' => false, 'error' => validation_errors());
		} else {
			$id = $this->session->userdata('id');
			$email = $this->input->post('email');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');

			$sql = "UPDATE users SET email = ?, first_name = ?, last_name = ? WHERE id = ?";
			$query = $this->db->query($sql, array($email, $first_name, $last_name, $id));

			if ($this->db->affected_rows() > 0) {
				return array('success' => true);
			} else {
				return array('success' => false, 'error' => 'Error updating profile.');
			}
		}
	}

	//change password
	public function changePassword()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('old_password', 'Old Password', 'required');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

		if ($this->form_validation->run() == FALSE) {
			return array('success' => false, 'error' => validation_errors());
		} else {
			$user_id = $this->session->userdata('id');
			$old_password = $this->input->post('old_password');
			$new_password = $this->input->post('new_password');
			$confirm_password = $this->input->post('confirm_password');

			$user = $this->User->getUserById($user_id);

			if (!$user || !password_verify($old_password, $user['password'])) {
				return array('success' => false, 'error' => 'Incorrect old password.');
			}

			$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
			$data = array('password' => $hashed_password);

			$result = $this->User->updateUser($user_id, $data);

			if ($this->db->affected_rows() > 0) {
				return array('success' => true);
			} else {
				return array('success' => false, 'error' => 'Error updating profile.');
			}
		}
	}
}
