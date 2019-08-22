<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Page_model');
    }
    public function index()
    {
        $data['pages_list'] = $this->Page_model->GetPages();
        $this->load->view('admin/managepages', $data);
    }
    public function edit($id)
    {
        $this->load->library('form_validation');
        $Page = $this->Page_model->getPageById($id);
        $arr = array();
        $arr['page'] = $Page[0];
        // die(print_r($arr));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pagetitle', 'Title', 'required');
        $this->form_validation->set_rules('pagebody', 'Body ', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/editpage',$arr);
        } else {
            $data['picture'] = json_encode($this->fileUpload());
            $data['title'] = $this->input->post('pagetitle');
            $data['body'] = $this->input->post('pagebody');
            $this->Page_model->updatePage($id,$data);

            $strUrl = base_url() . "page";
            header("Location:" . $strUrl);
        }
    }
    public function delete($blogId)
    {
        $this->Page_model->deletePage($blogId);
        redirect(base_url() . "Page/index");
    }
    public function SavePage()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pagetitle', 'Title', 'required');
        $this->form_validation->set_rules('pagebody', 'Body ', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/addpage');
        } else {
            $data['picture'] = json_encode($this->fileUpload());
            $data['title'] = $this->input->post('pagetitle');
            $data['body'] = $this->input->post('pagebody');
            $this->Page_model->SavePage($data);

            $strUrl = base_url() . "page";
            header("Location:" . $strUrl);
        }
    }

    public function fileUpload()
    {

        $data = array();
        // If file upload form submitted
        if (!empty($_FILES['uploadPicture']['name'])) {

            $filesCount = count($_FILES['uploadPicture']['name']);

            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name']     = $_FILES['uploadPicture']['name'][$i];
                $_FILES['file']['type']     = $_FILES['uploadPicture']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['uploadPicture']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['uploadPicture']['error'][$i];
                $_FILES['file']['size']     = $_FILES['uploadPicture']['size'][$i];

                // File upload configuration
                $uploadPath = 'upload';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';

                // Load and initialize upload library
                $this->load->library('upload');
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data

                    $fileData = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $fileData['full_path']; //get original image
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 1170;
                    $config['height'] = 500;
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) {
                        $this->handle_error($this->image_lib->display_errors());
                    }
                    $uploadData[$i] = $fileData['file_name'];
                }
            }

            return $uploadData;
        } else {
            return FALSE;
        }
    }

    

    public function showPage($id){
        $_SESSION['cartAdd'] = NULL;
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Tags_model');
        $this->load->model('Blog_model');
        $this->load->model('Newsitem_model');
        $this->load->model('Settings_model');
        $this->load->model('Page_model');

        $this->load->library('cart');
        $data['category_list'] = $this->Category_model->GetCategories();
        $data['product_list'] = $this->Product_model->GetProducts();
        $data['tag_list'] = $this->Tags_model->GetTags();
        $data['latest_product'] = $this->Product_model->getLatestProduct();
        $data['blog_list'] = $this->Blog_model->GetBlogs();
        $data['news_list'] = $this->Newsitem_model->GetNewsitem();
        $data['setting_list'] = $this->Settings_model->GetSettings();
        $data['page_list'] = $this->Page_model->GetPages();
        $data['page'] = $this->Page_model->GetPageById($id);
        // echo "<pre>";
        // die(print_r($data['page']));
        $this->load->view('about',$data);

    }

    public function contactUs(){
        $_SESSION['cartAdd'] = NULL;
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Tags_model');
        $this->load->model('Blog_model');
        $this->load->model('Newsitem_model');
        $this->load->model('Settings_model');
        $this->load->model('Page_model');

        $this->load->library('cart');
        $data['category_list'] = $this->Category_model->GetCategories();
        $data['product_list'] = $this->Product_model->GetProducts();
        $data['tag_list'] = $this->Tags_model->GetTags();
        $data['latest_product'] = $this->Product_model->getLatestProduct();
        $data['blog_list'] = $this->Blog_model->GetBlogs();
        $data['news_list'] = $this->Newsitem_model->GetNewsitem();
        $data['setting_list'] = $this->Settings_model->GetSettings();
        $data['page_list'] = $this->Page_model->GetPages();
        $this->load->view('contact_us', $data);
    }


    public function postmessage($id){
        $this->load->model('Page_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'User Name', 'required');
        $this->form_validation->set_rules('email', 'Emial', 'required|valid_email');
        $this->form_validation->set_rules('phone1', 'Phone Number', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('fail', 'Message is not sent!');
            redirect(base_url().'page/contactus');
        } else {
            $data['userid'] = $id;
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['contact'] = $this->input->post('phone1');
            $data['subject'] = $this->input->post('subject');
            $data['message'] = $this->input->post('message');
            $data['date'] = date('Y-m-d');
            $this->Page_model->postMessage($data);
            $this->session->set_flashdata('success', 'Message is successfully sent');
            redirect(base_url() . 'page/contactus');

        }
    }
}
