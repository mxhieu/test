<main>
<?$this->load->view('site/breadcrumb',$this->data)?>
	<div class="container tpcn-filter-title">
		<div class=" row row1">
			<div class="title t1">
				<h1><?echo $info_catalog->name?></h1>
			</div>
		</div>
	</div>
	<?if(!empty($catalog_subs)):?>
	<div class="banner">
		<a><img style="width: 100%" src="<?echo public_url().'img'?>/banner.png" alt=""></a>
	</div>
	<?endif;?>
	<!--Danh mục phía dưới hình ảnh Banner-->
	<?if(is_array($list_subcatalog)):?>
	<div class="view-category-tpcn">
		<div class="container ctn">
			<div class="row row1">
				<h2>Xem theo danh mục</h2>
			</div>
			<div class="clearfix"></div>
			
			<div class=" row row1">
				<?foreach($list_subcatalog as $subcatalog):?>
				<div class="col-xs-12 col-sm-15 ctg">
					<a href="<?echo base_url().'index.php/'.$subcatalog->slug.'-c'.$subcatalog->id?>" class="thumbnail">
						<img src="<?echo base_url('upload/catalog/').$subcatalog->image?>" alt="<?echo $subcatalog->name?>">
						<h2 class="text-center"><?echo $subcatalog->name?></h2>
					</a>
				</div>
				<?endforeach;?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<?endif;?>
	<div class="ss-category-tpcn">
		<div class="container">
			<div class="row">
			<div class="col-sm-15 dm">
				<div class="row">
					<div class="col-xs-10" style="padding:0;">
						<div class="title">
							<h4>DANH MỤC SẢN PHẨM</h4>
						</div>
						<div class="item">
							<ul>
							<?foreach($catalog_list as $catalog):?>
								<li  class="active" >
									<?foreach($catalog->subs as $subs):?>
									<a href="<?echo base_url('index.php/').$subs->slug.'-c'.$subs->id?>"><?echo $subs->name?></a>
									<ul>
										<?foreach($subs->subs as $last_subs):?>
										<li >
											<a href="<?echo base_url('index.php/').$last_subs->slug.'-c'.$last_subs->id?>"><?echo $last_subs->name?></a>
										</li>
										<?endforeach;?>
										<li>
											<a id="more" href="<?echo base_url('index.php/').$subs->slug.'-c'.$subs->id?>"><i class="fas fa-caret-right"></i>Xem tất cả</a>
										</li>
									</ul>
									<?endforeach;?>
								</li>
							<?endforeach;?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-100 col-xs-12 bcn">
				<?if(!empty($catalog_subs)):?>
				<div class="row">
					<h2>Bán chạy nhất</h2>
				</div>
				<?else:?>
				<div class="row">
					<?if($total==0):?>
					<h2>Không có sản phẩm "<?echo $info_catalog->name?>"</h2>
					<?else:?>
					<h2><?echo $info_catalog->name?> có <?echo $total?> sản phẩm</h2>
					<?endif;?>
				</div>
				<?endif;?>
				<div class="products">
						<?foreach($list_product as $product):?>
						<?$name_cat = convert($product->id_cat,'catalog_model','','slug',false);?>
						<div class="col-sm-3 col-xs-6 thumb">
							<a href="<?echo base_url('index.php/').$name_cat.'/'.$product->slug.'-c'.$product->id_cat.'p'.$product->id?>.html">
								<div class="thumbnail">
									<img src="<?echo base_url('upload/product/').$product->image?>" alt="<?echo $product->name?>">
									<div class="caption">
										<h3><?echo $product->name?></h3>
										<span>
											<?echo $product->style?>
										</span>
										<div class="price">
											<?echo number_format($product->price)?> <u>₫</u>
										</div>
									</div>
								</div>
							</a>
						</div>
						<?endforeach;?>
				</div>
				<div class="clearfix"></div>
				
				<?echo $this->pagination->create_links()?>
				
								
				<div class="feature">
					<div class="row row1">
					<p style="text-align: justify;"><strong>Thực phẩm chức năng c&oacute; c&ocirc;ng dụng ch&iacute;nh trong việc hỗ trợ v&agrave; tăng cường sức khỏe cho cơ thể với c&aacute;c ưu điểm sau đ&acirc;y:</strong></p>
					<ul style="margin-left: 40px;">
						<li style="text-align: justify;">Bổ sung nhanh ch&oacute;ng chất dinh dưỡng cho một cơ quan hoặc to&agrave;n cơ thể.</li>
						<li style="text-align: justify;">Dinh dưỡng trong thực phẩm chức năng l&agrave; c&aacute;c chất cơ thể kh&ocirc;ng tự sản sinh được hoặc chế độ ăn kh&ocirc;ng thể cung cấp đủ.</li>
						<li style="text-align: justify;">C&oacute; nguồn gốc tự nhi&ecirc;n, được kiểm định chất lượng n&ecirc;n an to&agrave;n to&agrave;n với sức khỏe.</li>
						<li style="text-align: justify;">T&ugrave;y theo nhu cầu v&agrave; đối tượng sử dụng, c&oacute; thể lựa chọn sản phẩm ph&ugrave; hợp với t&igrave;nh trạng cơ thể.</li>
					</ul>
					<p style="text-align: justify;"><meta charset="utf-8" /></p>
					<p dir="ltr" style="text-align: justify;">Thực phẩm chức năng chỉ c&oacute; t&aacute;c dụng hỗ trợ sức khỏe, kh&ocirc;ng c&oacute; t&aacute;c dụng thay thế thuốc chữa bệnh.</p>
					</div>
				</div>		
				</div>
			</div>
		</div>
	</div>
</div>
</main>