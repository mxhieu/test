<main>
<?$this->load->view('site/breadcrumb',$this->data)?>

	<div class="ss-category-tpcn-list-grid">
		<div class="container">
			<div class="row ">
				<div class="col-sm-15 dm">
		<div class="row">
		<div class="col-xs-10" style="padding:0;">
			<div class="title">
				<h4>DANH MỤC SẢN PHẨM</h4>
			</div>
			<div class="item">
				<ul>
				<?foreach($list_catalog as $cat):?>
					<?foreach($cat->subs as $sub):?>
					<li class="active" >
						<a href="<?echo base_url('index.php/').$sub->slug.'-c'.$sub->id?>"><?echo $sub->name?></a>
						<ul>
						<?foreach($sub->subs as $last_sub):?>
							<li>
								<a href="<?echo base_url('index.php/').$last_sub->slug.'-c'.$last_sub->id?>"><?echo $last_sub->name?></a>
							</li>
							<li>
								<a id="more" href="<?echo base_url('index.php/').$sub->slug.'-c'.$sub->id?>"><i class="fas fa-caret-right"></i>Xem tất cả</a>
							</li>
						<?endforeach;?>
						</ul>
					</li>
					<?endforeach;?>
				<?endforeach;?>
				</ul>
			</div>
		</div>
	</div>
</div>
				<div class="col-sm-100 col-xs-12 sp">
					<div class="row">
						<h1><a href="<?echo base_url()?>" class="pull-left"><img src="<?echo base_url().'public/img/'?>left-arrow.png"></a><?if($type=='tp1'){ echo "Sản phẩm bán chạy";}else echo "Sản phẩm mới";?></h1>

						<div class="clearfix"></div>

						<div class="pull row">
						

						</div>

						<div class="tab-content">
							<div id="tabsp-1" class="tab-content-bcn tab-content-item current">
								<!--Sản phẩm nè-->
								
								<?foreach($list_product as $product):?>
								<?$name_cat = convert($product->id_cat,'catalog_model','','slug',false)?>
								<div class="prd col-sm-3 col-xs-6  grid-group-item ">
									<a href="<?echo base_url('index.php').$name_cat.'/'.$product->slug.'-c'.$product->id_cat.'p'.$product->id?>.html">
										<div class="thumbnail">
											<img src="<?echo base_url().'upload/product/'.$product->image?>" class="list-group-image" alt="Nattocerebest - Viên Uống Bổ Não Trợ Tim">
											<div class="caption">
												<h3 class="name-item">
													<?echo $product->name?>
													<span>(<?echo $product->style?>)</span>
												</h3>
												<span class="box">
													<?echo $product->style?>
												</span>
												<div class="price">
													<?echo number_format($product->price)?> <u>₫</u>
												</div>
												
												<p class="detail">
													<?echo $product->description?>...
												</p>
											</div>
										</div>
									</a>
								</div>
								<?endforeach;?>
								<!--kết thúc Sản phẩm nè-->
							</div>
							<div id="tabsp-2" class="tab-content-new tab-content-item">
							</div>
					</div>
					
					<div class="clearfix"></div>
					<!--Phân trang á-->
					<?echo $this->pagination->create_links()?>
					<!--Kết thúc Phân trang á-->
						<div class="pagination2 row">
							<a id="prev" href=""  onclick="return false" >
								<img src="<?echo base_url().'public/img/'?>left_arrow.png" alt="">
							</a>
							<div class="page" class="pull-center">
								<div class="cls2">1</div>
							</div>
							<a id="next" class="pull-right" href="https://nhathuoclongchau.com/thuc-pham-chuc-nang/than-kinh-nao?orderby=boost-desc&amp;type=grid&amp;page=2" >
								<img src="<?echo base_url().'public/img/'?>right_arrow.png" alt="">
							</a>
						</div>
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
</main>