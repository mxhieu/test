<?$this->load->view('admin/message')?>	
	<div class="graphs">
			<div class="col_3">
				<div class="col-md-3 widget widget1">
					<div class="r3_counter_box">
						<i style="color:#8BC34A" class="fa fa-capsules"></i>
						<div class="stats">
						  <h5><?echo $total_product?> <span>sản phấm đang bán</span></h5>
						  <div class="grow">
							<p>Sản phẩm</p>
						  </div>
						</div>
					</div>
				</div>
				<div class="col-md-3 widget widget1">
					<div class="r3_counter_box">
						<i class="fa fa-users"></i>
						<div class="stats">
						  <h5><?echo $total_members?> <span> đang hoạt động</span></h5>
						  <div class="grow grow1">
							<p>Tài khoản</p>
						  </div>
						</div>
					</div>
				</div>
				<div class="col-md-3 widget widget1">
					<div class="r3_counter_box">
						<i style="color:#F44336" class="fa fa-shopping-cart"></i>
						<div class="stats">
						  <h5><?echo $total_orders?> <span>đơn hàng mới</span></h5>
						  <div class="grow grow3">
							<p>Đơn hàng</p>
						  </div>
						</div>
					</div>
				 </div>
				 <div class="col-md-3 widget">
					<div class="r3_counter_box">
						<i style="color:#FFCA28" class="fa fa-envelope"></i>
						<div class="stats">
						  <h5><?echo $total_contact?> <span>Ý kiến mới</span></h5>
						  <div class="grow grow2">
							<p>Ý kiến</p>
						  </div>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>

	<!-- switches -->
<div class="switches">
	<div class="col-4">
		<div class="col-md-4 switch-right">
			<div class="switch-right-grid">
				<div class="switch-right-grid1">
					<h3>Doanh thu trong ngày <?echo $day?></h3>
					
					<ul>
						<li>Tổng tiền: <?echo number_format($total_day)?> vnđ</li>
						<li>Số lượng đã bán: <?echo $sale_day?> sản phẩm</li>
						
					</ul>
				</div>
			</div>
			<div class="sparkline" style="background:white;box-shadow: 0 1px 3px 0px rgba(0, 0, 0, 0.2);">
				<canvas id="myChart" height="187" width="600" style="width: 480px; height: 150px;"></canvas>
				<script>
				var ctx = document.getElementById("myChart").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: ["0h -> 8h", "8h -> 16h", "16h -> 24h"],
						datasets: [{
							label: '# đơn vị vnđ',
							data: [<?echo $total_h_1_8?>, <?echo $total_h_9_16?>, <?echo $total_h_17_24?>],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						}
					}
				});
				</script>
			</div>
		</div>
		<div class="col-md-4 switch-right">
			<div class="switch-right-grid">
				<div class="switch-right-grid1">
					<h3>Doanh thu trong tháng <?echo $month?></h3>
					
					<ul>
						<li>Tổng tiền: <?echo number_format($total_month)?> vnd</li>
						<li>Đã bán: <?echo ($sale_month)?> sản phẩm</li>
					
					</ul>
				</div>
			</div>
				<div class="sparkline" style="background:white;box-shadow: 0 1px 3px 0px rgba(0, 0, 0, 0.2);">
				<canvas id="myLine" height="187" width="600" style="width: 480px; height: 150px;"></canvas>
				<script>
				var ctx = document.getElementById("myLine").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: ["Ngày 1->10","11->20","21->cuối tháng"],
						datasets: [{
							label: '# đơn vị vnđ',
							data: [<?echo $total_d_1_10?>, <?echo $total_d_11_20?>, <?echo $total_d_21_end?>],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						}
					}
				});
				</script>
			</div>
		
		</div>
		<div class="col-md-4 switch-right">
			<div class="switch-right-grid">
				<div class="switch-right-grid1">
					<h3>Doanh thu trong năm <?echo $year?> theo từng tháng</h3>
					
					<ul>
						<li>Tổng tiền: <?echo number_format($total_year)?> vnd</li>
						<li>Đã bán: <?echo ($sale_year)?> sản phẩm</li>
						
					</ul>
				</div>
			</div>
			<div class="sparkline" style="background:white;box-shadow: 0 1px 3px 0px rgba(0, 0, 0, 0.2);">
				<canvas id="myBar" height="187" width="600" style="width: 480px; height: 150px;"></canvas>
				<script>
				var ctx = document.getElementById("myBar").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: ["1", "2", "3","4", "5", "6","7", "8", "9","10", "11", "12"],
						datasets: [{
							label: '# đơn vị vnđ',
							
							data: [<?echo $total_m_1?>,<?echo $total_m_2?>,<?echo $total_m_3?>,<?echo $total_m_4?>,<?echo $total_m_5?>,<?echo $total_m_6?>,<?echo $total_m_7?>,<?echo $total_m_8?>,<?echo $total_m_9?>,<?echo $total_m_10?>,<?echo $total_m_11?>,<?echo $total_m_12?>],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						}
					}
				});
				</script>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
</div>
		
	<!--body wrapper start-->

