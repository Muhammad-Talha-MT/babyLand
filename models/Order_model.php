<?php
class Order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function SaveOrder($data)
    {
        //print_r($data);
        $this->db->insert('order', $data);
        $insertId = $this->db->insert_id();


        return  $insertId;
    }
    public function SaveOrderDetail($data)
    {
        //print_r($data);
        $this->db->insert('orderdetail', $data);
        $insertId = $this->db->insert_id();


        return  $insertId;
    }
    public function GetOrders()
    {
        $this->db->select('*');
        $this->db->from('order');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function deleteOrder($orderId)
    {
        $this->db->where("orderId", $orderId);
        $this->db->delete("order");
    }

    public function getOrderById($id)
    {
        $this->db->where("orderId", $id);
        return $this->db->get("order")->result_array();
    }

    public function getOrderCount(){
        return $this->db->where('status',"pending")->count_all_results('order');;
    }

    public function getOrderByUserId($id)
    {
        $this->db->where("userId", $id);
        return $this->db->get("order")->result_array();
    }

    public function update($id, $formData)
    {
        $this->db->where("orderid", $id);
        $this->db->update("order", $formData);
    }

    public function getOrderDetail($orderId){
        $this->db->where('orderid',$orderId);
        return $this->db->get("orderdetail")->result_array();

    }
}
