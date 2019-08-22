<?php
class Specification_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function SaveSpecification($data)
    {
        //print_r($data);
        return $this->db->insert('Specification', $data);
    }
    public function GetSpecification()
    {
        $this->db->select('*');
        $this->db->from('specification');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function deleteSpecification($attributeId)
    {
        $this->db->where("Id", $attributeId);
        $this->db->delete("specification");
    }

    public function getSpecificationById($id)
    {
        $this->db->where("Id", $id);
        return $this->db->get("specification")->result_array();
    }

    public function update($id, $formData)
    {
        $this->db->where("Id", $id);
        $this->db->update("specification", $formData);
    }
}
