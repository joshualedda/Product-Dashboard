<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reviews extends CI_Controller
{

	public function create()
	{
		$user_id = $this->session->userdata('id');
		if (!$user_id) {
			$this->session->set_flashdata('error_message', 'You need to login first');
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
	
		$result = $this->Review->insertReview();
	
		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Review Posted');
		} else {
			$this->session->set_flashdata('error_message', $result['error']);
		}
	
		redirect($_SERVER['HTTP_REFERER']);
	}
	
}
