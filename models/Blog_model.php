<?php
class Blog_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function SaveBlog($data)
    {
        //print_r($data);
        $this->db->insert('blog', $data);
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
    public function GetBlogs()
    {
        $this->db->select('*');
        $this->db->from('blog');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function deleteBlog($blogId)
    {
        $this->db->where("id", $blogId);
        $this->db->delete("blog");
    }

    public function getBlogById($id)
    {
        $this->db->where("id", $id);
        return $this->db->get("blog")->result_array();
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

    public function update($id, $formData)
    {
        $this->db->where("id", $id);
        $this->db->update("blog", $formData);
    }

    public function getLatestBlogs()
    {
        $this->db->order_by("id", "desc");
        $this->db->limit(3);
        return $this->db->get('blog')->result();
    }
}
