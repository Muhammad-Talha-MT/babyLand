<?php
class Brand_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
	}
	public function SaveBrand($data)
    {
        //print_r($data);
        return $this->db->insert('Brand',$data);
	}
	public function GetBrands()
	{
		$this->db->select('*');
		$this->db->from('brand');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function deleteBrand($brandId){
		$this->db->where("Id", $brandId);
		$this->db->delete("brand");
	}

	public function getBrandById($id){
		$this->db->where("Id",$id);
		return $this->db->get("brand")->result_array();
	}

	public function update($id,$formData){
		$this->db->where("Id",$id);
		$this->db->update("brand",$formData);
	}
}
