<?
class Cart extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->library('cart');
		$this->load->model('customer_model');
		$this->load->model('orders_model');
		$this->load->model('order_detail_model');
	}
	function check_default($post_string)
	{
		return $post_string == '0' ? FALSE : TRUE;
	}
	function index()
	{
		$this->load->model('orders_model');
		$this->load->model('catalog_model');
		$menu = $this->get_category();
		$carts = $this->cart->contents();
		$this->data['carts'] = $carts;
		$total_item = $this->cart->total_items();
		$this->data['total_item'] = $total_item;
		$this->data['menu'] = $menu;
		
		if(isset($_SESSION['cus_login']))
		{
			$query = $this->db->get_where('wards', array('id' => $_SESSION['cus_id_wards']));
			$info_wards = $query->row();
			$this->data['info_wards'] = $info_wards;
		}
		//Danh sách thành phố
		$query = $this->db->get('provinces'); 
		$list_provinces = $query->result();
		$this->data['list_provinces'] = $list_provinces;

		//breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs;
		$this->breadcrumbs->push('Trang chủ','/');
		$this->breadcrumbs->push('thanh toán', '/index.php/thanh-toan.html');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;
		
		//Checkout, Thêm thông tin người mua vào giỏ hàng
		$this->load->library('sendmail_library');
		$amount_total = 0;
		//pre($carts);
		foreach($carts as $cart)
		{
			$amount_total += $cart['subtotal'];
		}
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name','Tên','required|min_length[6]|max_length[50]');
			$this->form_validation->set_rules('phone','Số điện thoại','required|numeric|max_length[12]|min_length[9]');
			$this->form_validation->set_rules('email','email','required|valid_email|max_length[50]');
			$this->form_validation->set_rules('address','Địa chỉ','required|max_length[200]');
			$this->form_validation->set_rules('city','Tỉnh thành','required|callback_check_default');
			$this->form_validation->set_rules('district','Quận / huyện','required|callback_check_default');
  			$this->form_validation->set_message('check_default', 'Vui lòng chọn');
			if($this->form_validation->run())
			{
					$name = $this->input->post('name');
					$phone = $this->input->post('phone');
					$email = $this->input->post('email');
					$address = $this->input->post('address');
					$district = $this->input->post('district');
					$payment = $this->input->post('payment');
					$id_customer = 0;
					if(isset($_SESSION['cus_login']))
					{
						$id_customer = $_SESSION['cus_id'];
					}
					else
						$id_customer = 0;
					$city = $this->convert_city($this->input->post('city'));
					$required = $this->input->post('required');
					$total = $amount_total;
					$created = time();
					$data_orders = array();
					$data_orders = array(
										'id_customer' => $id_customer,
										'payment' => $payment,
										'required' =>$required,
										'total' => $total,
										'created' => $created,
										'cus_name' => $name,
										'cus_phone' => $phone,
										'cus_email' => $email,
										'cus_address' => $address.','.$district.','.$city,
					);
					if($this->orders_model->create($data_orders))
					{
						$id_orders = $this->db->insert_id();
						if(!empty($carts))
						{
							$data_orders_detail = array();
							foreach($carts as $cart)
							{
								$id_product = $cart['id'];
								$qty_product = $cart['qty'];
								$name_product = $cart['name'];
								$price_product = $cart['price'];
								$style_product = $cart['style'];
								$subtotal = $cart['subtotal'];
								$data_orders_detail = array(
										'id_order' => $id_orders,
										'id_product' => $id_product,
										'quantity' => $qty_product,
										'name' => $name_product,
										'price' => $price_product,
										'total' => $subtotal,
										'created' => time(),
										'style' => $style_product
								);
								$check = $this->order_detail_model->create($data_orders_detail);
								$this->product_buy($id_product,$qty_product);
								$this->qty_product($id_product,$qty_product);
							}
							$query = $this->db->get_where('order_detail',array('id_order'=>$id_orders));
							$list_order_detail = $query->result();
							
							$info_order = $this->orders_model->get_info($id_orders);
							if($check==true)
							{
								if($this->sendmail_library->send_mail($list_order_detail,$info_order,1))
								{
									echo "<script type='text/javascript'>alert('Bạn đã đặt hàng thành công vui lòng kiểm tra mail');window.location.href = '".base_url()."';</script>";
									$this->cart->destroy();
								}
								else
								{
									$this->cart->destroy();
									echo "<script type='text/javascript'>alert('gửi mail thất bại, nhưng bạn đã đặt hàng thành công');window.location.href = '".base_url()."';</script>";
								}
							}
							else
							{
								echo "<script type='text/javascript'>alert('Bạn đã đặt thất bại');window.location.href = '".base_url()."';</script>";
								
							}
						}
					}
					else
						echo "<script type='text/javascript'>alert('Bạn đã đặt hàng thành công vui lòng kiểm tra mail');window.location.href = '".base_url()."';</script>";
				}
			}
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		$this->data['temp'] = 'site/cart/index';
		$this->load->view('site/main',$this->data);
		//pre($carts);
	}

	function wards()
	{
		$province_id = $this->input->post('provinve');
		$query = $this->db->get_where('wards', array('province_id' => $province_id));
		$list_wards = $query->result();
		$rs='<option value="0">--Chọn Quận/Huyện--</option>';
		foreach($list_wards as $wards)
		{
			$rs .= "<option value='".$wards->title."'>".$wards->title."</option>";
		}
		echo $rs;
	}
	
	function wards_index()
	{
		$province_id = $this->input->post('provinve');
		$query = $this->db->get_where('wards', array('province_id' => $province_id));
		$list_wards = $query->result();
		$rs='<option value="0">--Chọn Quận/Huyện--</option>';
		foreach($list_wards as $wards)
		{
			$rs .= "<option value='".$wards->id."'>".$wards->title."</option>";
		}
		echo $rs;
	}
	
	function add()
	{
		$id = intval($this->uri->segment(3));
		$info_product = $this->product_model->get_info($id);
		if(!$info_product)
		{
			echo '<script>alert("Thất bại")</script>';
		}
		$quantity_product = $info_product->quantity;
		$price = $info_product->price;
		if($this->input->get())
		{
			$qty = $this->input->get('qty');
			$data = array();
			$data['id'] = $info_product->id;
			$data['qty'] = $qty;//Số lượng khách hàng mua
			$data['qty_product'] = $quantity_product;//Số lượng trong cơ sở dữ liệu
			$data['name'] = ($info_product->name);
			$data['image'] = $info_product->image;
			$data['price'] = $price;
			$data['style'] = $info_product->style;
			$this->cart->insert($data);
		}
		redirect(base_url("index.php/thanh-toan.html"));
	}

	function update()
	{
		$data = array();
		$data['rowid'] = $this->input->post('row_id');
		if(is_numeric($this->input->post('quantity')))
		{
			$data['qty'] = $this->input->post('quantity');
		}
		else
			$data['qty'] = 1;
		$this->cart->update($data);
		PRE($data);
		//echo $this->show_cart();
	}
	function show_cart()
	{ 
		$carts = $this->cart->contents();
		$str = '';
		$amount_total = 0;
		foreach ($carts as $key =>$row) {
			$amount_total += $row['subtotal'];
		}
		$str.='
		<div class="col-sm-12 total">
			<span>Tạm tính: </span>
			<span>'.number_format($amount_total).' ₫</span>
		</div>';
		return $str;
	}
	function load_cart(){ 
		echo $this->show_cart();
	}
	
	function delete_cart()
	{
		$name_p = "";
		$id = intval($this->uri->rsegment(3));
		if($id>0)
		{
			$carts = $this->cart->contents();
			foreach($carts as $key => $row)
			{
				if($row['id'] == $id)
				{
					$data = array();
					$data['rowid'] = $key;
					$data['qty'] = 0;
					$this->cart->update($data);
					$name_p =$row['name']; 
				}
			}
		}
		else
			$this->cart->destroy();
		$this->session->set_flashdata('message',"<script>alertify.success('Bạn đã xóa thành công ".$name_p.".')</script>"); 
		redirect(base_url('index.php/cart'));
		
	}
	
	function convert_city($id)
	{
		$query = $this->db->get_where('provinces', array('id' => $id));
		$list_wards = $query->row();
		return $list_wards->title;
	}

	//Giảm số lượng sản phẩm
	function qty_product($id,$qty)
	{
		$this->db->set('quantity', 'quantity -'.$qty.'',FALSE);
		$this->db->where('id', $id);
		if($this->db->update('product'))
		{
			return true;
		}
		return false;
	}

	//Thêm số lượng đã mua
	function product_buy($id,$qty)
	{
		$this->db->set('bought', 'bought +'.$qty.'',FALSE);
		$this->db->where('id', $id);
		if($this->db->update('product'))
		{
			return true;
		}
		return false;
	}
}
?>