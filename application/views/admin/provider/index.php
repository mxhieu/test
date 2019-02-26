
	
<div class="graphs">
<h3 class="blank1">Quản lý nhà cung cấp</h3>
<?$this->load->view('admin/message')?>
  
<div>
	<p class="btn-control">
		<a style="margin:5px" href="<?echo admin_url("provider/add")?>" class="btn btn-info">Thêm nhà cung cấp</a>
		<a style="margin:5px 0px" href="<?echo admin_url("provider/load_provider")?>" class="btn btn-success">Quản lý chung</a>
		<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("provider/load_lock_provider")?>" class="btn btn-danger">nhà cung cấp bị khóa</a>
	</p>
	<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> nhà cung cấp.</p>
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
		  <th>Sửa</th>
		  <th>Ẩn/hiện</th>
		</tr>
	  </thead>
	  <tbody>
		<?foreach($list_provider as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><?echo $row->phone?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <td><a href="<?echo admin_url("provider/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
		  <td><span style="cursor:pointer;color:#8bc34a;" class="lock_row" data-id="<?echo $row->id?>"><i class="fas fa-eye"></i></span></td>
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


<script>
$(document).on('click','.lock_row',function(){
	var id = $(this).data("id");
	alertify.confirm('Thông báo!', 'bạn có chắc sẽ ẩn nhà cung cấp được chọn',  function Redirect() {
               window.location="<?echo admin_url("provider/lock/")?>"+id;
            }
	, function(){ alertify.success('nhà cung cấp được giữ lại')});
});
</script>