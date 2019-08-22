<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tags extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tags_model');
    }
    public function index()
    {
        $data['Tags_list'] = $this->Tags_model->GetTags();
        $this->load->view('admin/manageTags', $data);
    }
    public function edit($id)
    {
        $this->load->library('form_validation');
        $Attribute = $this->Tags_model->getTagsById($id);
        $arr = array();
        $arr['Tags'] = $Attribute[0];
        $this->form_validation->set_rules('attributeName', 'Attribute Name', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/editTags', $arr);
        } else {
            $data['Name'] = $this->input->post('attributeName');
            $data['Description'] = $this->input->post('descriptionTags');
            $data['Status'] = $this->input->post('Tagstatus');
            $data['CreatedDate'] = Date('Y-m-d');
            $data['CreatedBy'] = "1";
            $data['ModifiedDate'] = Date('Y-m-d');
            $data['ModifiedBy'] = "1";
            $this->Tags_model->update($id, $data);

            $strUrl = base_url() . "Tags";
            header("Location:" . $strUrl);
        }
    }
    public function delete($AttributeId)
    {
        $this->Tags_model->deleteTags($AttributeId);
        redirect(base_url() . "Tags/index");
    }
    public function SaveTags()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('attributeName', 'Attribute Name', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/addTags');
        } else {
            $data['Name'] = $this->input->post('attributeName');
            $data['Description'] = $this->input->post('descriptionTags');
            $data['Status'] = $this->input->post('Tagstatus');
            $data['CreatedDate'] = Date('Y-m-d');
            $data['CreatedBy'] = "1";
            $data['ModifiedDate'] = Date('Y-m-d');
            $data['ModifiedBy'] = "1";
            $this->Tags_model->SaveTags($data);

            $strUrl = base_url() . "Tags";
            header("Location:" . $strUrl);
        }
    }
    
    public function ProductTags(){
        $data['producttags_list'] = $this->Tags_model->GetProductTags();
        $this->load->view('admin/manageproducttags', $data);
    }

    public function deleteProductTags($productTagId){
        $this->Tags_model->deleteTags($productTagId);
        redirect(base_url() . "Tags/ProductTags");
    }
}
