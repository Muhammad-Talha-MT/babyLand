<?php
class Newsitem_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function SaveNewsitem($data)
    {
        //print_r($data);
        return $this->db->insert('newsitem', $data);
    }
    public function GetNewsitem()
    {
        $this->db->select('*');
        $this->db->from('newsitem');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function deleteNewsitem($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("newsitem");
    }

    public function getNewsitemyId($id)
    {
        $this->db->where("id", $id);
        return $this->db->get("newsitem")->result_array();
    }


    public function update($id, $formData)
    {
        $this->db->where("id", $id);
        $this->db->update("newsitem", $formData);
    }

}
