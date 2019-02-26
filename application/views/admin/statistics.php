<?$this->load->view('admin/message')?>
<div class="graphs">
<h3 class="blank1">Chi tiết đơn hàng</h3>
<div>
<p class="btn-control">
	<a style="margin:5px 0px" href="<?echo admin_url("orders/load_order_index")?>" class="btn btn-success">Đơn hàng mới</a>
	<a style="margin:5px 0px" href="<?echo admin_url("orders/load_order_delivery")?>" class="btn btn-success">Đơn hàng đang giao</a>
	<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("orders/load_order_success")?>" class="btn btn-success">Đã giao thành công</a>
	<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("orders/load_order_cancel")?>" class="btn btn-danger">Đơn hàng bị hủy</a>
</p>
<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> sản phẩm.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>STT</th>
		  <th>Mã HĐ</th>
		  <th>Ngày</th>
		  <th>Tên SP</th>
		  <th>Số lượng</th>
		  <th>Đơn giá</th>
		  <th>Thành tiền</th>
		  
		</tr>
	  </thead>
	  <tbody>
		<?$i=1;?>
		<?foreach($list_order_detail as $order_detail):?>
		<tr class="active">
		  <th scope="row"><?echo $i++?></th>
		  <td>MÃ HD</td>
		  <td>Ngày</td>
		  <td>TÊN</td>
		  <td></td>
		  <td> vnđ</td>
		  <td> vnđ</td>
		  
		</tr>
		<?endforeach?>
	  </tbody>
	</table>
   </div>
  <!-- /.table-responsive -->
	</div>

</div>