<?php

class Review extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function insertReview()
	{

		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('product_id', 'Product', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			return array('success' => false, 'error' => validation_errors());
		} else {
			$content = $this->input->post('content');
			$product_id = $this->input->post('product_id');
			$user_id = $this->session->userdata('id');

			$sql = "INSERT INTO reviews (product_id, user_id, content) VALUES (?, ?,?)";

			$query = $this->db->query($sql, array($product_id, $user_id, $content));


			if ($query) {
				return array('success' => true);
			} else {
				return array('success' => false, 'error' => 'Error inserting review.');
			}
		}
	}

	public function getReviews($product_id)
	{
		$sql = 'SELECT reviews.*, users.first_name, users.last_name
				FROM reviews 
				LEFT JOIN users
				ON users.id = reviews.user_id
				WHERE product_id = ?
				ORDER BY reviews.created_at DESC';
	
		$query = $this->db->query($sql, array($product_id));
		return $query->result_array();
	}
	
	

}
