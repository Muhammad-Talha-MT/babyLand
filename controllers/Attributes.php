<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attributes extends CI_Controller {
	function __construct()
    {
          parent::__construct();
          $this->load->model('Attributes_model');
		 
	}
	public function index()
	{
		$data['attributes_list']=$this->Attributes_model->GetAttributes();
		$this->load->view('admin/manageattributes',$data);
    }

	public function edit($id){
        $this->load->library('form_validation');
        $Attribute = $this->Attributes_model->getAttributesById($id);
        $arr = array();
        $arr['attributes'] = $Attribute[0];
        $this->form_validation->set_rules('attributeName', 'Attribute Name', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/editAttributes',$arr);
        } else {
            $data['Name'] = $this->input->post('attributeName');
            $data['Description'] = $this->input->post('descriptionAttributes');
            $data['inputType'] = $this->input->post('inputType');
            $data['Status'] = $this->input->post('attributeStatus');
            $data['CreatedDate'] = Date('Y-m-d');
            $data['CreatedBy'] = "1";
            $data['ModifiedDate'] = Date('Y-m-d');
            $data['ModifiedBy'] = "1";
            $this->Attributes_model->update($id,$data);

            $strUrl = base_url() . "Attributes";
            header("Location:" . $strUrl);
        }
	}
	public function delete( $AttributeId){
		$this->Attributes_model->deleteAttributes($AttributeId);
		redirect(base_url() . "Attributes/index");
	}
	public function SaveAttributes()
	{
        $this->load->library('form_validation');
        $this->form_validation->set_rules('attributeName','Attribute Name','required');
        if(!$this->form_validation->run()){
            $this->load->view('admin/addAttributes');
        }
        else{
            $data['Name'] = $this->input->post('attributeName');
            $data['Description'] = $this->input->post('descriptionAttributes');
            $data['Status'] = $this->input->post('attributeStatus');
            $data['inputType'] = $this->input->post('inputType');
            $data['CreatedDate'] = Date('Y-m-d');
            $data['CreatedBy'] = "1";
            $data['ModifiedDate'] = Date('Y-m-d');
            $data['ModifiedBy'] = "1";
            $this->Attributes_model->SaveAttributes($data);

            $strUrl = base_url() . "Attributes";
            header("Location:" . $strUrl);
        }
    }


}
