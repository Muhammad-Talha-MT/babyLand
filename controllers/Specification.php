<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Specification extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Specification_model');
    }
    public function index()
    {
        $data['Specification_list'] = $this->Specification_model->GetSpecification();
        $this->load->view('admin/manageSpecification', $data);
    }
    public function edit($id)
    {
        $this->load->library('form_validation');
        $Attribute = $this->Specification_model->getSpecificationById($id);
        $arr = array();
        $arr['Specification'] = $Attribute[0];
        $this->form_validation->set_rules('attributeName', 'Attribute Name', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/editSpecification', $arr);
        } else {
            $data['Name'] = $this->input->post('attributeName');
            $data['Description'] = $this->input->post('descriptionSpecification');
            $data['Status'] = $this->input->post('Specificationtatus');
            $data['CreatedDate'] = Date('Y-m-d');
            $data['CreatedBy'] = "1";
            $data['ModifiedDate'] = Date('Y-m-d');
            $data['ModifiedBy'] = "1";
            $this->Specification_model->update($id, $data);

            $strUrl = base_url() . "Specification";
            header("Location:" . $strUrl);
        }
    }
    public function delete($AttributeId)
    {
        $this->Specification_model->deleteSpecification($AttributeId);
        redirect(base_url() . "Specification/index");
    }
    public function SaveSpecification()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('attributeName', 'Attribute Name', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/addSpecification');
        } else {
            $data['Name'] = $this->input->post('attributeName');
            $data['Description'] = $this->input->post('descriptionSpecification');
            $data['Status'] = $this->input->post('Specificationtatus');
            $data['CreatedDate'] = Date('Y-m-d');
            $data['CreatedBy'] = "1";
            $data['ModifiedDate'] = Date('Y-m-d');
            $data['ModifiedBy'] = "1";
            $this->Specification_model->SaveSpecification($data);

            $strUrl = base_url() . "Specification";
            header("Location:" . $strUrl);
        }
    }
}
