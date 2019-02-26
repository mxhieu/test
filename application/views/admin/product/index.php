<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Quản lý thuốc</h3>
<div>
<p class="btn-control">
	<a style="margin:5px" href="<?echo admin_url("product/add")?>" class="btn btn-info">Thêm thuốc</a>
	<a style="margin:5px 0px" href="<?echo admin_url("product/load_product")?>" class="btn btn-success">Quản lý chung</a>
	<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("product/load_lock_product")?>" class="btn btn-danger">Thuốc bị khóa</a>
</p>
<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> sản phẩm.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>MaSP</th>
		  <th>Tên Thuốc</th>
		  <th>Hình</th>
		  <th>Danh mục</th>
		  <th>Giá</th>
		  <th>Số lượng</th>
		  <th>Nhà cung cấp</th>
		  <th>Người tạo</th>
		  <th>Ngày Lập</th>
		  <th>Sửa</th>
		  <th>Ẩn / Hiện</th>
		</tr>
	  </thead>
	  <tbody>
	  <?$i=1;?>
		<?foreach($list_product as $row):?>
		<tr class="active">
		 <td><?echo $i++?></td>
		  <th ><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><img style="width: 50px" src="<?echo base_url("upload/product/").$row->image?>"></td>
		  <td><?echo convert($row->id_cat,'catalog_model','','name',false)?></td>
		  <td><?echo number_format($row->price)?> vnđ</td>
		  <td><?echo $row->quantity?></td>
		  <td><?echo convert($row->id_provider,'provider_model','','name',false)?></td>
		  <td><?echo $row->author?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <td><a href="<?echo admin_url("product/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
		   <td><span style="cursor:pointer;color:#8bc34a;" class="lock_row" data-id ="<?echo $row->id?>"><i class="fas fa-eye"></i></span></td>
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
	alertify.confirm('Thông báo!', 'bạn có chắc sẽ ẩn sản phẩm được chọn',  function Redirect() {
               window.location="<?echo admin_url("product/lock/")?>"+id;
            }
	,function(){ alertify.success('sản phẩm được giữ lại')});
});
</script>