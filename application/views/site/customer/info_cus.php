<main>
<?$this->load->view('site/breadcrumb',$this->data)?>
	<div class="ss-content">
		<div class="container" >
			<form action="<?echo base_url().'index.php/customer/info_cus'?>" method="post" >
				<div class="row">
					<div class="col-sm-11 col-sm-push-1">
						<h1> Quản lý tài khoản </h1>
						<div class="row col-left">
							<div class="col-sm-8 check-left" style="width:100%">
								<section class="checkout-form item1">
									<h4 class="title1 active ">1. Thông tin khách hàng</h4>
									<div class="checkout c1 b1 my_contact" accept-charset="utf-8">
										<label class="my_col">
											<span class="form-name">Họ tên: <i>*</i> </span> 
											<input type="text" name="name"  id="name" value="<?echo $info_cus->name?>" placeholder="Nhập họ và tên" class="in1" />
										</label>
										<div class="my_form_error register"><?echo form_error('name')?></div>
										<label class="my_col">
											<span class="form-name">Tài khoản: <i>*</i> </span>
											<input readonly type="text" name="username"  id="username" placeholder="Nhập tài khoản" class="in2" value="<?echo $info_cus->username?>"/>
										</label>
										<div class="my_form_error register"><?echo form_error('username')?></div>
										<label class="my_col">
											<span class="form-name">Mật khẩu: <i>*</i> </span>
											<input type="password" class="my_required" name="password"  id="password" placeholder="Nhập để thay đổi" class="in2" value=""/>
										</label>
										<div class="my_form_error register"><?echo form_error('password')?></div>
										<label class="my_col">
											<span class="form-name">Nhập lại mật khẩu: <i>*</i> </span>
											<input type="password" class="my_required" name="repassword"  id="repassword" placeholder="Nhập lại mật khẩu" class="in2" value=""/>
										</label>
										<div class="my_form_error register"><?echo form_error('repassword')?></div>
										<label class="my_col">
											<span class="form-name">Số điện thoại: <i>*</i> </span>
											<input type="text" name="phone"  id="phone" placeholder="Nhập số điện thoại" class="in2" value="<?echo $info_cus->phone?>"/>
										</label>
										<div class="my_form_error register"><?echo form_error('phone')?></div>
										<label class="my_col">
											<span class="form-name">Email: <i>*</i></span>
											<input readonly type="email" name="email"  placeholder="Nhập địa chỉ Email" value="<?echo $info_cus->email?>"/>
										</label>
										<div class="my_form_error register"><?echo form_error('email')?></div>
										<label class="my_col">
											<span class="form-name">Địa chỉ: <i>*</i></span>
											<input type="text" name="address"  placeholder="Nhập địa chỉ" value="<?echo $info_cus->address?>"/>
										</label>
										<div class="my_form_error register"><?echo form_error('address')?></div>
										<label class="my_col">
											<span class="form-name">Tỉnh thành: <i>*</i></span>
											<select class="form-control cart_input my_select" name="city" style="" id="cities1">
											<option value="0">--Chọn thành phố--</option>
											<?foreach($list_provinces as $provinces):?>
												<option <?if($provinces->id == $info_cus->id_provices) echo "selected"?> value="<?echo $provinces->id?>"><?echo $provinces->title?></option>
											<?endforeach?>
											</select>
										</label>
										<div class="my_form_error register"><?echo form_error('city')?></div>
										<label class="my_col">
											<span class="form-name">Quận/Huyện: <i>*</i></span>
											<select name="district" class="form-control wards cart_input my_select" >
											<option value="<?echo $info_wards->id?>"><?echo $info_wards->title?></option>
											</select>
										</label>
										 <div class="my_form_error register"><?echo form_error('district')?></div>

										<div class="submit1">
											<button type="submit" class="done change" id="done">
												Thay đổi
											</button>
											<a href="<?echo base_url('index.php/thong-tin-dat-hang.html')?>" class="done my_btn" id="done">
												Xem đơn hàng đã mua
											</a>
											<a href="<?echo base_url()?>" class="done my_btn" id="done">
												Quay lại
											</a>
										</div>
									
										<div class="clearfix"></div>
									</div>
								</section>
						</form>						<!-- item2 -->
						</div>
						<!--Kết thúc thông tin đơn hàng-->
					
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

		</div>
</div>
</main>
