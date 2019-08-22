<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	function __construct()
    {
          parent::__construct();
          $this->load->model('Order_model');
		 
	}
	public function index()
	{
		$data['order_list']=$this->Order_model->GetOrders();
        $this->load->view('admin/manageorder',$data);
	}
	public function edit($id){
				
	}
	public function delete( $orderId){
		$this->load->model('Order_model');
		$this->Order_model->deleteOrder($orderId);
		redirect(base_url() . "order");
	}
	public function CategoryProduct()
	{
		$this->load->view('categoryproduct');
	}
	public function Create()
	{
		$cat['parent_category'] = $this->Category_model->getCategories();
		$this->load->view('admin/addcategory',$cat);
	}

	public function getOrder($userid){
		$this->load->model('Order_model');
		$data['Order_list'] = $this->Order_model->getOrderByUserId($userid);
	}
	public function updateStatus()
	{
		$data['status'] = $this->input->post('text');
		$userId = $this->input->post('userid');
		$this->load->model('Customer_model');
		$user = $this->Customer_model->getCustomerById($userId);
		$email = $user[0]['EmailAddress'];
		$this->emailSend($email,$data['status']);
		$id = $this->input->post('orderid');
		$this->load->model('Order_model');
		$val = $this->Order_model->update($id,$data);
		echo $data['status'];
		 
	}

	function delete_all()
	{
		$this->load->model('Order_model');
		if ($this->input->post('checkbox_value')) {
			$id = $this->input->post('checkbox_value');
			for ($count = 0; $count < count($id); $count++) {
				$this->Order_model->deleteOrder($id[$count]);
			}
		}
    }
    
    public function detail($orderId){
        $this->load->model('Order_model');
        $data["orderdetail_list"] = $this->Order_model->getOrderDetail($orderId);
        $this->load->view('admin/orderdetail',$data);
        
	}

	public function emailSend($to_email,$status)
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
		$this->email->message('Your Order Status is update to '.$status );
		//Send mail
		if ($this->email->send()){
			$this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
		}
		else{
			$this->session->set_flashdata("email_sent", "You have encountered an error");
		}
		
	}

}
