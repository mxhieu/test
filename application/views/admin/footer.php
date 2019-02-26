<footer>
	<p>Thực hiện Mai Xuân Hiếu & Nguyễn Minh Thiệt</p>
</footer>

<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
	 
  $.ajax({
   url:"<?echo admin_url('orders/fetch')?>",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu-orders').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
$('#shopping-cart').on('submit', function(event){
  event.preventDefault();
     $('#shopping-cart')[0].reset();
     load_unseen_notification();

   });
});
</script>
<?/*<script>
	var lineChartData = {
		labels : ["Mon","Tue","Wed","Thu","Fri","Sat","Mon"],
		datasets : [
			{
				fillColor : "#fff",
				strokeColor : "#F44336",
				pointColor : "#fbfbfb",
				pointStrokeColor : "#F44336",
				data : [20,35,45,30,10,65,40]
			}
		]
		
	};
	new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
</script>
<script>
	var barChartData = {
		labels : ["Mon","Tue","Wed","Thu","Fri","Sat","Mon","Tue","Wed","Thu"],
		datasets : [
			{
				fillColor : "#8BC34A",
				strokeColor : "#8BC34A",
				data : [25,40,50,65,55,30,20,10,6,4]
			},
			{
				fillColor : "#8BC34A",
				strokeColor : "#8BC34A",
				data : [30,45,55,70,40,25,15,8,5,2]
			}
		]
		
	};
		new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
</script>*/?>
<?/*<script>
	$(document).ready(function () {
	
		// Graph Data ##############################################
		var graphData = [{
				// Returning Visits
				data: [ [4, 4500], [5,3500], [6, 6550], [7, 7600],[8, 4500], [9,3500], [10, 6550], ],
				color: '#FFCA28',
				points: { radius: 7, fillColor: '#fff' }
			}
		];
	
		// Lines Graph #############################################
		$.plot($('#graph-lines'), graphData, {
			series: {
				points: {
					show: true,
					radius: 1
				},
				lines: {
					show: true
				},
				shadowSize: 0
			},
			grid: {
				color: '#fff',
				borderColor: 'transparent',
				borderWidth: 10,
				hoverable: true
			},
			xaxis: {
				tickColor: 'transparent',
				tickDecimals: false
			},
			yaxis: {
				tickSize: 1200
			}
		});
	
		// Graph Toggle ############################################
		$('#graph-bars').hide();
	
		$('#lines').on('click', function (e) {
			$('#bars').removeClass('active');
			$('#graph-bars').fadeOut();
			$(this).addClass('active');
			$('#graph-lines').fadeIn();
			e.preventDefault();
		});
	
		$('#bars').on('click', function (e) {
			$('#lines').removeClass('active');
			$('#graph-lines').fadeOut();
			$(this).addClass('active');
			$('#graph-bars').fadeIn().removeClass('hidden');
			e.preventDefault();
		});
	
	});
</script>*/?>
