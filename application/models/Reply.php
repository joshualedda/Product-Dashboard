<?php

class Reply extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}


	public function insertReply()
	{

		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('review_id', 'Review', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			return array('success' => false, 'error' => validation_errors());
		} else {
			$content = $this->input->post('content');
			$review_id = $this->input->post('review_id');
			$user_id = $this->session->userdata('id');

			$sql = "INSERT INTO replies (review_id, user_id, content) VALUES (?, ?,?)";

			$query = $this->db->query($sql, array($review_id, $user_id, $content));


			if ($query) {
				return array('success' => true);
			} else {
				return array('success' => false, 'error' => 'Error inserting review.');
			}
		}
	}


	public function getReplies($review_id)
	{
		$sql = 'SELECT replies.*, users.first_name, users.last_name
            FROM replies 
            LEFT JOIN users
            ON users.id = replies.user_id
            WHERE review_id = ?
            ORDER BY replies.created_at DESC';

		$query = $this->db->query($sql, array($review_id));
		return $query->result_array();
	}

}
