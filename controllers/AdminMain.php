<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminMain extends CI_Controller {
	public function index()
	{
		$this->load->model('Customer_model');
		$this->load->model('Order_model');
		$data['registeruser'] = $this->Customer_model->getUserCount();
		$data['order'] = $this->Order_model->getOrderCount();
		$this->load->view('admin/admindashboard', $data);
	}
}
?>
