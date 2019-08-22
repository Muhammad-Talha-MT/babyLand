<?php
class Attributes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function SaveAttributes($data)
    {
        //print_r($data);
        return $this->db->insert('attributes', $data);
    }
    public function GetAttributes()
    {
        $this->db->select('*');
        $this->db->from('attributes');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function addProductAttributes($data){
        return $this->db->insert('productattributes', $data);
    }

    public function editProductAttributes($id, $formData){
        $this->db->where("ProductId", $id);
        $this->db->update("productattributes", $formData);
    }

    public function getProductAttribuesById($id){
        
        $this->db->where("ProductId", $id);
        return $this->db->get("productattributes")->result_array();
    }

    public function deleteAttributes($attributeId)
    {
        $this->db->where("Id", $attributeId);
        $this->db->delete("attributes");
    }

    public function deleteProductAttributes($productId)
    {
        $this->db->where("ProductId", $productId);
        $this->db->delete("attributes");
    }

    public function getAttributesById($id)
    {
        $this->db->where("Id", $id);
        return $this->db->get("attributes")->result_array();
    }

    public function update($id, $formData)
    {
        $this->db->where("Id", $id);
        $this->db->update("attributes", $formData);
    }

    public function updateProductAttributes($productid, $attributeid, $formData)
    {
        $this->db->where("ProductId", $productid);
        $this->db->where("AttributeId", $attributeid);
        $this->db->update("productattributes", $formData);
    }
}
