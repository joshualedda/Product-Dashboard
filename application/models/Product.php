<?php

class Product extends CI_Model
{

	public function __construct()
	{
		$this->load->library('form_validation');

		$this->load->database();
	}
	//select product
	public function fetchProducts()
	{
		// Select product data and calculate total quantity sold
		$sql = 'SELECT products.*, 
				COALESCE((SELECT SUM(quantity) FROM orders WHERE orders.product_id = products.id), 0) AS total_sold 
				FROM products';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//fetch singel product
	public function getProductDetails($product_id)
	{
		$sql = "SELECT * FROM products WHERE id = ?";
		$query = $this->db->query($sql, array($product_id));

		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	/*Product Price*/
	public function getProductPrice($product_ids)
	{
		$sql = "SELECT price FROM products WHERE id = ?";
		$query = $this->db->query($sql, array($product_ids));

		if ($query->num_rows() > 0) {
			$row = $query->row();
			return (float) $row->price;
		} else {
			return null;
		}
	}
	//test2
	public function getProductById($product_id)
	{
		$query = $this->db->query("SELECT * FROM products WHERE id = ?", array($product_id));

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	public function addProduct($name, $description, $price, $quantity)
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('quantity', 'Inventory Count', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			return array('success' => false, 'error' => validation_errors());
		} else {
			$name = $this->security->xss_clean($name);
			$description = $this->security->xss_clean($description);
			$price = $this->security->xss_clean($price);
			$quantity = $this->security->xss_clean($quantity);

			$sql = "INSERT INTO products (name, description, price, quantity) VALUES (?, ?, ?, ?)";
			$query = $this->db->query($sql, array($name, $description, $price, $quantity));

			if ($query) {
				$inserted_id = $this->db->insert_id();
				return array('success' => true, 'inserted_id' => $inserted_id);
			} else {
				return array('success' => false, 'error' => 'Error inserting data into database.');
			}
		}
	}


	public function updateProduct($id, $name, $description, $price, $quantity)
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('quantity', 'Inventory Count', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			return array('success' => false, 'error' => validation_errors());
		} else {
			$name = $this->db->escape_str($name);
			$description = $this->db->escape_str($description);
			$price = (float) $price; 
			$quantity = (int) $quantity; 

			$sql = "UPDATE products SET name = ?, description = ?, price = ?, quantity = ? WHERE id = ?";
			$query = $this->db->query($sql, array($name, $description, $price, $quantity, $id));

			if ($this->db->affected_rows() > 0) {
				return array('success' => true);
			} else {
				return array('success' => false, 'error' => 'Error updating product.');
			}
		}
	}

	public function deleteProductById($id)
	{
		// Validate 
		if (!is_numeric($id) || $id <= 0) {
			return array('success' => false, 'error' => 'Invalid product ID.');
		}
	
		$sql = "DELETE FROM products WHERE id = ?";
		$query = $this->db->query($sql, array($id));
	
		if ($this->db->affected_rows() > 0) {
			return array('success' => true);
		} else {
			return array('success' => false, 'error' => 'Error deleting product.');
		}
	}
	

}
