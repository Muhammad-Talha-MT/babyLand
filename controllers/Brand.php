<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Brand_model');
	}
	public function index()
	{
		$data['brand_list'] = $this->Brand_model->GetBrands();
		$this->load->view('admin/managebrand',$data);
	}
	public function delete($BrandId)
	{
		$this->Brand_model->deleteBrand($BrandId);
		redirect(base_url() . "Brand/index");
	}
	public function edit($id)
	{
		$this->load->model("brand_model");
		$brand = $this->Brand_model->getBrandById($id);
		$arr = array();
		$arr['brand'] = $brand[0];
		$this->form_validation->set_rules('BrandName', 'Brand Name', 'required');
		if ($this->form_validation->run() == false) {
			//print_r($id);
			$this->load->view('admin/editbrand', $arr);
		} else {

			$config['upload_path']   = 'upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']      = 1000;
			$config['max_width']     = 1024;
			$config['max_height']    = 768;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('uploadfile')) {
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
			$data['Name'] = $this->input->post('BrandName');
			$data['Code'] = $this->input->post('productCode');
			$data['Description'] = $this->input->post('productDescription');
			$data['ParentCategoryId'] = $this->input->post('ParentCategoryId');
			//$data['Picture'] = $this->input->post('ParentCategoryId');
			if ($this->input->post('publishedBarnd') == "on") {
				$data['Published'] = 1;
			} else {
				$data['Published'] = 0;
			}
			if ($this->input->post('showOnHomeBrand') == "on") {
				$data['showOnHomePage'] = 1;
			} else {
				$data['showOnHomePage'] = 0;
			}
			if ($this->input->post('includeOnTopBrand') == "on") {
				$data['IncludeTopMenu'] = 1;
			} else {
				$data['IncludeTopMenu'] = 0;
			}
			//$data['SelectCategory'] = $this->input->post( 'customerSelectCategory');
			$data['PriceRange'] = $this->input->post('priceRange');
			$data['DisplayOrder'] = $this->input->post('displayOrderBrand');
			$data['Searchenginefriendly'] = $this->input->post('SearchProductName');
			$data['Metatitle'] = $this->input->post('metaTitle');
			$data['Metakeywords'] = $this->input->post('metaKeyWord');
			$data['Metadescription'] = $this->input->post('metaDescription');
			$data['CreatedDate'] = Date('Y-m-d');
			$data['CreatedBy'] = "1";
			$this->Brand_model->update($id, $data);
			$this->session->set_flashdata("success", "Record Updated Successfully");
			//print_r($_SESSION['success']);
			redirect(base_url() . 'brand');
			//print_r("TRUE");
		}
	}
	public function BrandProduct()
	{
		$this->load->view('brandproduct');
	}
	public function Create()
	{
		$this->load->view('admin/addbrand');
	}
	public function SaveBrand(){
		/* Load form validation library */
		$this->load->library('form_validation');

		/* Set validation rule for name field in the form */
		$this->form_validation->set_rules('BrandName', 'Name', 'required');

		if ($this->form_validation->run() == FALSE) {
			//print_r("Muhammad Tlha");
			$url = base_url() . "Brand";
			$this->load->view($url);
		} else {
			$config['upload_path']   = './upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']      = 1000;
			$config['max_width']     = 1024;
			$config['max_height']    = 768;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('uploadfile')) {
				$data['Picture'] = $this->upload->display_errors();
				
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
			$data['Name'] = $this->input->post( 'BrandName');
			$data['Code'] = $this->input->post( 'productCode');
			$data['Description'] = $this->input->post( 'productDescription');
			$data['ParentCategoryId'] = $this->input->post( 'ParentCategoryId');
			//$data['Picture'] = $this->input->post('ParentCategoryId');
			if ($this->input->post( 'publishedBarnd') == "on") {
				$data['Published'] = 1;
			} else {
				$data['Published'] = 0;
			}
			if ($this->input->post('showOnHomeBrand') == "on") {
				$data[ 'showOnHomePage'] = 1;
			} else {
				$data[ 'showOnHomePage'] = 0;
			}
			if ($this->input->post( 'includeOnTopBrand') == "on") {
				$data[ 'IncludeTopMenu'] = 1;
			} else {
				$data[ 'IncludeTopMenu'] = 0;
			}
			//$data['SelectCategory'] = $this->input->post( 'customerSelectCategory');
			$data['PriceRange'] = $this->input->post('priceRange');
			$data['DisplayOrder'] = $this->input->post('displayOrderBrand');
			$data['Searchenginefriendly'] = $this->input->post('SearchProductName');
			$data['Metatitle'] = $this->input->post('metaTitle');
			$data['Metakeywords'] = $this->input->post('metaKeyWord');
			$data['Metadescription'] = $this->input->post('metaDescription');
			$data['CreatedDate'] = Date('Y-m-d');
			$data['CreatedBy'] = "1";
			$this->Brand_model->SaveBrand($data);

			$strUrl = base_url() . "Brand";
			//print_r($data);
			header("Location:" . $strUrl);

		}
	}
}
