<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Thuốc đã hết số lượng</h3>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Mã SP</th>
		  <th>Tên Thuốc</th>
		  <th>Hình</th>
		  <th>Danh mục</th>
		  <th>Giá</th>
		  <th>Người tạo</th>
		  <th>Nhà cung cấp</th>
		  <th>Ngày Lập</th>
		  <th>Thêm số lượng</th>
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
		  <td><a href="<?echo admin_url("product/add_quantity/").$row->id?>"><i class="fas fa-plus"></i></a></td>
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