
<div class="graphs">
<h3 class="blank1">Danh mục thuốc</h3>
<?$this->load->view('admin/message')?>
<div>
<p class="btn-control">
	<a style="margin:5px" href="<?echo admin_url("catalog/add")?>" class="btn btn-info">Thêm danh mục</a>
	<a style="margin:5px 0px" href="<?echo admin_url("catalog/load_catalog")?>" class="btn btn-success">Quản lý chung</a>
	<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("catalog/load_lock_catalog")?>" class="btn btn-danger">Danh mục bị khóa</a>
</p>
<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> danh mục bị khóa.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Tên Danh mục</th>
		  <th>Hình ảnh</th>
		  <th>Danh mục cha</th>
		  <th>Vị trí</th>
		  <th>Người tạo</th>
		  <th>Ngày Lập</th>
		  <th>Sửa</th>
		  <th>Khôi phục</th>
		</tr>
	  </thead>
	  <tbody>
		<?foreach($list as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><img style="width: 50px" src="<?echo base_url("upload/catalog/").$row->image?>"></td>
		  <td><?echo convert($row->parent_id,'catalog_model','Là danh mục cha','name',true)?></td>
		  <td><?echo $row->position?></td>
		  <td><?echo $row->author?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <td><a href="<?echo admin_url("catalog/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
		  <td><a href="<?echo admin_url("catalog/unlock/").$row->id?>"><i class="fas fa-reply"></i></a></td>
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
