<?php 
class Register extends CI_Controller{
    function _Contructor(){
        parent::__construct();
        $this->load->model('Register_model');
        
    }
    public function index(){
        $this->load->view('admin/adminregister');
    }
    public function signup(){
        $this->load->model('Register_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('userName','User Name','required');
        $this->form_validation->set_rules('email', 'Emial', 'required|valid_email');
        $this->form_validation->set_rules('pwd', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('passconf', 'Confirm Password', 'required|matches[pwd]');
        if($this->form_validation->run()==FALSE){
            //print_r($_POST);
            $this->load->view( 'admin/adminregister');
        }
        else{
            $data['userName'] = $this->input->post('userName');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('pwd');
            if (!$this->Register_model->addAdmin($data)) {
                print_r("No");
            }
            else {
                $this->load->view('admin/adminlogin');
            }
            
        }
     }

     public function login(){

        $this->load->model('Register_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Emial', 'required|valid_email');
        $this->form_validation->set_rules('pwd', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('admin/adminlogin');
        } else {
            $result = $this->Register_model->login();

            if ($result == FALSE) {
                redirect(base_url() . 'register/login');
            } else {
                redirect( base_url() . 'AdminMain');
            }
        }
    }

    public function checkEmail(){
        $this->load->model('Register_model');
        $email = $this->input->post('email');
        //die(print_r($name));
        $result = $this->Register_model->checkUserEmail($email);
        if(!$result){
            echo json_encode(TRUE);
        }
        else {
            echo json_encode(FALSE);
        }

    }

    public function logout()
    {
        $unsetArr = array('userid', 'userName', 'email', 'password', 'validated');
        $this->session->unset_userdata($unsetArr);
        redirect(base_url() . 'register/login');
    }
}


?>