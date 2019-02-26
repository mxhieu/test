<main>
<?$this->load->view('site/breadcrumb',$this->data)?>
	<div class="ss-content">
		<div class="container" style="margin-left:20px!important;">
			<form action="<?echo base_url().'index.php/contact/add_contact'?>" method="post" id="shopping-cart" name="shopping-cart">
				<div class="row">
					<div class="col-sm-11 col-sm-push-1">
						<h1> Ý KIẾN KHÁCH HÀNG </h1>
						<div class="row col-left">
							<div class="col-sm-8 check-left">
								<section class="checkout-form item1">
									<h4 class="title1 active ">1. Thông tin và ý kiến</h4>
									<?if(isset($_SESSION['cus_login'])):?>
									<div class="checkout c1 b1 my_contact" accept-charset="utf-8">
										<label>
											<span class="form-name">Họ tên: <i>*</i> </span> 
											<input type="text" name="name"  id="name" value="<?echo $_SESSION['cus_name']?>" placeholder="Nhập họ và tên" class="in1" />
										</label>
										<div class="my_form_error"><?echo form_error('name')?></div>
										<label>
											<span class="form-name">Số điện thoại: <i>*</i> </span>
											<input type="text" name="phone"  id="phone" placeholder="Nhập số điện thoại" class="in2" value="<?echo $_SESSION['cus_phone']?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('phone')?></div>

										<label>
											<span class="form-name">Địa chỉ Email: <i>*</i></span>
											<input type="email" name="email"  placeholder="Nhập địa chỉ Email" value="<?echo $_SESSION['cus_email']?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('email')?></div>
										<label>
											<span class="form-name">Địa chỉ: <i>*</i></span>
											<input type="text" name="address"  placeholder="Nhập địa chỉ" value="<?echo $_SESSION['cus_address']?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('address')?></div>
										<label>
											<span class="form-name">Ý kiến:</span>
											  <textarea class="form-control" style="width:74%" name="content" rows="5" id="content"><?echo set_value('content')?></textarea>
										</label>
										 <div class="my_form_error"><?echo form_error('content')?></div>

										<div class="submit1">
											<button type="submit" class="done" id="done">
												Gửi ý kiến
											</button>
										</div>
										<div class="clearfix"></div>
									</div>
								<?else:?>
								<div class="checkout c1 b1 my_contact" accept-charset="utf-8">
										<label>
											<span class="form-name">Họ tên: <i>*</i> </span> 
											<input type="text" name="name"  id="name" value="<?echo set_value('name')?>" placeholder="Nhập họ và tên" class="in1" />
										</label>
										<div class="my_form_error"><?echo form_error('name')?></div>
										<label>
											<span class="form-name">Số điện thoại: <i>*</i> </span>
											<input type="text" name="phone"  id="phone" placeholder="Nhập số điện thoại" class="in2" value="<?echo set_value('phone')?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('phone')?></div>

										<label>
											<span class="form-name">Địa chỉ Email: <i>*</i></span>
											<input type="email" name="email"  placeholder="Nhập địa chỉ Email" value="<?echo set_value('email')?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('email')?></div>
										<label>
											<span class="form-name">Địa chỉ: <i>*</i></span>
											<input type="text" name="address"  placeholder="Nhập địa chỉ" value="<?echo set_value('address')?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('address')?></div>
										<label>
											<span class="form-name">Ý kiến:</span>
											  <textarea class="form-control" style="width:74%" name="content" rows="5" id="content"><?echo set_value('content')?></textarea>
										</label>
										 <div class="my_form_error"><?echo form_error('content')?></div>

										<div class="submit1">
											<button type="submit" class="done" id="done">
												Gửi ý kiến
											</button>
										</div>
										<div class="clearfix"></div>
									</div>
								<?endif;?>
								</section>
						</form>						<!-- item2 -->
						</div>
						<div class="col-sm-4 check-right">
							<div class="checkout-info">
							<h5>Bản đồ cửa hàng</h5>
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.1546104692043!2d106.59561231457216!3d10.79946799230588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752b893a1f15d7%3A0xfeb18e42922122e9!2zVHLhuqFtIGPDom4gc-G7kSAx!5e0!3m2!1svi!2s!4v1529396515260" width="400" height="400" frameborder="0" style="border:0;display:inline-block" allowfullscreen></iframe>
		
							</div>
						<div class="clearfix"></div>
						</div>
						<!--Kết thúc thông tin đơn hàng-->
					
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

		</div>
</div>
</main>
