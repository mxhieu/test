<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Nhà cung cấp bị khóa</h3>
<div>
	<p class="btn-control">
		<a style="margin:5px" href="<?echo admin_url("provider/add")?>" class="btn btn-info">Thêm nhà cung cấp</a>
		<a style="margin:5px 0px" href="<?echo admin_url("provider")?>" class="btn btn-success">Quản lý chung</a>
		<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("provider/lock_provider")?>" class="btn btn-danger">nhà cung cấp bị khóa</a>
	</p>
	<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> nhà cung cấp bị khóa.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Tên nhà cung cấp</th>
		  <th>Điện thoại</th>
		  <th>Ngày Lập</th>
		  <th>Trở lại</th>
		  <th>Sửa</th>
		</tr>
	  </thead>
	  <tbody>
		<?foreach($list_provider as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><?echo $row->phone?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <td><a href="<?echo admin_url("provider/unlock/").$row->id?>"><i class="fas fa-reply"></i></a></td>
		  <td><a href="<?echo admin_url("provider/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
		  
		</tr>
		<?endforeach?>
	  </tbody>
	</table>
   </div>
  <!-- /.table-responsive -->
	</div>
	<div class='pagination'>
   		 <? echo $this->pagination->create_links()?>
	</div>
</div>