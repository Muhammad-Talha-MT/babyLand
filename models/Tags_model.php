<?php
class Tags_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function SaveTags($data)
    {
        //print_r($data);
        return $this->db->insert('tags', $data);
    }
    public function GetTags()
    {
        $this->db->select('*');
        $this->db->from('tags');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function GetProductTags()
    {
        $this->db->select('*');
        $this->db->from('producttag');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function addProductTags($data)
    {
        return $this->db->insert('producttag', $data);
    }

    public function deleteTags($attributeId)
    {
        $this->db->where("Id", $attributeId);
        $this->db->delete("tags");
    }

    public function deleteProductTags($productid)
    {
        $this->db->where("ProductId", $productid);
        $this->db->delete("producttag");
    }

    public function getTagsById($id)
    {
        $this->db->where("Id", $id);
        return $this->db->get("tags")->result_array();
    }

    public function getProductsByTagsId($tagid)
    {
        $this->db->where("TagId", $tagid);
        $this->db->select("ProductId");
        $productIds = $this->db->get("producttag")->result_array();
        $returnArray = array();
        foreach($productIds as $key=>$value){
            $returnArray[$key] = $value['ProductId'];
        }
        return $returnArray;
    }

    public function update($id, $formData)
    {
        $this->db->where("Id", $id);
        $this->db->update("tags", $formData);
    }

    public function updateProductTags($id, $formData)
    {
        $this->db->where("ProductId", $id);
        $this->db->update("producttag", $formData);
    }
}
