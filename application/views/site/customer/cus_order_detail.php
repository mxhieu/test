 
 
 
 <main>
<?$this->load->view('site/breadcrumb',$this->data)?>
	<div class="ss-content">
		<div class="container" >
				<div class="row">
					<div class="col-sm-11 col-sm-push-1">
						<div class="row col-left">
							<div class="col-sm-8 check-left" style="width:100%">
							 <h2 class="my_h2">Khách hàng: Mai Xuân Hiếu</h2>
							  <p>Thông tin đơn hàng đã đặt Vào lúc <?echo date('h:i:s d/m/Y',$info_order->created)?>:</p>							  
							  <table class="table table-hover">
								<thead>
								  <tr>
									<th>Stt</th>
									<th>Mã sp</th>
									<th>Tên sản phẩm</th>
									<th>Số lượng</th>
									<th>Đơn giá</th>
									<th>Thành tiền</th>
									<th>Trạng thái</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
								  <?$i = 1;?>
								  <?foreach($list_order_detail as $row):?>
									<td><?echo $i++?></td>
									<td><?echo $row->id_order?></td>
									<td><?echo $row->name?></td>
									<td><?echo $row->quantity?></td>
									<td><?echo number_format($row->price)?> vnđ</td>
									<td><?echo number_format($row->total)?> vnđ</td>
									<td><?if($row->status==1)echo "mua"; else { echo "Bị hủy";}?></td>
									
								  </tr>
								  <?endforeach;?>
								</tbody>
							  </table>		
						<p class="my_order_detail">Tổng thành tiền: <span style="color:red"><?echo number_format($total_order)?></span> vnđ</p>							  
						</div>

					
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

		</div>
</div>
</main>

 