<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Settings_model');
    }
    public function index()
    {
        $data['settings'] = $this->Settings_model->GetSettings();
        // echo "<pre>";
        // print_r($data);
        // die();
        $this->load->view('admin/managesetting', $data);
    }
    public function SaveSettings()
    {
        // echo "<pre>";
        // print_r($_POST);
        // die();
        $this->load->library('form_validation');
        // $Blog = $this->Settings_model->getSettingsById($id);
        // $arr = array();
        // $arr['blog'] = $Blog[0];
        $this->form_validation->set_rules('websiteName', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address ', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('contact', 'Contact ', 'required');
        $this->form_validation->set_rules('facebook', 'Facebook ', 'required');
        $this->form_validation->set_rules('linkedin', 'LinkedIn ', 'required');

        if (!$this->form_validation->run()) {
            $this->load->view('admin/managesetting');
        } else {
            
            $data['bannerName'] = $this->input->post('websiteName');
            $data['address'] = $this->input->post('address');
            $data['email'] = $this->input->post('email');
            $data['facebook'] = $this->input->post('facebook');
            $data['linkedin'] = $this->input->post('linkedin');
            $data['contact'] = $this->input->post('contact');;
            if($this->Settings_model->checkEmpty()){
                $this->session->set_flashdata('success', 'Add Successfully');
                $this->Settings_model->SaveSettings($data);
            }
            else {
                $this->session->set_flashdata('success', 'Updated Successfully');
                $this->Settings_model->update(1, $data);
            }
            
            $strUrl = base_url() . "Settings";
            header("Location:" . $strUrl);
        }
    }
    public function delete($blogId)
    {
        $this->Blog_model->deleteBlog($blogId);
        redirect(base_url() . "Blog/index");
    }

}
