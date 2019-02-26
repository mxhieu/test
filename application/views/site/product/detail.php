
<main>
<!--breadcrumb-->
<?$this->load->view('site/breadcrumb',$this->data)?>
<div id="main" class="ss-tpcn-cogia">
		<div class="container">
			<div class="product">
				<div class="col-sm-8 col-sm-push-2 padd">
					<div class="row r11">
						<h1><?echo $info_product->name?></h1>

					</div>
					<div class="clearfix"></div>
					<div class="row r1">
						<div class="catogory pull-left">
							Danh mục:  <a href="<?echo base_url('index.php/').$info_catalog->slug.'-c'.$info_catalog->id?>.html"><?echo $info_catalog->name?></a>
						</div>
					</div>
					<div class="row r2">
						<div class="col-sm-6 col-xs-12 slide">
							<div class="slider-for">
							<?foreach($image_list as $img):?>
								<div><img src="<?echo base_url('upload/product/').$img?>" alt="<?echo $info_product->name?>"></div>
							<?endforeach;?>
							</div>
							<div class="slider-nav slide-hide" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
								<?foreach($image_list as $img):?>
								<div><img src="<?echo base_url('upload/product/').$img?>" alt="<?echo $info_product->name?>"></div>
								<?endforeach;?>
							</div>
						</div>
					<div class="col-sm-6 col-xs-12 detail">
						<p class="price">Giá bán:  <span><?echo number_format($info_product->price)?> ₫</span> / <?echo $info_product->style?></p>
						 <p class="qc">Quy cách:  <span> <?echo $info_product->style?> </span></p> 	
						 <p class="xx">Xuất xứ:  <span> <?echo $info_product->origin?></span></p> 
						 <div class="ct"><p><?echo $info_product->description?></p></div>
						 <?if($info_product->quantity > 0):?>
						 <form action="<?echo base_url('index.php/cart/add/').$info_product->id?>" method="GET">
							<div class="up">
								<div class="textt">Số lượng</div>
								<div class="input-group bootstrap-touchspin">
									<span class="input-group-btn input-group-prepend">
										<button class="btn btn-success bootstrap-touchspin-down" type="button">-</button>
									</span>
									<span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend" style="display: none;">
									<span class="input-group-text"></span>
									</span>
									<input id="demo0" type="text" value="1" name="qty" data-bts-min="1" data-bts-max="<?echo $info_product->quantity?>" data-bts-init-val="" data-bts-step="1" data-bts-decimal="0" data-bts-step-interval="100" data-bts-force-step-divisibility="round" data-bts-step-interval-delay="500" data-bts-prefix="" data-bts-postfix="" data-bts-prefix-extra-class="" data-bts-postfix-extra-class="" data-bts-booster="true" data-bts-boostat="10" data-bts-max-boosted-step="false" data-bts-mousewheel="true" data-bts-button-down-class="btn btn-success" data-bts-button-up-class="btn btn-success" class="form-control" style="display: block;">
									<span class="input-group-addon bootstrap-touchspin-postfix input-group-append" style="display: none;">
									<span class="input-group-text"></span>
									</span>
									<span class="input-group-btn input-group-append">
									<button class="btn btn-success bootstrap-touchspin-up" type="button">+</button></span>
								</div>
							</div>

							<div class="btn-down">
								<button style="padding:10px 100px" class="button btn-left text-center btn-l" type="submit" onclick="return buysuccess()">
									<img src="<?echo public_url('img')?>/ic-add-shopping-cart-black-24-px@2x.png" width="23px" height="23px" alt="Mua ngay"> Mua ngay
								</button>
	
							</div>
						</form>
						<?else:?>
						<p style="color:red;font-weight:bold;font-size:20">Sản phẩm đang được thêm số lượng.</p>
						<?endif;?>
						<div class="call text-center">
							<p>Hoặc</p>
							<span>
								<a href="#">
									Gọi <?=$phone?>
								</a>
							</span>
							<p>(Được tư vấn)</p>
						</div>
						<div class="item-rule col-sm-12">
							<h6>Nhà thuốc cam kết</h6>
							<ul>
								<li><img src="<?echo public_url('img/')?>grp-17.png" alt="Đổi trả trong 30 ngày kể từ ngày mua hàng">Đổi trả trong 30 ngày kể từ ngày mua hàng</li>
								<li><img src="<?echo public_url('img/')?>grp-19.png" alt="Miễn phí 100% đổi thuốc">Miễn phí 100% đổi thuốc</li>
								<li><img src="<?echo public_url('img/')?>grp-18.png" alt="Miễn phí giao hàng nội thành TP.HCM">Miễn phí giao hàng nội thành TP.HCM</li>
							</ul>
						</div>
					</div>
						<div class="clearfix"></div>
					</div>
					<div class="row r33">
						<div class="nav-fix">
							<ul class="nav-control">
								<li class="active"><a href="#mo-ta">Mô tả</a></li>
								<?if($info_product->element!=''):?>
								<li><a href="#thanh-phan">Thành phần</a></li>
								<?endif;?>
								<?if($info_product->uses!=''):?>
								<li><a href="#cong-dung">Công dụng</a></li>
								<?endif;?>
								<?if($info_product->usage_medicine!=''):?>
								<li><a href="#lieu-dung">Liều dùng</a></li>
								<?endif;?>
								<?if($info_product->note!=''):?>
								<li><a href="#luu-y">Lưu ý</a></li>
								<?endif;?>
								<?if($info_product->style!=''):?>
								<li><a href="#quy-cach">Quy cách</a></li>
								<?endif;?>
								<li><a href="#nha-san-xuat">Nhà sản xuất</a></li>
							</ul>
						</div>
					</div>
					<div class="row r3">
					<div class="tab-content">
						<h2>Mô tả </h2>
						<div id="mo-ta">
							<div class="normal">
							<?echo $info_product->content?>
						</div>
					</div>
					</div>
					<div class="content">
					<?if($info_product->element!=''):?>
					<div class="tp" id="thanh-phan" >
						<h2>Thành phần </h2>
						<div class="normal">
							<?echo $info_product->element?>
						</div>
					</div>
					<?endif;?>
					<?if($info_product->uses!=''):?>
					<div class="clearfix"></div>
					<div class="tp2" id="cong-dung">
						<h2>Công dụng</h2>
						<div class="normal">
						<?echo $info_product->uses?>
						</div>
					</div>
					<?endif;?>
					<?if($info_product->usage_medicine!=''):?>
					<div class="tp3" id="lieu-dung">
						<h2>Liều dùng</h2>
						<div class="normal">
						<?echo $info_product->usage_medicine?>
						</div>
					</div>
					<?endif;?>
					<?if($info_product->note!=''):?>
					<div class="tp4" id="luu-y">
						<h2>Lưu ý</h2>
						<div class="normal">
						<?echo $info_product->note?>
						</div>
					</div>
					<?endif;?>
					<?if($info_product->style!=''):?>
					<div class="tp3" id="quy-cach">
						<h2>Quy cách</h2>
						<div class="normal">
						<?echo $info_product->style?>
						</div>
					</div>
					<?endif;?>
					<div class="tp5" id="nha-san-xuat">
						<h2>Nhà cung cấp</h2>
						<div class="normal">
						<?echo convert($info_product->id_provider,'provider_model','','name',false)?>
						</div>
					</div>
					</div>
					<div class="fb-comments" data-href="<?echo current_url()?>" data-width="800" data-numposts="5"></div>
					<div class="tag">
						<span>Tags</span>
							<?echo $tag_product?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script>
	var btnInit = function disabledButton(){
	       var value = parseInt($("#demo0").val());
	       if(value>1){
	           $('button.bootstrap-touchspin-down').prop('disabled',false);
	       }else{

	           $('button.bootstrap-touchspin-down').prop('disabled',true);
	       }
	   }();
	   $("input[id='demo0']").on({
	       "change": function(e){
	           var value = parseInt($(this).val());
	           if(value>1){
	               $('button.bootstrap-touchspin-down').prop('disabled',false);
	           }else{
	               $('button.bootstrap-touchspin-down').prop('disabled',true);
	           }
	       },
	   });
</script>
