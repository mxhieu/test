
	
<div class="graphs">
<h3 class="blank1">Danh mục thuốc</h3>
<?$this->load->view('admin/message')?>
<div>
	<p class="btn-control">
		<a style="margin:5px" href="<?echo admin_url("catalog/add")?>" class="btn btn-info">Thêm danh mục</a>
		<a style="margin:5px 0px" href="<?echo admin_url("catalog/load_catalog")?>" class="btn btn-success">Quản lý chung</a>
		<a style="margin:5px 0px;padding: 8.5px 12px;" href="<?echo admin_url("catalog/lock_catalog")?>" class="btn btn-danger">Danh mục bị khóa</a>
	</p>
	<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> danh mục.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Mã danh mục</th>
		  <th>Tên Danh mục</th>
		  <th>Hình ảnh</th>
		  <th>Danh mục cha</th>
		  <th>Vị trí</th>
		  <th>Người tạo</th>
		  <th>Ngày Lập</th>
		  <th>Nổi bật</th>
		  <th>Sửa</th>
		  <th>Ẩn/hiện</th>
		</tr>
	  </thead>
	  <tbody>
	  <?$i=1;?>
		<?foreach($list as $row):?>
		<tr class="active">
		  <th scope="row"><?echo $i++?></th>
		  <th><?echo $row->id?></th>
		  <td><?echo $row->name?></td>
		  <td><img style="width: 50px" src="<?echo base_url("upload/catalog/").$row->image?>"></td>
		  <td><?echo convert($row->parent_id,'catalog_model','Là danh mục cha','name',true)?></td>
		  <td><?echo $row->position?></td>
		  <td><?echo $row->author?></td>
		  <td><?echo date('d-m-Y',$row->created)?></td>
		  <?echo check_show_index('catalog',$row->id,$row->show_index)?>
		  <td><a href="<?echo admin_url("catalog/edit/").$row->id?>"><i class="fas fa-pencil-alt"></i></a></td>
		  <td><span style="cursor:pointer;color:#8bc34a;" class="lock_row" data-id ="<?echo $row->id?>"><i class="fas fa-eye"></i></span></td>
		</tr>
		<?endforeach?>
	  </tbody>
	</table>
   </div>
	</div>
	<div class='pagination'>
   		 <? echo $this->pagination->create_links()?>
	</div>
</div>
<script>
$(document).on('click','.lock_row',function(){
	var id = $(this).data("id"); 
	alertify.confirm('Thông báo!', 'bạn có chắc sẽ ẩn nhà cung cấp được chọn',  function Redirect() {
               window.location="<?echo admin_url("catalog/lock/")?>"+id;
            }
	,function(){ alertify.success('danh mục được giữ lại')});
});
</script>