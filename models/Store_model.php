<?php
class Store_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function SaveStore($data)
    {
        //print_r($data);
        $this->db->insert('stores', $data);
        $insertId = $this->db->insert_id();


        return  $insertId;
    }
    
    public function GetStores()
    {
        $this->db->select('*');
        $this->db->from('stores');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function deleteStore($storeId)
    {
        $this->db->where("id", $storeId);
        $this->db->delete("stores");
    }

    public function getStoreById($id)
    {
        $this->db->where("id", $id);
        return $this->db->get("stores")->result_array();
    }


    public function getStoreByUserId($id)
    {
        $this->db->where("id", $id);
        return $this->db->get("store")->result_array();
    }

    public function update($id, $formData)
    {
        $this->db->where("id", $id);
        $this->db->update("store", $formData);
    }

    public function getOrderDetail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get("store")->result_array();
    }
}
