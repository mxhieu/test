 
 
 
 <main>
<?$this->load->view('site/breadcrumb',$this->data)?>
	<div class="ss-content">
		<div class="container" >
				<div class="row">
					<div class="col-sm-11 col-sm-push-1">
						<div class="row col-left">
							<div class="col-sm-8 check-left" style="width:100%">
							 <h2 class="my_h2">Khách hàng: Mai Xuân Hiếu</h2>
							  <p>Thông tin đơn hàng đã đặt:</p>            
							  <table class="table table-hover">
								<thead>
								  <tr>
									<th class="my_th">Stt</th>
									<th class="my_th">Mã đơn hàng</th>
									<th class="my_th">Ngày đặt</th>
									<th class="my_th">Tổng tiền</th>
									<th class="my_th">Trạng thái</th>
									<th class="my_th">Tác vụ</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
								  <?$i = 1;?>
								  <?foreach($list_order as $row):?>
									<td><?echo $i++?></td>
									<td><?echo $row->id?></td>
									<td><?echo date('d/m/Y',$row->created)?></td>
									<td><?echo number_format($row->total)?> vnđ</td>
									<td><?if($row->status==1){echo "Đang duyệt";}elseif($row->status==2){echo "Đang giao";}elseif($row->status==3){echo "Thành công";}else{echo "bị hủy";}?></td>
									<td><a target="blank" href="<?echo base_url('index.php/chi-tiet-dat-hang/').$row->id?>">Xem chi tiết</a></td>
								  </tr>
								  <?endforeach;?>
								</tbody>
							  </table>			
						</div>

					
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

		</div>
</div>
</main>

 