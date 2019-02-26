<?
class Orders_model extends MY_Model{

	var $table = "orders";

	function get_like($status,$input,$per_page,$rowno=0)
	{
		 $this->db->select('*')
				->from('orders')
				->where('orders.status',$status )
				->group_start()
					->like('cus_name', $input)
					->or_like('orders.id', $input)
					->or_like('orders.id_customer',$input)
				->group_end()
				->limit($per_page,$rowno);
		if($status==3)
		$this->db->order_by('created_success','desc');
		else
			$this->db->order_by('created','desc');
		$query=$this->db->get();
		return $query->result();
	}
	
    function get_total_row($status,$input)
	{
		$query = $this->db->select('*')
				->from('orders')
				->where('orders.status',$status )
				->group_start()
					->like('cus_name', $input)
					->or_like('orders.id', $input)
					->or_like('orders.id_customer',$input)
				->group_end()
				->get();
		return $query->num_rows();
	}

}
?>