<?php
class Category_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
	}
	public function SaveCategory($data)
    {
            return $this->db->insert('category',$data);
	}
	public function GetCategories()
	{
		$this->db->select('*');
		$this->db->from('category');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function getCategoryByParentCategory($id)
	{
		$this->db->where("ParentCategoryId", $id);
		return $this->db->get("category")->result_array();
	}
	public function deleteCategory($categoryId){
		$this->db->where("Id", $categoryId);
		$this->db->delete("category");
	}

	public function getCategoryById($id){
		$this->db->where("Id",$id);
		return $this->db->get("category")->result_array();
	}

	public function update($id,$formData){
		$this->db->where("Id",$id);
		$this->db->update("category",$formData);
	}

	
}
?>
