<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Danh mục cha (menu)</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("parent_catalog/add")?>" class="btn btn-info">Thêm danh mục</a>
	<a style="margin:5px 0px" href="<?echo admin_url("parent_catalog")?>" class="btn btn-success">Quản lý chung</a>
	<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("parent_catalog/account_lock")?>" class="btn btn-danger">Danh mục bị khóa</a>
</p>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Tên Danh mục</th>
		  <th>Người tạo</th>
		  <th>Ngày Lập</th>
		  <th style="width:20px">Ẩn/hiện</th>
		  <th style="width:20px">Sửa</th>
		  <th style="width:20px">Xóa</th>
		</tr>
	  </thead>
	  <tbody>
		<?foreach($list_parent_catalog as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><?echo $row->author?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <?echo check_status('parent_catalog',$row->id,$row->status)?>
		  <td><a href="<?echo admin_url("parent_catalog/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
		  <td><a href="<?echo admin_url("parent_catalog/del/").$row->id?>"><i class="far fa-trash-alt"></i></a></td>
		</tr>
		<?endforeach?>
	  </tbody>
	</table>
   </div>
  <!-- /.table-responsive -->
	</div>
</div>