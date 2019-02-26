<main>

<?$this->load->view('site/message')?>
<?$this->load->view('site/breadcrumb',$this->data)?>
<?if(!empty($carts)):?>
	<div class="ss-content">
		<div class="container">
			<form action="<?echo base_url().'index.php/cart/index'?>" method="post" id="shopping-cart" name="shopping-cart">
				<div class="row">
					<div class="col-sm-11 col-sm-push-1">
						<h1> Đặt hàng</h1>
						<div class="row col-left">
							<div class="col-sm-8 check-left">
								<section class="checkout-form item1">
									<h4 class="title1 active ">1. Thông tin người mua</h4>
									<?if(isset($_SESSION['cus_login'])):?>
									<div class="checkout c1 b1" accept-charset="utf-8">
										<label>
											<span class="form-name">Họ tên: <i>*</i> </span> 
											<input type="text" name="name"  id="name" value="<?php echo $_SESSION['cus_name']?>" placeholder="Nhập họ và tên"/>
										</label>
										<div class="my_form_error"><?echo form_error('name')?></div>
										<label>
											<span class="form-name">Số điện thoại: <i>*</i> </span>
											<input type="text" name="phone" id="phone" placeholder="Nhập số điện thoại" value="<?php echo $_SESSION['cus_phone']?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('phone')?></div>
										<label>
											<span class="form-name">Địa chỉ Email: <i>*</i></span>
											<input type="email" name="email" placeholder="Nhập địa chỉ Email" value="<?php echo $_SESSION['cus_email']?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('email')?></div>
										<label>
											<span class="form-name">Địa chỉ: <i>*</i></span>
											<input type="text" name="address"  placeholder="Nhập địa chỉ" value="<?php echo $_SESSION['cus_address']?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('address')?></div>
										<label>
											<span class="form-name">Tỉnh thành: <i>*</i></span>
											<select class="form-control my_select" name="city" id="cities">
											<option value="0">--Chọn thành phố--</option>
											<?foreach($list_provinces as $provinces):?>
												<option <?if($_SESSION['cus_id_provices']==$provinces->id) echo "selected";?> value="<?echo $provinces->id?>"><?echo $provinces->title?></option>
											<?endforeach?>
											</select>
										</label>
										<div class="my_form_error"><?echo form_error('city')?></div>
										<label>
											<span class="form-name">Quận/Huyện: <i>*</i></span>
											<select name="district" class="form-control wards my_select" id="sel1">
											<option value="<?echo $info_wards->id?>"><?echo $info_wards->title?></option>
											</select>
										</label>
										<div class="my_form_error"><?echo form_error('district')?></div>
										
										<label>
											<span class="form-name">Yêu cầu:</span>
											  <textarea class="form-control" style="width:74%" name="required" rows="5" id="comment" class="myinput"></textarea>
										</label>
										<div class="clearfix"></div>
									</div>
									<?else:?>
									<div class="checkout c1 b1" accept-charset="utf-8">
										<label>
											<span class="form-name">Họ tên: <i>*</i> </span> 
											<input type="text" name="name" id="name" class="cart_input" value="<?php echo set_value('name')?>" placeholder="Nhập họ và tên"/>
										</label>
										<div class="my_form_error"><?echo form_error('name')?></div>
										<label>
											<span class="form-name">Số điện thoại: <i>*</i> </span>
											<input class="cart_input" type="text" name="phone" id="phone" placeholder="Nhập số điện thoại" value="<?php echo set_value('phone')?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('phone')?></div>
										<label>
											<span class="form-name">Địa chỉ Email: <i>*</i></span>
											<input class="cart_input" type="email" name="email" placeholder="Nhập địa chỉ Email" value="<?php echo set_value('email')?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('email')?></div>
										<label>
											<span class="form-name">Địa chỉ: <i>*</i></span>
											<input class="cart_input" type="text" name="address"  placeholder="Nhập địa chỉ" value="<?php echo set_value('address')?>"/>
										</label>
										<div class="my_form_error"><?echo form_error('address')?></div>
										<label>
											<span class="form-name">Tỉnh thành: <i>*</i></span>
											<select class="form-control my_select" name="city" id="cities">
											<option value="0">--Chọn thành phố--</option>
											<?foreach($list_provinces as $provinces):?>
												<option value="<?echo $provinces->id?>"><?echo $provinces->title?></option>
											<?endforeach?>
											</select>
										</label>
										<div class="my_form_error"><?echo form_error('city')?></div>
										<label>
											<span class="form-name">Quận/Huyện: <i>*</i></span>
											<select name="district" class="form-control wards my_select" id="sel1">
											<option value="0">--Chọn Quận/Huyện--</option>
											</select>
										</label>
										<div class="my_form_error"><?echo form_error('district')?></div>
										
										<label>
											<span class="form-name">Yêu cầu:</span>
											  <textarea class="form-control my_required" name="required" rows="5" id="comment" class="myinput"></textarea>
										</label>
										<div class="clearfix"></div>
									</div>
									<?endif;?>
								</section>
								<!-- item2 -->
								<section class="checkout-form item2 item3">
									<h4 class="title3 active">2. Thanh toán</h4>
									<div class="checkout c3" accept-charset="utf-8">
										<div class="my_radio">
											<div class="sub_radio">
											  <label><input checked type="radio" value="offline" name="payment">Thanh toán khi nhận hàng </label>
											</div>
										</div>
										<div class="submit1">
											<button type="submit" class="done" id="done">
												Đặt hàng
											</button>
											<a href="<?echo base_url()?>" class="done my_btn" id="done" >
												Mua tiếp
											</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</section>
							
						</div>
						<!--Thông tin đơn hàng-->
						<div class="col-sm-4 check-right">
							<div class="checkout-info">
							<h5>Thông tin đơn hàng</h5>
							<?foreach($carts as $cart):?>
								<div class="name-item col-sm-7 ">
									<p><?echo $cart['name']?></p>
								</div>
								<div class="price-item col-sm-5">
									<p><?echo number_format($cart['price'])?> ₫</p>
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-12 amount width80">
									<div class="up">
										<input id="demo0" type="tel" data-bts-min="1" data-bts-max="<?echo $cart['qty_product']?>" data-productid="<?echo $cart['id']?>" data-rowid="<?echo $cart['rowid']?>" data-rowid_product="<?echo 'qty_'.$cart['rowid']?>" value="<?echo $cart['qty']?>" name="qty_<?echo $cart['id']?>" class="quantity product_<?echo $cart['id']?>" >
										<div class="textt"><?echo $cart['style']?></div>
									</div>
								</div>
								<div class="btn-remove-cart"><span class="btn btn-danger btn-sm remove_cart" data-id="<?echo $cart['id']?>">X</span></div>
							<div class="clearfix"></div>
							<?endforeach;?>
							<!--Cập nhật giỏ hàng bằng AJAX-->
							<div id="subtotal_shopping_cart"></div>
							<!--Kết thúc Cập nhật giỏ hàng bằng AJAX-->
						
							</div>
						<div class="clearfix"></div>
						</div>
						<!--Kết thúc thông tin đơn hàng-->
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</form>

	</div>
