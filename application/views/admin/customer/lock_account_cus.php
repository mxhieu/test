<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Quản lý tài khoản khách hàng</h3>
<div>
	<p class="btn-control">
		<a style="margin:5px 0px" href="<?echo admin_url("customer/load_customer")?>" class="btn btn-success">Quản lý chung</a>
		<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("customer/load_account_cus_lock")?>" class="btn btn-danger">Tài khoản bị khóa</a>
	</p>
	<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> tài khoản.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Mã KH</th>
		  <th>Tên KH</th>
		  <th>Tài khoản</th>
		  <th>Email</th>
		  <th>Ngày Lập</th>
		  <th>Khôi phục</th>
		</tr>
	  </thead>
	  <tbody>
		<?$i = 1?>
		<?foreach($list_member as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $i++?></th>
		  <td><?echo $row->id?></td>
		  <td><?echo $row->name?></td>
		  <td><?echo $row->username?></td>
		  <td><?echo $row->email?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <td><a href="<?echo admin_url("customer/unlock/").$row->id?>"><i class="fas fa-reply"></i></a></td>
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
	alertify.confirm('Thông báo!', 'bạn có chắc sẽ ẩn tài khoản được chọn',  function Redirect() {
               window.location="<?echo admin_url("customer/lock/")?>"+id;
            }
	, function(){ alertify.success('tài khoản được giữ lại')});
});
</script>