<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_model');
    }
    public function index()
    {
        $data['blog_list'] = $this->Blog_model->GetBlogs();
        $this->load->view('admin/manageblog', $data);
    }
    public function edit($id)
    {
        $this->load->library('form_validation');
        $Blog = $this->Blog_model->getBlogById($id);
        $arr = array();
        $arr['blog'] = $Blog[0];
        $this->form_validation->set_rules('blogName', 'Name', 'required');
        $this->form_validation->set_rules('descriptionblog', 'Description ', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/editblog',$arr);
        } else {
            $data['picture'] = json_encode($this->fileUpload());
            $data['name'] = $this->input->post('blogName');
            $data['description'] = $this->input->post('descriptionblog');
            $data['title'] = $this->input->post('titleBlog');
            $data['quote'] = $this->input->post('quoteBlog');
            $data['status'] = 0;
            $data['createdDate'] = Date('Y-m-d');
            $data['createdBy'] = $_SESSION['adminId'];
            $this->Blog_model->update($id, $data);

            $strUrl = base_url() . "Blog";
            header("Location:" . $strUrl);
        }
    }
    public function delete($blogId)
    {
        $this->Blog_model->deleteBlog($blogId);
        redirect(base_url() . "Blog/index");
    }
    public function SaveBlog()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('blogName', 'Name', 'required');
        $this->form_validation->set_rules('descriptionblog', 'Description ', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('admin/addblog');
        } else {
            $data['picture'] = json_encode($this->fileUpload());
            $data['name'] = $this->input->post('blogName');
            $data['title'] = $this->input->post('titleBlog');
            $data['quote'] = $this->input->post('quoteBlog');
            $data['description'] = $this->input->post('descriptionblog');
            $data['status'] = 0;
            $data['createdDate'] = Date('Y-m-d');
            $data['createdBy'] = $_SESSION['adminId'];
            $this->Blog_model->SaveBlog($data);

            $strUrl = base_url() . "Blog";
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

    public function blogdetail($id)
    {
        $_SESSION['cartAdd'] = NULL;
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Register_model');
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
        $data['latest_blog'] = $this->Blog_model->getLatestBlogs();
        $data['news_list'] = $this->Newsitem_model->GetNewsitem();
        $data['page_list'] = $this->Page_model->GetPages();
        $data['blog'] = $this->Blog_model->getBlogById($id);
        $data['author'] = $this->Register_model->getAdminById($data['blog'][0]['createdBy']);
        // echo "<pre>";
        //  die(print_r($data['blog']));
        $data['setting_list'] = $this->Settings_model->GetSettings();
        $this->load->view('single_blog', $data);
    }

    
}
