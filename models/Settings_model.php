<?php
class Settings_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function SaveSettings($data)
    {
        //print_r($data);
        return $this->db->insert('settings', $data);
    }

    public function GetSettings()
    {
        $this->db->select('*');
        $this->db->from('settings');
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function checkEmpty()
    {
        $this->db->from('settings');
        $result = $this->db->get();
        if ($result->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
   
    public function update($id, $formData)
    {
        $this->db->where("id", $id);
        $this->db->update("settings", $formData);
    }

    
}
