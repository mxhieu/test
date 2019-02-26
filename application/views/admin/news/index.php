<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Quản lý tin tức</h3>
<div>
	<p class="btn-control">
		<a style="margin:5px" href="<?echo admin_url("news/add")?>" class="btn btn-info">Thêm tin tức</a>
		<a style="margin:5px 0px" href="<?echo admin_url("news/load_news")?>" class="btn btn-success">Quản lý chung</a>
		<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("news/load_lock_news")?>" class="btn btn-danger">Tin tức bị khóa</a>
	</p>
	<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> tin tức.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Mã tin tức</th>
		  <th>Tên tin tức</th>
		  <th>Hình</th>
		  <th>Tác giả</th>
		  <th>Ngày Lập</th>
		  <th>Nổi bật</th>
		  <th>Sửa</th>
		  <th>Ẩn/hiện</th>
		</tr>
	  </thead>
	  <tbody>
	  <?$i=1;?>
		<?foreach($list_news as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $i++?></th>
		  <th><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><img style="width: 50px" src="<?echo base_url("upload/news/").$row->image?>"></td>
		  <td><?echo $row->author?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <?echo check_show_index('news',$row->id,$row->hot)?>
		  <td><a href="<?echo admin_url("news/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
		  <td><span style="cursor:pointer;color:#8bc34a;" class="lock_row" data-id="<?echo $row->id?>"><i class="fas fa-eye"></i></span></td>
		</tr>
		<?endforeach;?>
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
	alertify.confirm('Thông báo!', 'bạn có chắc sẽ ẩn bài viết được chọn',  function Redirect() {
               window.location="<?echo admin_url("news/lock/")?>"+id;
            }
	, function(){ alertify.success('bài viết được giữ lại')});
});
</script>