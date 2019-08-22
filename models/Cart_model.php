<?php
class Cart_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
	}
	public function SaveCart($data)
    {
		$this->db->insert('cart',$data);
		$insertId = $this->db->insert_id();


		return  $insertId;
	}
	public function GetCart()
	{
		$this->db->select('*');
		$this->db->from('cart');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function deleteCartProduct($productId){
		$this->db->where("Id", $productId);
		$this->db->delete("cart");
	}

	public function getCartProductById($id){
		$this->db->where("id",$id);
		return $this->db->get("cart")->row();
		
	}

	public function update($id,$formData){
		$this->db->where("id",$id);
		$this->db->update("cart",$formData);
		die("Muhammd Tala");
	}
}
