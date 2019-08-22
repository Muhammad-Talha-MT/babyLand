<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$_SESSION['cartAdd'] = NULL;
		$this->load->model('Product_model');
		$this->load->model('Category_model');
		$this->load->model('Tags_model');
		$this->load->model('Blog_model');
		$this->load->model('Newsitem_model');
		$this->load->model('Settings_model');
		$this->load->model('Page_model');

		$this->load->library('cart');
		$data['category_list'] = $this->Category_model->GetCategories();
		$data['product_list'] = $this->Product_model->GetProducts();
		$data['tag_list'] = $this->Tags_model->GetTags();
		$data['latest_product'] = $this->Product_model->getLatestProduct();
		$data['blog_list'] = $this->Blog_model->GetBlogs();
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$data['page_list'] = $this->Page_model->GetPages();

		$data['setting_list'] = $this->Settings_model->GetSettings();
		$this->load->view('main',$data);
	}
}
