<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Đơn hàng đang xử lý</h3>
<div>
<p class="btn-control">
	<a style="margin:5px 0px" href="<?echo admin_url("orders/load_order_index")?>" class="btn btn-success">Đơn hàng mới</a>
	<a style="margin:5px 0px" href="<?echo admin_url("orders/load_order_delivery")?>" class="btn btn-success">Đơn hàng đang giao</a>
	<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("orders/load_order_success")?>" class="btn btn-success">Đã giao thành công</a>
	<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("orders/load_order_cancel")?>" class="btn btn-danger">Đơn hàng bị hủy</a>
</p>
<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> đơn hàng đang giao.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>STT</th>
		  <th>Thông tin đơn hàng</th>
		  <th>Thông tin khách hàng</th>
		  <th>Trạng thái và thông tin khác</th>
		  <th>Thao tác</th>
		</tr>
	  </thead>
	  <tbody>
	  	<!--Khách hàng-->
		<?$i = 0?>
		<?foreach($list_order as $order):?>
		<?$i++?>
		<tr <?if($i%2==0) echo "class='active'"?>>
		  <td></td>
		  <td>Mã đơn hàng <?echo $order->id?></td>
		  <td>Tên khách hàng: <?echo $order->cus_name?></td>
		  <td>Trạng thái: <?if($order->status == 1)echo "Đơn hàng mới"; elseif($order->status == 2)echo "Đơn hàng đang giao";elseif($order->status == 3)echo "Đơn hàng thành công";else echo"bị hủy";?></td>
		  <td><a href="<?echo admin_url("orders/done/").$order->id?>"><i style="color:#337ab7" class="fas fa-check"></i> Đã giao</a></td>
		</tr>
		<tr <?if($i%2==0) echo "class='active'"?>>
			<td><?echo $i?></td>
			<td>Gía trị: <span style="color:red"><?echo number_format($order->total_pay)?> đ<span></td>
			<td>Địa chỉ: <?echo $order->cus_address?></td>
			<td>Ngày đặt: <?echo date('d/m/Y',$order->created)?></td>
			<td><span style="cursor:pointer;color:#337ab7" class="lock_row" data-id="<?echo $order->id?>"><i class="fas fa-ban"></i> Hủy đơn hàng</span></td>
		</tr>
		<tr <?if($i%2==0) echo "class='active'"?>>
			<td></td>	
			<td>Phương thức thanh toán: <?echo $order->payment?></td>
			<td>Số điện thoại: <?echo $order->cus_phone?></td>
			<td>Yêu cầu: <?echo $order->required?></td>
			<td><a href="<?echo admin_url('orders/detail/').$order->id?>"><i style="color:#337ab7" class="fas fa-shopping-cart"></i> Chi tiết đơn hàng</a></td>
		</tr>
		<?endforeach;?>
	  </tbody>
	</table>
   </div>
  <!-- /.table-responsive -->
	</div>
	
	</div>
  <!-- /.table-responsive -->
	</div>
	<div class='pagination'>
   		 <? echo $this->pagination->create_links()?>
	</div>
</div>
<script>
$(document).on('click','.lock_row',function(){
	var id = $(this).data("id");
	alertify.confirm('Thông báo!', 'Bạn có chắc đơn hàng bị hủy',  function Redirect() {
               window.location="<?echo admin_url("orders/cancel/")?>"+id;
            }
	, function(){ alertify.success('Đơn hàng giữ lại')});
});
</script>
