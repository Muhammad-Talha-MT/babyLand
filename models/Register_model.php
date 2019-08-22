<?php
class Register_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function addAdmin($user){
        return $this->db->insert('admin',$user);
    }

    public function login(){

        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('pwd'));
        //echo ($email);
        // Prep the query
        

        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->from('admin');
        // Run the query
        $query = $this->db->get();
        
        //die(print_r($query));
        // Let's check if there are any results
        if ($query->num_rows() == 1) {
            // If there is a er, then create session data
            //echo "yes";
            $row = $query->row_array();
            // echo '<pre>';
            // die(print_r($row));
            $data = array(
                'adminId' => $row['id'],
                'adminName' => $row['userName'],
                'adminEmail' => $row['email'],
                'adminPassword'=>$row['password'],
                'validated' => true
            );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        else {
            $unsetArr = array('adminId', 'adminName', 'adminEmail', 'adminPassword', 'validated');
            $this->session->unset_userdata($unsetArr);
            return false;
        }
    }

    public function checkUserEmail($email){
        
        //die(print_r($name));
        $this->db->where('email',$email);

        $this->db->from('admin');
        $query = $this->db->get();
        if($query->num_rows()==0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function getAdminById($id)
    {
        $this->db->where("id", $id);
        return $this->db->get("admin")->result_array();
    }
}

?>