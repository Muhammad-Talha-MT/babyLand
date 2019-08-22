<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->model('Category_model');
		$this->load->model('Cart_model');
		$this->load->library('cart');
	}
	public function index()
	{
		$data['category_list'] = $this->Category_model->GetCategories();
		$data['product_list'] = $this->Cart_model->GetCart();
		$this->load->view('myCart', $data);
	}
	public function MyCart()
	{
		$data['category_list'] = $this->Category_model->GetCategories();
		//$data['cart_list'] = $this->Cart_model->GetCart();
		$data['product_list']=$this->Product_model->GetProducts();

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
			$data['category_list'] = $this->Category_model->GetCategories();
			$data['product_list'] = $this->Product_model->GetProducts();
			$this->load->view("checkout", $data);
		} else {
			$data['userId'] = $this->input->post('userid');
			$data['cartGrandTotal'] = $this->input->post('grandtotal');
			$data['orderDate'] = date('Y-m-d');
			$orderId = $this->Order_model->SaveOrder($data);

			foreach ($this->cart->contents() as $cart) {
				$orderDetail['orderid'] = $orderId;
				$orderDetail['productid'] = $cart['id'];
				$orderDetail['quantity'] = $cart['qty'];
				$orderDetail['price'] = $cart['price'];
				$orderDetail['discount'] = 0;
				$this->Order_model->SaveOrderDetail($orderDetail);

			}
			
			$data['category_list'] = $this->Category_model->GetCategories();
			$data['product_list'] = $this->Product_model->GetProducts();
			$this->load->view("mycart", $data);
		}


		
	}
	public function checkOutCart(){
		
	}
	public function addWish(){
		
        $data['userid'] = $this->input->post('userid');
        $data['productid'] = $this->input->post('productid');
        $data['createdDate'] = Date('Y-m-d');
        $this->load->model('Wishlist_model');
        
        $id=$this->Wishlist_model->SaveWish($data);
		echo json_encode($id);
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

	// public function checkOut(){

	// }
}



?>