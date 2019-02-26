<?$this->load->view('admin/message')?>
	
<div class="graphs">
<h3 class="blank1">Ý kiến đã xem</h3>
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
		  <th style="width: 200px;">Tên Khách hàng</th>
		  <th>SĐT</th>
		  <th>Email</th>
		  <th>Địa chỉ</th>
		  <th>Nội dung</th>
		</tr>
	  </thead>
	  <tbody>
		<?foreach($list_contact as $contact):?>
		<tr class="active">
		  <th scope="row"><?echo $contact->id?></th>
		  <td><?echo $contact->name?></td>
		  <td><?echo $contact->phone?></td>
		  <td><?echo $contact->email?></td>
		  <td><?echo $contact->address?></td>
		  <td><?echo $contact->content?></td>
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