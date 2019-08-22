<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newsitem extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Newsitem_model');
    }
    public function index()
    {
        $data['News_list'] = $this->Newsitem_model->GetNewsitem();
        $this->load->view('admin/manageNewsItem', $data);
    }
    public function edit($id)
    {
        $this->load->library('form_validation');
        $News = $this->Newsitem_model->getNewsitemyId($id);
        $arr = array();
        $arr['News'] = $News[0];
        $this->form_validation->set_rules('heading', 'Heading', 'required');
        $this->form_validation->set_rules('description', 'Detail', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/editNewsitem', $arr);
        } else {
            $data['heading'] = $this->input->post('heading');
            $data['detail'] = $this->input->post('description');
            $data['CreatedDate'] = Date('Y-m-d');
            $data['metaTitle'] = $this->input->post('metaKeyWord');
            $data['metaKeyword'] = $this->input->post('metaTitle');
            $data['metaDescription'] = $this->input->post('metaDescription');
            $this->Newsitem_model->update($id, $data);

            $strUrl = base_url() . "Newsitem";
            header("Location:" . $strUrl);
        }
    }
    public function delete($id)
    {
        $this->Newsitem_model->deleteNewsitem($id);
        redirect(base_url() . "Newsitem/index");
    }
    public function SaveNewsitem()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('heading', 'Heading', 'required');
        $this->form_validation->set_rules('description', 'Detail', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/addNewsitem');
        } else {
            $data['heading'] = $this->input->post('heading');
            $data['detail'] = $this->input->post('description');
            $data['CreatedDate'] = Date('Y-m-d');
            $data['metaTitle'] = $this->input->post('metaKeyWord');
            $data['metaKeyword'] = $this->input->post('metaTitle');
            $data['metaDescription'] = $this->input->post('metaDescription');
          
            $this->Newsitem_model->SaveNewsitem($data);

            $strUrl = base_url() . "Newsitem";
            header("Location:" . $strUrl);
        }
    }

    public function ProductTags()
    {
        $data['producttags_list'] = $this->Tags_model->GetProductTags();
        $this->load->view('admin/manageproducttags', $data);
    }

    public function deleteProductTags($productTagId)
    {
        $this->Tags_model->deleteTags($productTagId);
        redirect(base_url() . "Tags/ProductTags");
    }
}
