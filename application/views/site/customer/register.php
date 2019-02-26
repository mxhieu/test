<main>
<?$this->load->view('site/breadcrumb',$this->data)?>
	<div class="ss-content">
		<div class="container" >
			<form action="<?echo base_url().'index.php/customer/register'?>" method="post" >
				<div class="row">
					<div class="col-sm-11 col-sm-push-1">
						<h1> Đăng kí tài khoản </h1>
						<div class="row col-left">
							<div class="col-sm-8 check-left" style="width:100%">
								<section class="checkout-form item1">
									<h4 class="title1 active ">1. Thông tin khách hàng</h4>
									<div class="checkout c1 b1 my_contact" accept-charset="utf-8">
										<label class="my_col" >
											<span class="form-name">Họ tên: <i>*</i> </span> 
											<input type="text" name="name"  id="name" value="<?echo set_value('name')?>" placeholder="Nhập họ và tên" class="in1" />
										</label>
										<div class="my_form_error register"><?echo form_error('name')?></div>
										<label  class="my_col">
											<span class="form-name">Tài khoản: <i>*</i> </span>
											<input type="text" name="username"  id="username" placeholder="Nhập tài khoản" class="in2" value="<?echo set_value('username')?>"/>
										</label>
										<div class="my_form_error register"><?echo form_error('username')?></div>
										<label class="my_col">
											<span class="form-name">Mật khẩu: <i>*</i> </span>
											<input type="password" class="my_required" name="password"  id="password" placeholder="Nhập mật khẩu" class="in2" value=""/>
										</label>
										<div class="my_form_error register"><?echo form_error('username')?></div>
										<label class="my_col">
											<span class="form-name">Nhập lại mật khẩu: <i>*</i> </span>
											<input type="password" class="my_required" name="repassword"  id="repassword" placeholder="Nhập lại mật khẩu" class="in2" value=""/>
										</label>
										<div class="my_form_error register"><?echo form_error('repassword')?></div>
										<label class="my_col">
											<span class="form-name">Số điện thoại: <i>*</i> </span>
											<input type="text" name="phone"  id="phone" placeholder="Nhập số điện thoại" class="in2" value="<?echo set_value('phone')?>"/>
										</label>
										<div class="my_form_error register"><?echo form_error('phone')?></div>
										<label class="my_col">
											<span class="form-name">Email: <i>*</i></span>
											<input type="email" name="email"  placeholder="Nhập địa chỉ Email" value="<?echo set_value('email')?>"/>
										</label>
										<div class="my_form_error register"><?echo form_error('email')?></div>
										<label class="my_col">
											<span class="form-name">Địa chỉ: <i>*</i></span>
											<input type="text" name="address"  placeholder="Nhập địa chỉ" value="<?echo set_value('address')?>"/>
										</label>
										<div class="my_form_error register"><?echo form_error('address')?></div>
										<label class="my_col">
											<span class="form-name">Tỉnh thành: <i>*</i></span>
											<select class="form-control my_select" name="city" id="cities1">
											<option value="0">--Chọn thành phố--</option>
											<?foreach($list_provinces as $provinces):?>
												<option value="<?echo $provinces->id?>"><?echo $provinces->title?></option>
											<?endforeach?>
											</select>
										</label>
										<div class="my_form_error register"><?echo form_error('city')?></div>
										<label class="my_col">
											<span class="form-name">Quận/Huyện: <i>*</i></span>
											<select name="district" class="form-control wards my_select" >
											<option value="0">--Chọn Quận/Huyện--</option>
											</select>
										</label>
										 <div class="my_form_error register"><?echo form_error('district')?></div>

										<div class="submit1">
											<button type="submit" class="done" id="done">
												Đăng kí
											</button>
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
