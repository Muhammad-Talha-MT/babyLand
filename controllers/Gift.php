<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gift extends CI_Controller {
	function __construct()
    {
          parent::__construct();
          $this->load->model('Gift_model');
		 
	}
	public function index()
	{
		$data['gift_list']=$this->Gift_model->GetGifts();
		$this->load->view('admin/managegift',$data);
	}
	public function edit($id){
		$this->load->library('form_validation');
		$gift = $this->Gift_model->getGiftById($id);
		$giftCard = array();
		$giftCard['gift'] = $gift[0];
		$this->form_validation->set_rules('giftCardType', 'Gift Card', 'required');
		$this->form_validation->set_rules('initialValue', 'Intial Value', 'required');
		$this->form_validation->set_rules('giftActive', 'Gift Active', 'required');
		$this->form_validation->set_rules('GiftCardCouponCode', 'Coupon Code', 'required');
		$this->form_validation->set_rules('recipientEmail', 'Recipient Email', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/editgift',$giftCard);
		} else {
			$data['Type'] = $this->input->post('giftCardType');
			$data['InitialValue'] = $this->input->post('initialValue');
			$data['CuponCode'] = $this->input->post('GiftCardCouponCode');
			$data['	RecName'] = $this->input->post('recipientEmail');
			$data['RecEmail'] = $this->input->post('recipientName');
			$data['SendName'] = $this->input->post('senderName');
			$data['SendEmail'] = $this->input->post('senderEmail');
			$data['Message'] = $this->input->post('message');
			//$data['Picture'] = $this->input->post('ParentCategoryId');
			if ($this->input->post('giftActive') == "on") {
				$data['Activated'] = 1;
			} else {
				$data['Activated'] = 0;
			}

			$data['CreatedDate'] = Date('Y-m-d');
			$data['CreatedBy'] = "1";
			$this->Gift_model->updateGift($id,$data);

			$strUrl = base_url() . "Gift";
			header("Location:" . $strUrl);
		}
		
	}
	public function delete( $Id){
		$this->load->model('Gift_model');
		$this->Gift_model->deleteGift($Id);
		redirect(base_url() . "Gift");
	}
	public function CategoryProduct()
	{
		$this->load->view('categoryproduct');
	}
	public function Create()
	{
		//$cat['parent_category'] = $this->Gift_model->getCategories();
		$this->load->view('admin/addgift');
	}
	public function SaveGift()
	{
		/* Load form validation library */ 
         $this->load->library('form_validation');
         /* Set validation rule for name field in the form */ 
        $this->form_validation->set_rules('giftCardType', 'Gift Card', 'required');
        $this->form_validation->set_rules('initialValue', 'Intial Value', 'required');
        $this->form_validation->set_rules('giftActive', 'Gift Active', 'required');
        $this->form_validation->set_rules('GiftCardCouponCode', 'Coupon Code', 'required');
        $this->form_validation->set_rules('recipientEmail', 'Recipient Email', 'required'); 
			
         if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/addgift');
         } 
         else {
			$data['Type']=$this->input->post('giftCardType');
			$data['InitialValue'] = $this->input->post('initialValue');
            $data['CuponCode'] = $this->input->post('GiftCardCouponCode');
            $data['	RecName'] = $this->input->post('recipientEmail');
            $data['RecEmail'] = $this->input->post('recipientName');
            $data['SendName'] = $this->input->post('senderName');
            $data['SendEmail'] = $this->input->post('senderEmail');
            $data['Message'] = $this->input->post('message');
			//$data['Picture'] = $this->input->post('ParentCategoryId');
			if( $this->input->post('giftActive')=="on"){
				$data['Activated'] = 1;
			}
			else {
				$data['Activated'] = 0;
			}
			
			$data['CreatedDate'] = Date('Y-m-d');
			$data['CreatedBy'] = "1";
			$this->Gift_model->SaveGift($data);
		    
			$strUrl=base_url()."Gift";
			header("Location:".$strUrl); 
		 }
		 
	}

	function delete_all()
	{
		$this->load->model('Category_model');
		if ($this->input->post('checkbox_value')) {
			$id = $this->input->post('checkbox_value');
			for ($count = 0; $count < count($id); $count++) {
				$this->Category_model->deleteCategory($id[$count]);
			}
		}
    }

    public function run_key()
    {

        $chars = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
            'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '?', '!', '@', '#',
            '$', '%', '^', '&', '*', '(', ')', '[', ']', '{', '}', '|', ';', '/', '=', '+'
        );

        shuffle($chars);

        $num_chars = 8;
        $token = '';

        for ($i = 0; $i < $num_chars; $i++) { // <-- $num_chars instead of $len
            $token .= $chars[mt_rand(0, $num_chars)];
        }

        echo $token;
	}
	
	public function checkGiftCode(){
		$CuponCode = $this->input->post('code');
		$this->load->model('Gift_model');
		$result=$this->Gift_model->checkCode($CuponCode);
		echo $result->InitialValue;
	}

}
