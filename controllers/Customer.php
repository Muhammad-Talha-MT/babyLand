<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	function _Contructor()
	{
		parent::__construct();
		$this->load->model('Register_model');
		
		$this->load->model('Attributes_model');
		
		$this->load->model('Brand_model');
		$this->load->model('Cart_model');
		$this->load->model('Newsitem_model');
		$this->load->model('Settings_model');
		
	
		$this->load->library('Cart');
		
		
		
		
	}

	public function loginWithFacebook()
	{
		echo "called";
		$this->load->library('facebook');
		$userData = array();

		// Check if user is logged in
		if ($this->facebook->is_authenticated()) {
			// Get user facebook profile details
			$fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture,password');
			
			// Preparing data for database insertion
			//$userData['oauth_provider'] = 'facebook';
			//$userData['oauth_uid']    = !empty($fbUser['id']) ? $fbUser['id'] : '';;
			$userData['UserName']    = !empty($fbUser['first_name']) ? $fbUser['first_name'] : '';
			//$userData['last_name']    = !empty($fbUser['last_name']) ? $fbUser['last_name'] : '';
			$userData['EmailAddress']        = !empty($fbUser['email']) ? $fbUser['email'] : '';
			$userData['password']        = !empty($fbUser['password']) ? $fbUser['password'] : '';
			//$userData['gender']        = !empty($fbUser['gender']) ? $fbUser['gender'] : '';
			//$userData['picture']    = !empty($fbUser['picture']['data']['url']) ? $fbUser['picture']['data']['url'] : '';
			$userData['link']        = !empty($fbUser['link']) ? $fbUser['link'] : '';
			echo "hello";
			echo "<pre>";
			print_r($userData);
			die();
			// Insert or update user data
			$userID = $this->Customer_model->addCustomer($userData);

			// Check user data insert or update status
			if (!empty($userID)) {
				$data = array(
					'sessionid' => session_id(),
					'userid' => $userData['Id'],
					'userName' => $userData['UserName'],
					'email' => $userData['EmailAddress'],
					'password' => $userData['Password'],
					'contact' =>  $userData['contact'],
					'address' => $userData['address'],
					'validated' => true
				);
				$this->session->set_userdata($data);
				$data['userData'] = $userData;
				$this->session->set_userdata('userData', $userData);
			} else {
				$data['userData'] = array();
			}

			// Get logout URL
			$data['logoutURL'] = $this->facebook->logout_url();
		} else {
			// Get login URL
			$data['authURL'] =  $this->facebook->login_url();
			
		}

		// Load login & profile view
		//$this->load->view('user_authentication/index', $data);

	}

	public function index()
	{
		$data['error'] = "";
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$data['page_list'] = $this->Page_model->GetPages();

		$data['setting_list'] = $this->Settings_model->GetSettings();
		$this->load->view('registerlogin', $data);
	}
	
	public function RegisterLogin()
	{
		$this->load->model('Product_model');
		$this->load->model('Category_model');
		$this->load->model('Cart_model');
		$this->load->library('cart');
		$this->load->model('Newsitem_model');
		$this->load->model('Page_model');
		$this->load->model('Settings_model');
		$data['category_list'] = $this->Category_model->GetCategories();
		//$data['cart_list'] = $this->Cart_model->GetCart();
		$data['product_list'] = $this->Product_model->GetProducts();
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$this->load->model('Tags_model');
		$data['tag_list'] = $this->Tags_model->GetTags();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		$data['page_list'] = $this->Page_model->GetPages();

		$data['error'] = "";
		$this->load->view('registerlogin',$data);
	}

	 public function logout()
    {
		$this->load->library('cart');
		$unsetArr = array('userid', 'userName', 'email', 'password', 'contact', 'address', 'validated');
		$this->session->unset_userdata($unsetArr);
		$this->cart->destroy();
        redirect(base_url());
	}
	
	public function signup()
	{
		$this->load->model('Customer_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('email', 'Emial', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('confirm-password', 'Confirm Password', 'required|matches[password]');
		if ($this->form_validation->run() == FALSE) {
			//print_r($_POST);
			redirect(base_url() . 'customer/registerlogin');
		} else {
			$data['UserName'] = $this->input->post('username');
			$data['EmailAddress'] = $this->input->post('email');
			$data['Password'] = $this->input->post('password');
			$data['contact'] = $this->input->post('contact');
			$data['address'] = $this->input->post('address');
			$data['CreatedBy'] = '1';
			$data['CreatedDate'] = date('Y-m-d');
			if (!$this->Customer_model->addCustomer($data)) {
				$this->session->set_flashdata('failSignup', 'You are not Signed Up');
			} else {

				redirect(base_url() . 'customer/registerlogin');
			}
		}
	}
	public function login()
	{
		$this->load->library('cart');
		$this->load->model('Customer_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username1', 'Name', 'required');
		$this->form_validation->set_rules('password1', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('fail', 'Your Fields are not filled');
			redirect(base_url() . 'customer/registerlogin');
		} else {
			$result = $this->Customer_model->login();

			if ($result == FALSE) {
				$this->session->set_flashdata('fail', 'Your Login UserName or Password');
				redirect(base_url() . 'customer/registerlogin');
			} else {
				redirect(base_url());
			}
		}
	}

	public function checkEmail()
	{
		$this->load->model('Customer_model');
		$email = $this->input->post('email');
		//die(print_r($name));
		$result = $this->Customer_model->checkUserEmail($email);
		if (!$result) {
			echo json_encode(TRUE);
		} else {
			echo json_encode(FALSE);
		}
	}

	public function delete($CustomerId)
	{
		$this->load->model('Customer_model');
		$this->Customer_model->deleteCustomer($CustomerId);
		redirect(base_url() . "Customer/AllCustomers");
	}

	
	public function AllCustomers(){
		$this->load->model('Customer_model');
		$data['customer_list'] = $this->Customer_model->GetCustomers();
		$this->load->view('admin/managecustomer.php', $data);
	}

	public function SaveCustomer(){
		$this->load->model('Customer_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('email', 'Emial', 'required|valid_email');
		$this->form_validation->set_rules('password2', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('confirm-password', 'Confirm Password', 'required|matches[password2]');
		if ($this->form_validation->run() == FALSE) {
			//print_r($_POST);
			$this->load->view('admin/addCustomer');
		} else {
			$data['UserName'] = $this->input->post('username');
			$data['EmailAddress'] = $this->input->post('email');
			$data['Password'] = $this->input->post('password2');
			$data['CreatedBy'] = '1';
			$data['CreatedDate'] = date('Y-m-d');
			if (!$this->Customer_model->addCustomer($data)) {
				die(print_r("No"));
			} else {
				redirect(base_url().'Customer/AllCustomers');
			}
		}
	}

	public function update($id)
	{
		$this->load->model('Customer_model');
		$this->load->library('form_validation');
		$customer = $this->Customer_model->getCustomerById($id);
		$data = array();
		$data['customer'] = $customer[0];
		$this->form_validation->set_rules('userName', 'User Name', 'required');
		$this->form_validation->set_rules('email', 'Emial', 'required|valid_email');
		$this->form_validation->set_rules('contact', 'Contact', 'required|min_length[8]');
		if ($this->form_validation->run() == FALSE) {
			//print_r($_POST);
			redirect(base_url() . 'customer/showprofile/' . $id);
		} else {
			$formdata['UserName'] = $this->input->post('userName');
			$formdata['EmailAddress'] = $this->input->post('email');
			$formdata['contact'] = $this->input->post('contact');
			$formdata['ModifiedBy'] = '1';
			$formdata['ModifiedDate'] = date('Y-m-d');
			$this->Customer_model->update($id, $formdata);
			redirect(base_url() . 'customer/showprofile/'.$id);
		}
	}

	public function edit($id)
	{
		$this->load->model('Customer_model');
		$this->load->library('form_validation');
		$customer = $this->Customer_model->getCustomerById($id);
		$data = array();
		$data['customer'] = $customer[0];
		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('email', 'Emial', 'required|valid_email');
		$this->form_validation->set_rules('password2', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('confirm-password', 'Confirm Password', 'required|matches[password2]');
		if ($this->form_validation->run() == FALSE) {
			//print_r($_POST);
			$this->load->view('admin/editCustomer',$data);
		} else {
			$formdata['UserName'] = $this->input->post('username');
			$formdata['EmailAddress'] = $this->input->post('email');
			$formdata['Password'] = $this->input->post('password2');
			$formdata['ModifiedBy'] = '1';
			$formdata['ModifiedDate'] = date('Y-m-d');
			$this->Customer_model->update($id, $formdata);
			redirect(base_url() . 'customer/AllCustomers');
			
		}
	}

	public function getUserId(){
		$this->load->model('Customer_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$data['error'] = "Input fields are empty!";
		
			redirect(base_url().'Cart/CheckOut',$data);
		} else {
			$result = $this->Customer_model->getCustomerId();

			if ($result == FALSE) {
				$data['error'] = "User is not found!";
				redirect(base_url() . 'Cart/CheckOut', $data);
				//redirect(base_url() . 'Customer');
			}
			else {
				return $result;
			}
		}
	}


	public function showProfile($userId){
		$this->load->model('Product_model');
		$this->load->model('Category_model');
		$this->load->model('Order_model');
		$this->load->library('cart');
		$this->load->model('Customer_model');
		$this->load->model('Newsitem_model');
		$this->load->model('Tags_model');
		$this->load->model('Settings_model');
		$this->load->model('Page_model');

		$data['category_list'] = $this->Category_model->GetCategories();
		$data['product_list'] = $this->Product_model->GetProducts();
		$data['order_list'] = $this->Order_model->getOrderByUserId($userId);
		$data['tag_list'] = $this->Tags_model->GetTags();
		$data['customer'] = $this->Customer_model->getCustomerById($userId);
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		$data['page_list'] = $this->Page_model->GetPages();
		

		$this->load->view('customerprofile', $data);
	}

	public function changepassword($userId){
		$this->load->model('Product_model');
		$this->load->model('Category_model');
		$this->load->model('Order_model');
		$this->load->library('cart');
		$this->load->model('Customer_model');
		$this->load->model('Tags_model');
		$this->load->model('Settings_model');
		$this->load->model('Newsitem_model');
		$this->load->model('Page_model');
		
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		
		$this->load->library('form_validation');
		$customer = $this->Customer_model->getCustomerById($userId);
		$data = array();
		$data['page_list'] = $this->Page_model->GetPages();
		$data['category_list'] = $this->Category_model->GetCategories();
		$data['product_list'] = $this->Product_model->GetProducts();
		$data['tag_list'] = $this->Tags_model->GetTags();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		$data['customer'] = $customer[0];
		$this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
		$this->form_validation->set_rules('newpassword', 'New Password', 'required|min_length[8]');
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[newpassword]');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('changepassword', $data);
		} else {
			if($customer[0]['Password'] != $this->input->post('oldpassword')){
				$this->session->set_flashdata('failed', 'You Old Password is not Correct');
				$this->load->view('changepassword', $data);
			}
			$formdata['Password'] = $this->input->post('newpassword');
			$formdata['ModifiedBy'] = '1';
			$formdata['ModifiedDate'] = date('Y-m-d');
			$this->Customer_model->update($userId, $formdata);
			$this->session->set_flashdata('success', 'Password is successfully updated');
			$this->load->view('changepassword', $data);
		}
	}

	public function myOrder($userId)
	{
		$this->load->model('Product_model');
		$this->load->model('Category_model');
		$this->load->model('Order_model');
		$this->load->library('cart');
		$this->load->model('Tags_model');
		$this->load->model('Settings_model');
		$this->load->model('Newsitem_model');
		$this->load->model('Page_model');
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		$data['category_list'] = $this->Category_model->GetCategories();
		$data['product_list'] = $this->Product_model->GetProducts();
		$data['order_list'] = $this->Order_model->getOrderByUserId($userId);
		$data['tag_list'] = $this->Tags_model->GetTags();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		$data['page_list'] = $this->Page_model->GetPages();
		// echo "<pre>";
		// print_r($data);
		// die();
		// // die(print_r($data));
		// die(print_r($data['product_detail']));

		$this->load->view('myorder', $data);
	}

	public function sendPassword(){
		$to_email = $this->input->post('email');
		$password = $this->input->post('password');
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
		$this->email->message('Your Password is'. $password);
		//Send mail
		if ($this->email->send())
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		else
			$this->session->set_flashdata("email_sent", "You have encountered an error");
	}
}
