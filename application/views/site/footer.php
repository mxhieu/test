<footer>
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-left">	
			<h3>Cao Đẳng Kỹ Thuật Cao Thắng </h3>
			<p>Đồ án tốt nghiệp đề tài: tìm hiểu và xây dựng website bán thực phẩm chức năng bằng ngôn ngữ php(framework Codeigniter).</p>
			<p>Thực hiện bởi Mai Xuân Hiếu và Nguyễn Minh Thiệt</p>
			</div>
			<div class="col-sm-3 col-right">
				<h3 class="text-center">Kết nối với chúng tôi</h3>
				
				<div class="icon">
					<div class="icon1 fb">
						<div class="fbicon">
							<span>
								<a href="<?=$fanpage?>" target="_blank" rel="nofollow"><img src="<?echo public_url('img/')?>fbicon.png" width="32px" height="32px;" alt=""></a>
							</span>
						</div>
					</div>
					<div class="icon1">
						<div class="fbicon">
							<span>
								<a href="#" rel="nofollow"><img src="<?echo public_url('img/')?>ytbicon.png" width="32px" height="32px;" alt="Nhà thuốc H&T - Hệ thống chuỗi nhà thuốc lớn, hiện đại"></a>
							</span>
						</div>
					</div>
					<div class="icon1">
						<div class="fbicon">
							<span>
								<a href="#" rel="nofollow"><img src="<?echo public_url('img/')?>zaloicon.png" width="32px" height="32px;" alt="Nhà thuốc H&T - Hệ thống chuỗi nhà thuốc lớn, hiện đại"></a>
							</span>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="hotline text-center">
				</div>		
			</div>
		</div>
	</div>
</footer>

<script type="text/javascript">
	$(document).ready(function () {
	    $(window).scroll(function () {
	        var location = $(window).scrollTop();
	        if (location >= 1000) {
	            $(".r33 .nav-fix").addClass("fix-top");
	        }
	        else {
	            $(".r33 .nav-fix").removeClass("fix-top");
	        }
	    })
	    $('.slider-for').slick({
	        slidesToShow: 1,
	        slidesToScroll: 1,
	        arrows: false,
	        fade: true,
	        asNavFor: '.slider-nav',
	        responsive: [
	            {
	                breakpoint: 1024,
	                settings: {
	                    slidesToShow: 1,
	                    slidesToScroll: 1,
	                    prevArrow: '<div class="btn-left"><img src="<?echo public_url('img/')?>left_arrow.png" alt=""></span><span class="sr-only">Prev</span></div>',
	                    nextArrow: '<div class="btn-right"><img src="<?echo public_url('img/')?>right_arrow.png" alt=""><span class="sr-only">Next</span></div>',
	                    arrows: true
	                }
	            }
	        ]
	    });
	    $('.slider-nav').slick({
	        infinite: true,
	        slidesToShow: 4,
	        slidesToScroll: 1,
	        asNavFor: '.slider-for',
	        arrows: false,
	        // centerMode: true,
	        focusOnSelect: true
	    });
	});
</script>

<script>
$("input[id='demo0']").TouchSpin();
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
<script>
//Danh sách các tỉnh thành.
$(document).ready(function(){
	$('#cities1').click(function(){
		var provinve = $('#cities1').val();
		$.ajax({
			url : "<?php echo base_url('index.php/cart/wards_index')?>",
			method : "POST",
			data : {provinve : provinve},
			success :function(data){
				$('.wards').html(data);
				}
		});
	});
});


</script>


