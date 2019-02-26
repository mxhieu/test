<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Tin tức bị khóa</h3>
<div>
	<p class="btn-control">
		<a style="margin:5px" href="<?echo admin_url("news/add")?>" class="btn btn-info">Thêm tin tức</a>
		<a style="margin:5px 0px" href="<?echo admin_url("news/load_news")?>" class="btn btn-success">Quản lý chung</a>
		<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("news/load_lock_news")?>" class="btn btn-danger">Tin tức bị khóa</a>
	</p>
	<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> tin tức bị khóa.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Tên tin tức</th>
		  <th>Hình</th>
		  <th>Tác giả</th>
		  <th>Ngày Lập</th>
		  <th>Sửa</th>
		  <th>Khôi phục</th>
		</tr>
	  </thead>
	  <tbody>
		<?foreach($list_news as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><img style="width: 50px" src="<?echo base_url("upload/news/").$row->image?>"></td>
		  <td><?echo $row->author?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <td><a href="<?echo admin_url("news/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
		  <td><a href="<?echo admin_url("news/unlock/").$row->id?>"><i class="fas fa-reply"></i></a></td>
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