</div>
<?else:?>
<style>
.pagenotfound
{
	text-align:center;
	margin:100px;
}
.text-found
{
	font-size:100;
}
</style>
<div class="pagenotfound">
	<div class="row">
		<div class="error-template">
			<h1 class="text-found"><strong><i class="fas fa-shopping-cart"></i> giỏ hàng rỗng :(</strong></h1>
			<h2 class="text-primary"><strong>Bạn vui lòng thêm sản phẩm vào giỏ hàng</strong></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="error-actions">
				<a href="<?echo base_url()?>" class="btn btn-warning btn-lg btn-block">
					<i class="fas fa-home"></i> Trở về trang chủ
				</a>
			</div>
		</div>
	</div>
</div>
<?endif;?>
</main>
<script>
//Danh sách các tỉnh thành.
$(document).ready(function(){
	$('#cities').click(function(){
		var provinve = $('#cities').val();
		$.ajax({
			url : "<?php echo base_url('index.php/cart/wards')?>",
			method : "post",
			data : {provinve : provinve},
			success :function(data){
				$('.wards').html(data);
				}
		});
	});
});


</script>
<script type="text/javascript">
$("input[id='demo0']").TouchSpin();
</script>
<script type="text/javascript">
//Cập nhật giỏ hàng bằng ajax
$(document).ready(function(){
	$('.quantity').on('change',function(){
			var quantity = $(this).val();
			var row_id = $(this).data("rowid"); 
			$.ajax({
				url : "<?php echo base_url('index.php/cart/update');?>",
				method : "POST",
				data : {row_id : row_id, quantity: quantity},
				success :function(data){
					$('#subtotal_shopping_cart').html(data);
					}
				});
			});
	$('#subtotal_shopping_cart').load("<?php echo base_url('index.php/cart/load_cart');?>");	
	});
	
</script>
<script>
$(document).on('click','.remove_cart',function(){
	var id = $(this).data("id");
	alertify.confirm('Thông báo!', 'bạn có chắc sẽ xóa sản phẩm được chọn',  function Redirect() {
               window.location="<?echo base_url('index.php/cart/delete_cart/')?>"+id;
            }
	, function(){ alertify.error('Sản phẩm của bạn đã được giữ lại')});
});
</script>