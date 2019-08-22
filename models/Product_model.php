<?php
class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function SaveProduct($data)
    {
        $this->db->insert('product', $data);
        $insertId = $this->db->insert_id();


        return  $insertId;
    }
    public function GetProducts()
    {
        $this->db->select('*');
        $this->db->from('product');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function deleteProduct($productId)
    {
        $this->db->where("Id", $productId);
        $this->db->delete("product");
    }

    public function getProductById($id)
    {
        $this->db->where("Id", $id);
        
        return $this->db->get("product")->result_array();
        
    }


    public function getProductByIds($id)
    {
        $this->db->where_in("Id", $id);
        $product_array = $this->db->get("product")->result_array();
        $returnArray = array();
        foreach ($product_array as $key => $value) {
            $returnArray[$key] = $value;
        }
        return $returnArray;
    }

    public function getProductByCategory($id)
    {

        $this->db->where("CategoryId", $id);
        return $this->db->get("product")->result_array();
    }

    public function getLatestProduct()
    {
        $this->db->order_by("Id", "desc");
        $this->db->limit(3);
        return $this->db->get('product')->result();
    }

    public function update($id, $formData)
    {
        //die(print_r($formData));
        $this->db->where("Id", $id);
        $this->db->update("product", $formData);
    }

    public function saveReview($data)
    {
        $this->db->insert('productreview', $data);
        $insertId = $this->db->insert_id();


        return  $insertId;
    }

    public function GetReviews(){
        $this->db->select('*');
        $this->db->from('productreview');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function updateReviewStatus($id,$data){
        $this->db->where("Id", $id);
        $this->db->update("productreview", $data);
    }

    public function searchByProductName($keyword)
    {
        $this->db->like('Name', $keyword);
        $query  =   $this->db->get('product');
        return $query->result();
    }

    public function searchByCategory($keyword)
    {
        $this->db->select('Id');
        $this->db->from('category');
        $this->db->like('Name',$keyword);

        $category_array = $this->db->get()->result_array();
        $returnArray = array();
        foreach ($category_array as $key => $value) {
            $returnArray[$key] = $value['Id'];
        }
        //die(print_r($returnArray));
        if (is_array($returnArray) && count($returnArray) > 0) {
            $this->db->where_in('CategoryId', $returnArray);
            $query = $this->db->get('product');
            $result = $query->result();
            return $result;
        }
        return $returnArray;
       

    }

    public function searchByTag($keyword)
    {
        $this->db->select('Id');
        $this->db->from('tags');
        $this->db->like('Name', $keyword);

        $tag_array = $this->db->get()->result_array();
        $tagArray = array();
        foreach ($tag_array as $key => $value) {
            $tagArray[$key] = $value['Id'];
        }
        if (is_array($tagArray) && count($tagArray) > 0)
        {
            $this->db->where_in("TagId", $tagArray);
            $this->db->select('ProductId');
            $product_array = $this->db->get("producttag")->result_array();
            $ProductArray = array();
            foreach ($product_array as $key => $value) {
                $ProductArray[$key] = $value['ProductId'];
            }
            if (is_array($ProductArray) && count($ProductArray) > 0) {
                $this->db->where_in('Id', $ProductArray);
                $query = $this->db->get('product');
                $result = $query->result();
                return $result;
            }
        }
        else
        {
            return $tag_array;
        }
    }

    public function searchByBrand($keyword)
    {
        $this->db->select('Id');
        $this->db->from('brand');
        $this->db->like('Name', $keyword);

        $brand_array = $this->db->get()->result_array();
        $returnArray = array();
        foreach ($brand_array as $key => $value) {
            $returnArray[$key] = $value['Id'];
        }
        if (is_array($returnArray) && count($returnArray) > 0) {
            $this->db->where_in('BrandId', $returnArray);
            $query = $this->db->get('product');
            $result = $query->result();
            return $result;
        }
        return $returnArray;
    }
}
