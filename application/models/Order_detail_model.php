<?
class Order_detail_model extends MY_Model{

	var $table = "order_detail";
	
	//Danh sách chi tiết có trạng thái là 1 hoặc 0
	function get_order_detail($status,$id_order)
	{
		$query = $this->db->get_where($this->table,array('id_order' => $id_order,'status'=>$status));
		return $query->result();
	}

	function update_detail_stt_0($id_order)
	{
		$this->db->set('status', '0', FALSE);
		$this->db->where('id_order', $id_order);
		if($this->db->update($this->table))
		{
			return true;
		}
		return false;
	}
	
	//Kiểm tra sản phẩm có bị hủy hết chưa.
	function get_order_null($id_order)
	{
		$input = array();
		$input['where'] = array('status'=>0,'id_order'=>$id_order);
		//Danh sách sản phẩm bị hủy
		$query_status_0 = $this->db->get_where($this->table,array('id_order' => $id_order,'status' => 0));
		$total_product_be_cancel = $query_status_0->num_rows();
		//Tổng danh sách order
		$query = $this->db->get_where($this->table,array('id_order' => $id_order));
		$total_order_detail = $query->num_rows();
		
		//Nếu số lượng danh sách bị hủy bằng tổng số lượng sách
		if($total_product_be_cancel == $total_order_detail)
		{
			return true;
		}
		return false;
	}
	
	//Sản phẩm trong order còn 1 sp có trạng cái là 1
	function quantity_order_1($id_order)
	{
		$input = array();
		$input['where'] = array('status'=>0,'id_order'=>$id_order);
		//Danh sách sản phẩm bị hủy
		$query_status_0 = $this->db->get_where($this->table,array('id_order' => $id_order,'status' => 0));
		$total_product_be_cancel = $query_status_0->num_rows();
		//Tổng danh sách order
		$query = $this->db->get_where($this->table,array('id_order' => $id_order));
		$total_order_detail = $query->num_rows();
		
		//Nếu số lượng danh sách bị hủy bằng tổng số lượng sách
		if(($total_order_detail-$total_product_be_cancel)==1)
		{
			return true;
		}
		return false;
	}
	
	
	//Cập nhật trạng thái khi đơn hàng được khôi phục
	function update_stt_order_detail($id_order)
	{
		$data = array();
		$data = array('status' => 1);
		$where = array();
		$where = array('id_order'=>$id_order);
		if($this->order_detail_model->update_rule($where,$data))
		{
			return true;
		}
		return false;
	}
	
	//Tổng giá trị đơn hàng phải thanh toán(trừ các sản phẩm bị hủy)
	function total_pay_order($id_order)
	{
		$total = 0;
		$query = $this->db->get_where($this->table,array('status' => 1,'id_order'=>$id_order));
		$list_order_stt_1 = $query->result();

		foreach($list_order_stt_1 as $row)
		{
			$total += $row->total;
		}
		return $total;
	}
	
	function count_order_success($start,$end)
	{
		$this->db->select('*');
		$this->db->from('order_detail');
		$this->db->join('orders', 'order_detail.id_order = orders.id');
		$this->db->where('orders.status',3);
		$this->db->where('orders.created_success >',$start);
		$this->db->where('orders.created_success <',$end);
		$this->db->where('order_detail.status',1);
		$query = $this->db->get();
		$total_quantity = 0;
		foreach($query->result() as $row)
		{
			$total_quantity += $row->quantity;
		}
		return $total_quantity;
	}
}
?>