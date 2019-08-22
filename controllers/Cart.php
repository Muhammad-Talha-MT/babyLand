<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->model('Category_model');
		$this->load->model('Cart_model');
		$this->load->model('Newsitem_model');
		$this->load->model('Settings_model');
		$this->load->model('Page_model');
	
		
		$this->load->library('cart');
	}
	public function index()
	{
		$data['category_list'] = $this->Category_model->GetCategories();
		$data['product_list'] = $this->Cart_model->GetCart();
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$this->load->model('Tags_model');
		$data['tag_list'] = $this->Tags_model->GetTags();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		$data['page_list'] = $this->Page_model->GetPages();
		$this->load->view('myCart', $data);
	}
	public function MyCart()
	{
		$data['category_list'] = $this->Category_model->GetCategories();
		//$data['cart_list'] = $this->Cart_model->GetCart();
		$data['product_list']=$this->Product_model->GetProducts();
		$this->load->model('Tags_model');
		$data['tag_list'] = $this->Tags_model->GetTags();
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		$data['page_list'] = $this->Page_model->GetPages();
		 $this->load->view('mycart',$data);
	}
	public function checkOut()
	{
		$this->load->model('Order_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fullName', 'Customer Name', 'required');
		$this->form_validation->set_rules('address_1', 'Address', 'required');
		$this->form_validation->set_rules('contact', 'Cell Number', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['setting_list'] = $this->Settings_model->GetSettings();
			$data['page_list'] = $this->Page_model->GetPages();
			$data['category_list'] = $this->Category_model->GetCategories();
			$data['product_list'] = $this->Product_model->GetProducts();
			$this->load->model('Tags_model');
			$data['tag_list'] = $this->Tags_model->GetTags();
			$data['news_list'] = $this->Newsitem_model->GetNewsitem();
			$this->load->view("checkout", $data);
		} else {
			$data['userId'] = $this->input->post('userid');
			$data['cartGrandTotal'] = $this->input->post('grandtotal');
			$data['address'] = $this->input->post('address_1');
			$data['contact'] = $this->input->post('contact');
			$data['orderDate'] = date('Y-m-d');
			$data['status'] = "Pending";
			$orderId = $this->Order_model->SaveOrder($data);
			

			foreach ($this->cart->contents() as $cart) {
				$orderDetail['orderid'] = $orderId;
				$orderDetail['productid'] = $cart['id'];
				$orderDetail['quantity'] = $cart['qty'];
				$orderDetail['price'] = $cart['price'];
				$orderDetail['discount'] = 0;
				$this->Order_model->SaveOrderDetail($orderDetail);

			}
			$to_email = $this->input->post('email');
			$this->emailSend($to_email);
			$this->cart->destroy();
			$data['category_list'] = $this->Category_model->GetCategories();
			$data['product_list'] = $this->Product_model->GetProducts();
			$data['news_list'] = $this->Newsitem_model->GetNewsitem();
			$data['page_list'] = $this->Page_model->GetPages();
			$this->load->view("mycart", $data);
		}
	}
	
	public function addCart($id){
		
		$this->load->library('cart');

		$product = $this->Product_model->getProductById($id);
		$dataForm['ProductName'] = $product[0]['Name'];
		$dataForm['Price'] = $product[0]['Price'];
		$dataForm['Picture'] = $product[0]['Picture'];
		$dataForm['productId'] = $product[0]['Id'];

		$data = array(
			'id'      => $id,
			'qty'     => 1,
			'price'   => $dataForm['Price'],
			'name'    => $dataForm['ProductName'],
			'image' => $dataForm['Picture'],
		);

		$this->cart->insert($data);
		$this->session->set_flashdata('cartAdded', 'You Product is Added to cart');
		redirect(base_url());
	}

	public function delete(){

		$data = array(
			'rowid' => $_POST['id'],
			'qty'   => 0
		);
		//die(print_r($_POST));

		// $this->Cart_model->update($cartId, $formData);
		$this->cart->update($data);
		// $this->Cart_model->deleteCartProduct($productId);
		//redirect(base_url() . "Cart/MyCart");
	}

	public function updateQuantity(){
		$data = array(
			'rowid' => $_POST['id'],
			'qty'   => $_POST['quantity']
		);
		$this->cart->update($data);
		echo json_encode($this->cart->total());
	}

	public function showOrder(){
		$this->load->view('admin/manageorder');
	}

	public function emailSend($to_email)
	{
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://webs02.futuresouls.com',
			'smtp_port' => 465,
			'smtp_user' => 'muhammadtalha@eshopperpk.com',
			'smtp_pass' => 'talha112@uetlhr',
			'mailtype'  => 'html',
			'charset'   => 'iso-8859-1'
		);


		$this->load->library('email');
		$this->email->initialize($config);

		$from_email = "muhammadtalha@eshopperpk.com";

		//Load email library
		$this->load->library('email');
		$this->email->from($from_email, 'Identification');
		$this->email->to($to_email);
		$this->email->subject('Send Email Codeigniter');
		$this->email->message('The email send using codeigniter library');
		//Send mail
		if ($this->email->send())
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		else
			$this->session->set_flashdata("email_sent", "You have encountered an error");
	}
}
