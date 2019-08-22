<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->model('Product_model');
		$data['product_list'] = $this->Product_model->GetProducts();
		$this->load->view('main',$data);
	}
}
