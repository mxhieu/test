<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Quản lý slide</h3>
<div>
	<p class="btn-control">
		<a style="margin:5px" href="<?echo admin_url("slide/add")?>" class="btn btn-info">Thêm slide</a>
		<a style="margin:5px 0px" href="<?echo admin_url("slide/load_slide")?>" class="btn btn-success">Quản lý chung</a>
		<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("slide/load_lock_slide")?>" class="btn btn-danger">Slide bị khóa</a>
	</p>
	<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> slide.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Tên slide</th>
		  <th>Hình</th>
		  <th>Tác giả</th>
		  <th>Ngày Lập</th>
		  <th style="width:20px">Ẩn/hiện</th>
		  <th style="width:20px">Sửa</th>
		</tr>
	  </thead>
	  <tbody>
		<?foreach($list_slide as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><img style="width: 50px" src="<?echo base_url("upload/slide/").$row->image?>"></td>
		  <td><?echo $row->author?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <td><span style="cursor:pointer;color:#8bc34a;" class="lock_row" data-id="<?echo $row->id?>"><i class="fas fa-eye"></i></span></td>
		  <td><a href="<?echo admin_url("slide/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
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
	alertify.confirm('Thông báo!', 'bạn có chắc sẽ ẩn slide được chọn',  function Redirect() {
               window.location="<?echo admin_url("slide/lock/")?>"+id;
            }
	, function(){ alertify.success('slide được giữ lại')});
});
</script>