<?php
class Page_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function Savepage($data)
    {
        //print_r($data);
        $this->db->insert('dynamicpages', $data);
       return $this->db->insert_id();

    }
    public function SaveOrderDetail($data)
    {
        //print_r($data);
        $this->db->insert('orderdetail', $data);
        $insertId = $this->db->insert_id();


        return  $insertId;
    }
    public function GetPages()
    {
        $this->db->select('*');
        $this->db->from('dynamicpages');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function deletePage($pageId)
    {
        $this->db->where("id", $pageId);
        $this->db->delete("dynamicpages");
    }

    public function getPageById($id)
    {
        $this->db->where("id", $id);
        return $this->db->get("dynamicpages")->result_array();
    }

    public function getOrderCount()
    {
        return $this->db->where('status', "pending")->count_all_results('order');;
    }

    public function getOrderByUserId($id)
    {
        $this->db->where("userId", $id);
        return $this->db->get("order")->result_array();
    }

    public function updatePage($id, $formData)
    {
        $this->db->where("id", $id);
        $this->db->update("dynamicpages", $formData);
    }

    public function getOrderDetail($orderId)
    {
        $this->db->where('orderid', $orderId);
        return $this->db->get("orderdetail")->result_array();
    }

    public function postMessage($data){
        return $this->db->insert('message', $data);
    }
}
