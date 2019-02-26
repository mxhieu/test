<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Quản lý loại tin tức</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("catalog_news/add")?>" class="btn btn-info">Thêm loại tin</a>
	<a style="margin:5px 0px" href="<?echo admin_url("catalog_news")?>" class="btn btn-success">Quản lý chung</a>
	<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("catalog_news/catalog_news_lock")?>" class="btn btn-danger">loại tin bị khóa</a>
</p>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Loại tin</th>
		  <th>Người tạo</th>
		  <th>Ngày Lập</th>
		  <th style="width:20px">Ẩn/hiện</th>
		  <th style="width:20px">Sửa</th>
		  <th style="width:20px">Xóa</th>
		</tr>
	  </thead>
	  <tbody>
		<?foreach($list_catalog_news as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><?echo $row->author?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <?echo check_status('catalog_news',$row->id,$row->status)?>
		  <td><a href="<?echo admin_url("catalog_news/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
		  <td><a href="<?echo admin_url("catalog_news/del/").$row->id?>"><i class="far fa-trash-alt"></i></a></td>
		</tr>
		<?endforeach?>
	  </tbody>
	</table>
   </div>
  <!-- /.table-responsive -->
	</div>
</div>