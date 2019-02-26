<main>
<?$this->load->view('site/breadcrumb')?>
	<?if($total!=0 && is_array($list_product)):?>
	<div class="ss-search-result-title">
		<div class="container">
			<div class=" row row1 sr-rsl col-md-12">
				<div class="title">
					<h1>Kết quả tìm kiếm của <strong>"<?echo $key?>"</strong> Có <?echo $total?> sản phẩm</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="ss-content">
    <div class="container">
        <div class="row">
            <div class="tab-content">

				<div id="thuoc" class="tab-pane fade in active">
							<div class="row">

							<div class="list-all">
							<?foreach($list_product as $product):?>
							<?$name_cat = convert($product->id_cat,'catalog_model','','slug',false)?>
								<div class="col-sm-9 col-xs-12 item tpcn">
									<article>
										<div class="left col-sm-10 col-xs-9">
											<a href="<?echo base_url('index.php/').$name_cat.'/'.$product->slug.'-c'.$product->id_cat.'p'.$product->id?>.html"><h3><?echo $product->name?></h3><div class="price"><?if($product->quantity > 0){echo number_format($product->price).' ₫';}else echo "Đã hết";?> <u></u></div></a>
											<span class="btn-category"><?echo $product->cat_name?></span>
											<span class="quy-cach-search"><?echo $product->style?> </span>
											<div class="detail"><?echo $product->description?>...</div>
											
										</div>
										<div class="right col-sm-2 col-xs-3">
											<img src="<?echo base_url('upload/product/').$product->image?>">
										</div>
									</article>                    
								</div>
							<?endforeach;?>
								<div class="clearfix"></div>
								<div class='pagination'>
									 <? echo $this->pagination->create_links()?>
								</div>
								<div class="col-xs-12 pagi2">
								</div>
							</div>
						</div>
					</div>                
			</div>
        </div>
    </div>
</div>            

	<?else:?>
	
<div class="ss-search-no-result-content">
    <div class="container">
        <div class="row">
            <div class="content">
                <p>Rất tiếc, chúng tôi không tìm thấy kết quả cho từ khóa <strong style="word-break: break-all">"<?echo $key?> "</strong></p>
            </div>
            <div class="list-item">
                <p>Hãy thử lại bằng cách:</p>
                <ul>
                    <li>Kiểm tra lỗi chính tả của từ khóa đã nhập</li>
                    <li>Thử lại bằng từ khóa khác</li>
                    <li>Thử lại bằng những từ khóa tổng quát hơn</li>
                    <li>Thử lại bằng những từ khóa ngắn gọn hơn</li>
                </ul>
            </div>
        </div>
    </div>
</div>
	<?endif;?>
</main>