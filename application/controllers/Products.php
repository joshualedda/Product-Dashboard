<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Products extends CI_Controller
{
	private function prepareUserData()
	{
		$user_id = $this->session->userdata('id');
		$user_data = $this->User->getUserById($user_id);
		$is_logged_in = $this->session->userdata('logged_in');
		$role = isset ($user_data['role']) ? $user_data['role'] : null;

		return array('user_data' => $user_data, 'is_logged_in' => $is_logged_in, 'role' => $role);
	}



	public function crsf()
	{
		if ($this->input->post($this->security->get_csrf_token_name()) !== $this->security->get_csrf_hash()) {
			$this->session->set_flashdata('error', 'Please login first.');
		}
	}


	public function show($product_id)
	{
		$this->crsf();
	
		$data = $this->prepareUserData();
		$data['product'] = $this->Product->getProductDetails($product_id);
		$data['reviews'] = $this->Review->getReviews($product_id);
	
		//the review id if from the data['reviews]
		foreach ($data['reviews'] as &$review) {
			$review_id = $review['id'];
			$review['replies'] = $this->Reply->getReplies($review_id);
		}
	
		if ($data['product']) {
			$data['title'] = $data['product']['name'];
		} else {
			$data['title'] = 'Product Not Found';
		}
	
		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar', $data);
		$this->load->view('partials/alert');
		$this->load->view('products/details', $data);
		$this->load->view('partials/footer');
	}
	

	public function addProduct()
	{
		$data['title'] = "Add New Product";
		$data = $this->prepareUserData();

		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar', $data);
		$this->load->view('partials/alert');
		$this->load->view('partials/alertjs');
		$this->load->view('products/create');
		$this->load->view('partials/footer');
	}

	public function createProduct()
	{
		if ($this->input->is_ajax_request()) {
			$this->crsf();
	
			$name = $this->input->post('name');
			$description = $this->input->post('description');
			$price = $this->input->post('price');
			$quantity = $this->input->post('quantity');
	
			$result = $this->Product->addProduct($name, $description, $price, $quantity);
	
			if ($result['success']) {
				echo json_encode(['status' => 'success']);
			} else {
				echo json_encode(['status' => 'error', 'message' => $result['error']]);
			}
		} else {
			redirect('products/new');
		}
	}
	

	// editmthod

	public function edit($id)
	{
		$data['title'] = "Edit Product";
		$data = $this->prepareUserData();
		$data['product'] = $this->Product->getProductById($id);


		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar', $data);
		$this->load->view('partials/alertjs', $data);
		$this->load->view('products/edit', $data);
		$this->load->view('partials/footer');
	}

	//update product
	public function updateProduct($id)
	{
		if ($this->input->is_ajax_request()) {
			$this->crsf();

        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $price = $this->input->post('price');
        $quantity = $this->input->post('quantity');

        $result = $this->Product->updateProduct($id, $name, $description, $price, $quantity);

        // Check the result and respond accordingly
        if ($result['success']) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $result['error']]);
        }
    } else {
        // Redirect if it's not an AJAX request
        redirect('dashboard');
    }
}


	public function delete($id)
	{
		$data['title'] = "Edit Product";
		$data = $this->prepareUserData();
		$data['product'] = $this->Product->getProductById($id);


		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar', $data);
		$this->load->view('products/delete', $data);
		$this->load->view('partials/footer');
	}


	public function deleteProduct($id)
	{
		if (!is_numeric($id) || $id <= 0) {
			redirect('products');
		}

		$result = $this->Product->deleteProductById($id);

		if ($result['success']) {
			$this->session->set_flashdata('success_message', 'Product deleted successfully');
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('error_message', $result['error']);
			redirect('dashboard');
		}
	}


}
