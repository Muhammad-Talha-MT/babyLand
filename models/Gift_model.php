<?php
class Gift_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
	}
	public function SaveGift($data)
    {
            return $this->db->insert('giftcard',$data);
	}
	public function GetGifts()
	{
		$this->db->select('*');
		$this->db->from('giftcard');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function deleteGift($Id){
		$this->db->where("Id", $Id);
		$this->db->delete("giftcard");
	}

	public function getGiftById($id){
		$this->db->where("Id",$id);
		return $this->db->get("giftcard")->result_array();
	}

	public function checkCode($code)
	{
		$this->db->where('CuponCode', $code);
		$result = $this->db->get("giftcard")->row();
		if($result)
		{
			return $result;
		}
		else {
			return NULL;
		}
	}

	public function updategift($id,$formData){
		$this->db->where("Id",$id);
		$this->db->update("giftcard",$formData);
	}

	
}
