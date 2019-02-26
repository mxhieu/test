<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Ý kiến của khách hàng</h3>
<div>
<p class="btn-control">
	<a style="margin:5px" href="<?echo admin_url("contact/load_contact")?>" class="btn btn-info">Ý kiến mới</a>
	<a style="margin:5px 0px" href="<?echo admin_url("contact/load_seen")?>" class="btn btn-success">Đã xem</a>
</p>
<p class="total-row"><strong>Tổng cộng</strong> : <?echo $total_rows?> ý kiến.</p>
</div>
<div class="xs tabls">
	<div class="bs-example4" data-example-id="contextual-table">
	<table class="table">
	  <thead style="background: #8bc34a;">
		<tr>
		  <th>Stt</th>
		  <th>Tên Khách hàng</th>
		  <th>SĐT</th>
		  <th>Email</th>
		  <th>Địa chỉ</th>
		  <th>Nội dung</th>
		  <th>Trả lời</th>
		  <th>Đã xem</th>
		</tr>
	  </thead>
	  <tbody>
	  <?$i=1;?>
		<?foreach($list_contact as $contact):?>
		<tr class="active">
		  <th scope="row"><?echo $i++?></th>
		  <td><?echo $contact->name?></td>
		  <td><?echo $contact->phone?></td>
		  <td><?echo $contact->email?></td>
		  <td><?echo $contact->address?></td>
		  <td><?echo $contact->content?></td>
		  <td><a href="<?echo admin_url("contact/reply/").$contact->id?>"><i class="fas fa-comments"></i></a></td>
		  <td><a href="<?echo admin_url("contact/hasseen/").$contact->id?>"><i class="fas fa-eye"></i></a></td>
		</tr>
		<?endforeach?>
	  </tbody>
	</table>
   </div>
  <!-- /.table-responsive -->
	</div>
	<?/*<div class='pagination'>
   		 <? echo $this->pagination->create_links()?>
	</div>*/?>
</div>