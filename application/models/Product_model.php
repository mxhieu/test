<?
class Product_model extends MY_Model{

	var $table = "product";

	//Phương thức tìm kiếm theo tên và từ khóa
	function get_list_product_ajax($input = array(),$catalog_sub_id = array(),$per_page,$rowno)
	{
		if(!empty($catalog_sub_id))
		{
			$this->db->where_in('id_cat',$catalog_sub_id);
			$this->db->limit($per_page,$rowno);
			$this->db->where($input);
			$query = $this->db->get($this->table);
		}
		else
		{
			$this->db->limit($per_page,$rowno);
			$this->db->where($input);
			$query = $this->db->get($this->table);
		}
		$output = '<div class="products">';
		foreach($query->result() as $product)
		{
		$output .='<div class="col-sm-3 col-xs-6 thumb">
					<a href="'.base_url('index.php/').$product->slug.'-c'.$product->id_cat.'p'.$product->id.'.html">
						<div class="thumbnail">
							<img src="'.base_url('upload/product/').$product->image.'" alt="'.$product->name.'">
							<div class="caption">
								<h3>'.$product->name.'</h3>
								<span>
									'. $product->style.'
								</span>
								<div class="price">
									'.number_format($product->price).' <u>₫</u>
								</div>
							</div>
						</div>
					</a>
				</div>
				</div>';
		}
		return $output;
	}
	
	
	function get_list_product($input = array(),$catalog_sub_id = array(),$per_page,$rowno)
	{
		if(!empty($catalog_sub_id))
		{
			$this->db->where_in('id_cat',$catalog_sub_id);
			$this->db->order_by('id','desc');
			$this->db->limit($per_page,$rowno);
			$this->db->where($input);
			$query = $this->db->get($this->table);
		}
		else
		{
			$this->db->order_by('id','desc');
			$this->db->limit($per_page,$rowno);
			$this->db->where($input);
			$query = $this->db->get($this->table);
		}
		return $query->result();
	}
	
	function count_get_list_product($input = array(),$catalog_sub_id = array())
	{
		if(!empty($catalog_sub_id))
		{
			$this->db->where_in('id_cat',$catalog_sub_id);
			$this->db->where($input);
			$query = $this->db->get($this->table);
		}
		else
		{
			$this->db->where($input);
			$query = $this->db->get($this->table);
		}
		return $query->num_rows();
	}
	
	function count_result($input,$last_id_subs=array())
	{
		if(!empty($last_id_subs))
		{
			$query = $this->db->select('*')->from($this->table)
				->group_start()
					->like('name', $input)
					->or_like('keyword', $input)
				->group_end()
				->where('status', 1)
				->where_in('id_cat', $last_id_subs)
			->get();
		}
		else
		{
			$query = $this->db->select('*')->from($this->table)
				->group_start()
					->like('name', $input)
					->or_like('keyword', $input)
				->group_end()
				->where('status', 1)
			->get();
		}
		return $query->num_rows();
	}
	
	//Tìm kiếm của trang ngoài giao diện
	function select_like($input,$last_id_subs=array(),$per_page,$rowno = 0)
	{
		if(!empty($last_id_subs))
		{
			$query = $this->db->select('*')->from($this->table)
				->group_start()
					->like('name', $input)
					->or_like('keyword', $input)
				->group_end()
				->where('status', 1)
				->where_in('id_cat', $last_id_subs)
				->order_by('id', 'desc')
				->limit($per_page, $rowno)
			->get();
		}
		else
		{
			$query = $this->db->select('*')->from($this->table)
				->group_start()
					->like('name', $input)
					->or_like('keyword', $input)
				->group_end()
				->where('status', 1)
				->order_by('id', 'desc')
				->limit($per_page, $rowno)
			->get();
		}
		return $query->result();
	}
	
	//Trong admin


	function get_like($status,$search_text, $per_page, $rowno = 0)
	{
		$query = $this->db->select('*')->from($this->table)
			->group_start()
				->like('name', $search_text)
				->or_like('id', $search_text)
			->group_end()
			->where('status', $status)
			->where('quantity >',0)
			->order_by('id', 'desc')
			->limit($per_page, $rowno)
		->get();
		return $query->result();
	}
	
	function get_total_row($status,$input)
	{
		$query = $this->db->select('*')->from($this->table)
			->group_start()
				->like('name', $input)
				->or_like('id', $input)
			->group_end()
			->where('status', $status)
			->where('quantity >',0)
			->order_by('id', 'desc')
		->get();
		return $query->num_rows();
	}
   
	//Danh sách sản phẩm hết số lương.
	function get_out_of_product($search_text,$per_page,$rowno=0)
	{
		$query = $this->db->select('*')->from($this->table)
			->group_start()
				->like('name', $search_text)
				->or_like('id', $search_text)
			->group_end()
			->where('quantity',0)
			->limit($per_page, $rowno)
		->get();
		return $query->result();
	}
	
	//Lấy tổng số lượng sản phẩm hết số lượng.
	function get_total_oop($input)
	{
		$query = $this->db->select('*')->from($this->table)
			->group_start()
				->like('name', $input)
				->or_like('id', $input)
			->group_end()
			->where('quantity',0)
		->get();
		return $query->num_rows();
	}
	
		//Giảm số lượng sản phẩm
	function increase_qty($id,$qty)
	{
		$this->db->set('quantity', 'quantity -'.$qty.'',FALSE);
		$this->db->set('bought', 'bought +'.$qty.'',FALSE);
		$this->db->where('id', $id);
		if($this->db->update('product'))
		{
			return true;
		}
		return false;
	}

	//Thêm số lượng đã mua
	function descrease_qty($id,$qty)
	{
		$this->db->set('bought', 'bought -'.$qty.'',FALSE);
		$this->db->set('quantity', 'quantity +'.$qty.'',FALSE);
		$this->db->where('id', $id);
		if($this->db->update('product'))
		{
			return true;
		}
		return false;
	}
}
?>