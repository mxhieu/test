<main>
<div class="bread search-result-br">
    <div class="container container11">
        <ol class="breadcrumb">
            <li>
                <a href="https://nhathuoclongchau.com">Trang chủ</a>
            </li>
            <li class="active">Chuyên đề</li>
        </ol>
    </div>
</div>
<div class="ss-search-result-title">
    <div class="container">
        <div class=" row row1 sr-rsl">
            <div class="title">
                <h1><span><i class="fas fa-hashtag"></i></span><strong> <?echo '"'.$key.'"'.' có '.$total?> kết quả</strong></h1>
            </div>
        </div>
    </div>
</div>
<div class="ss-control ss-search-tag"></div>
<div class="ss-content">
    <div class="container">
        <div class="row">
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="row r-item">
                        
                        <div class="row r-item">
							<div class="list-all">
							<?foreach($list_news as $news):?>
								<div class="col-sm-9 col-xs-12 item news benhlist">
									<article>
										<div class="left col-sm-10">
											<a href="<?echo base_url('index.php/').'bai-viet/'.$news->slug.'-n'.$news->id?>.html"><h3><?echo $news->name?></h3></a>
												<span class="btn-category">danh mục</span>
												<span><?echo date('d/m/Y',$news->created)?></span>
											<p class="detail"><?echo $news->description?></p>
										</div>
									</article>
								</div>
							<?endforeach;?>
								<!--<div class="col-sm-9 col-xs-12 view loadmore2 benh">
									<a href="">Xem thêm 7 kết quả</a>
								</div>-->
							</div>
						</div>                    
					</div>
                </div>
            </div>
        </div>
    </div>
</div>	
</main>