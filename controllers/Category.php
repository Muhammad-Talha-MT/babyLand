<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	function __construct()
    {
          parent::__construct();
		  $this->load->model('Category_model');
		  $this->load->model('Page_model');
		 
	}
	public function index()
	{
		$data['category_list']=$this->Category_model->GetCategories();
		$this->load->view('admin/managecategory',$data);
	}
	public function edit($id){
				$this->load->model("Category_model");
				$category=$this->Category_model->getCategoryById($id);
				$data = array();
				$data['category'] = $category[0];
				$this->form_validation->set_rules( 'txtCategoryName','Category Name','required');
				if($this->form_validation->run()==false){
					$data['parent_category']=$this->Category_model->GetCategories();
					$this->load->view('admin/editcategory',$data);

				}
				else {
				$config['upload_path']   = 'upload/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = 10000;
				$config['max_width']     = 1024;
				$config['max_height']    = 768;

				$this->load->library('upload');
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('uploadPicture')) {

					//die(print_r($_POST));
					$data['Picture'] = $this->upload->display_errors();
					//$data['Picture'] = "No";
				} else {
					$image_data = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $image_data['full_path']; //get original image
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 150;
					$config['height'] = 100;
					$this->load->library('image_lib', $config);
					if (!$this->image_lib->resize()) {
						$this->handle_error($this->image_lib->display_errors());
					}
					$data['Picture'] = $this->upload->data('file_name');
				} 
				
				$formData = array();
				$formData['Name'] = $this->input->post('txtCategoryName');
				$formData['Code'] = $this->input->post('txtCategoryCode');
				$formData['Description'] = $this->input->post('descriptionCategory');
				$formData['ParentCategoryId'] = $this->input->post('ParentCategoryId');
				//$formData['Picture'] = $this->input->post('ParentCategoryId');
				if ($this->input->post('publishCategory') == "on") {
					$formData['Published'] = 1;
				} else {
					$formData['Published'] = 0;
				}
				if ($this->input->post('showOnHomeCategory') == "on") {
					$formData['ShowOnHomePage'] = 1;
				} else {
					$formData['ShowOnHomePage'] = 0;
				}
				if ($this->input->post('categoryOnTop') == "on") {
					$formData['IncludeTopMenu'] = 1;
				} else {
					$formData['IncludeTopMenu'] = 0;
				}
				$formData['ParentCategoryId'] = $this->input->post('ParentCategoryId');
				$formData['PriceRange'] = $this->input->post('priceRangeCategory');
				$formData['DisplayOrder'] = $this->input->post('displayOrderCategory');
				$formData['Searchenginefriendly'] = $this->input->post('SearchProductName');
				$formData['Metatitle'] = $this->input->post('metaTitle');
				$formData['Metakeywords'] = $this->input->post('metaKeyWord');
				$formData['Metadescription'] = $this->input->post('metaDescription');
				$formData['ModifiedDate'] = Date('Y-m-d');
				$formData['CreatedBy'] = "1";
				$this->Category_model->update($id,$formData);
				$this->session->set_flashdata("success","Record Updated Successfully");
				//print_r($_SESSION['success']);
				redirect(base_url().'category');
				//print_r("TRUE");
			}
		
	}
	public function delete( $categoryId){
		$this->load->model('Category_model');
		$this->Category_model->deleteCategory($categoryId);
		redirect(base_url() . "Category/index");
	}
	public function CategoryProduct($id)
	{
		
		$_SESSION['cartAdd'] = NULL;
		$this->load->model('Product_model');
		$this->load->model('Category_model');
		$this->load->model('Newsitem_model');
		$this->load->model('Settings_model');
	
		$this->load->library('cart');
		$data['Child_Product'] = $this->Product_model->getProductByCategory($id);
		$data['category_list'] = $this->Category_model->GetCategories();
		$data['product_list'] = $this->Product_model->GetProducts();
		$data['news_list'] = $this->Newsitem_model->GetNewsitem();
		$data['setting_list'] = $this->Settings_model->GetSettings();
		$data['page_list'] = $this->Page_model->GetPages();
		$this->load->model('Tags_model');
		$data['tag_list'] = $this->Tags_model->GetTags();
		$this->load->view('categoryproduct',$data);
	}
	public function Create()
	{
		$cat['parent_category'] = $this->Category_model->getCategories();
		$this->load->view('admin/addcategory',$cat);
	}
	public function SaveCategory()
	{
		/* Load form validation library */ 
         $this->load->library('form_validation');
         /* Set validation rule for name field in the form */ 
         $this->form_validation->set_rules('txtCategoryName', 'Name', 'required'); 
			
         if ($this->form_validation->run() == FALSE) { 
			$cat['parent_category']=$this->Category_model->getCategories();
			$this->load->view('admin/addcategory',$cat);
         } 
         else {
			//print_r($_FILES);
			//die();
			$config['upload_path']   = 'upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']      = 10000;
			$config['max_width']     = 1024;
			$config['max_height']    = 768;
			
			$this->load->library('upload');
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uploadPicture')) {

				//die(print_r($_POST));
				
				$data['Picture'] = $this->upload->display_errors();
				//$data['Picture'] = "No";
			} else {
				$image_data = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = $image_data['full_path']; //get original image
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 150;
				$config['height'] = 100;
				$this->load->library('image_lib', $config);
				if (!$this->image_lib->resize()) {
					$this->handle_error($this->image_lib->display_errors());
				}
				$data['Picture'] = $this->upload->data('file_name');
			}
			$data['ParentCategoryId'] = $this->input->post('ParentCategoryId');
			$data['Name']=$this->input->post('txtCategoryName');
			$data['Code'] = $this->input->post( 'txtCategoryCode');
			$data['Description'] = $this->input->post( 'descriptionCategory');
			$data['ParentCategoryId'] = $this->input->post( 'ParentCategoryId');
			//$data['Picture'] = $this->input->post('ParentCategoryId');
			if( $this->input->post('publishCategory')=="on"){
				$data['Published'] = 1;
			}
			else {
				$data['Published'] = 0;
			}
			if ($this->input->post( 'showOnHomeCategory') == "on") {
				$data[ 'ShowOnHomePage'] = 1;
			} else {
				$data[ 'ShowOnHomePage'] = 0;
			}
			if ($this->input->post( 'categoryOnTop') == "on") {
				$data[ 'IncludeTopMenu'] = 1;
			} else {
				$data[ 'IncludeTopMenu'] = 0;
			}
			//$data['SelectCategory'] = $this->input->post( 'customerSelectCategory');
			$data['PriceRange'] = $this->input->post( 'priceRangeCategory');
			$data['DisplayOrder'] = $this->input->post( 'displayOrderCategory');
			$data['Searchenginefriendly'] = $this->input->post( 'SearchProductName');
			$data['Metatitle'] = $this->input->post( 'metaTitle');
			$data['Metakeywords'] = $this->input->post( 'metaKeyWord');
			$data['Metadescription'] = $this->input->post('metaDescription');
			$data['CreatedDate'] = Date('Y-m-d');
			$data['CreatedBy'] = "1";
			$this->Category_model->SaveCategory($data);
		    
			$strUrl=base_url()."Category";
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

}
?>
