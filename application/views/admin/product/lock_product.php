<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Thuốc bị khóa</h3>
<div>
<p class="btn-control">
	<a style="margin:5px" href="<?echo admin_url("product/add")?>" class="btn btn-info">Thêm thuốc</a>
	<a style="margin:5px 0px" href="<?echo admin_url("product/load_product")?>" class="btn btn-success">Quản lý chung</a>
	<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("product/load_lock_product")?>" class="btn btn-danger">Thuốc bị khóa</a>
</p>
<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> sản phẩm bị khóa.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Tên Thuốc</th>
		  <th>Hình</th>
		  <th>Danh mục</th>
		  <th>Giá</th>
		  <th>Tác giả</th>
		  <th>Nhà cung cấp</th>
		  <th>Ngày Lập</th>
		  <th>Sửa</th>
		  <th>Khôi phục</th>
		</tr>
	  </thead>
	  <tbody>
		<?foreach($list_product as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><img style="width: 50px" src="<?echo base_url("upload/product/").$row->image?>"></td>
		  <td><?echo convert($row->id_cat,'catalog_model','','name',false)?></td>
		  <td><?echo number_format($row->price)?> vnđ</td>
		  <td><?echo $row->author?></td>
		  <td><?echo convert($row->id_provider,'provider_model','','name',false)?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <td><a href="<?echo admin_url("product/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
		  <td><a href="<?echo admin_url("product/unlock/").$row->id?>"><i class="fas fa-reply"></i></a></td>
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