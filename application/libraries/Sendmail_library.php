<?
class Sendmail_library
{
	var $CI ='';

	function __construct()
	{
		$this->CI = & get_instance();
	}

	function send_mail($data_cart,$data_order,$status=1)
	{

		$message="";
		if($status==0)
		{
			$message = "Đơn hàng của của bạn đã đã bị hủy do một vài sự cố không mong muốn, quý khách có thể thực hiện lại giao dịch tạo website của chúng tôi, cảm ơn quý khách.";
			$message_order = "Thông tin đơn hàng bị hủy :";
		}
		if($status==1)
		{
			$message = 'Cảm ơn bạn đã tin tưởng chọn thực phẩm chức năng tại website của chúng tôi, đơn hàng của bạn sẽ sớm được giao vui lòng kiểm tra mail thường xuyên trong thời gian sắp tới';
			$message_order = "Thông đơn hàng đã đặt : ";
		}
		if($status==2)
		{
			$message = "Đơn hàng của của bạn đã được quản trị viên thông qua và đang trên đường giao đến bạn, cảm ơn bạn đã tin dùng sản phẩm của chúng tôi";
			$message_order = "Thông tin đơn hàng đã giao :";
		}
		if($status==3)		
		{
			$message = "Đơn hàng của của bạn đã giao thành công, trân thành cảm ơn quý khách và mong muốn sự ủng hộ của quý khách trong thời gian tới.";
			$message_order = "Thông tin đơn hàng đã giao thành công :";
		}
		$content='';
		$content.='<div style="width:100%;max-width:650px;margin:0px auto">
	<table cellpadding="0" cellspacing="0" border="0" width="100%"> 
		<tbody style="width:100%">	
			<tr>		
				<td style="border-collapse:collapse;border-left:1px solid #3498db;border-right:1px solid #ff6e40"> 
					<table border="0" cellpadding="0" cellspacing="0">	
						<tbody>
							<!--Lời chào-->
							<tr> 
								<td style="padding:18px 20px 20px 20px;vertical-align:middle;line-height:20px;font-family:Arial;background-color:#3498db;text-align:center">
									<span style="color:#ffffff;font-size:115%;text-transform:uppercase">Thông tin đặt hàng từ nhà thuốc H&T</span> 
								</td> 
							</tr> 
							<tr> 
								<td style="padding:20px 20px 12px 20px"> 
									<span style="font-size:13px;color:#252525;font-family:Arial,Helvetica,sans-serif"> Chào '.$data_order->cus_name.', </span> 
								</td>
							</tr>	
							<tr> 
								<td style="padding:4px 20px 12px 20px"> 
									<span style="font-size:12px;color:#252525;font-family:Arial,Helvetica,sans-serif;line-height:18px">'.$message.' :</span> 
								</td> 
							</tr>
							<tr> 
								<td style="padding:4px 20px 12px 20px"> 
									<strong style="font-size:12px;color:#252525;font-family:Arial,Helvetica,sans-serif;line-height:18px"> 
										Thông bạn đã đăng kí :
									</strong>
								</td> 
							</tr>
							<!--Thông tin khách hàng-->
							<tr> 
								<td style="padding:20px 0px 12px 0px"> 
									<table border="0" cellpadding="0" cellspacing="0" width="100%">	
										<tbody>
											<tr>	
											<td style="padding:8px 10px 8px 20px;font-family:Arial,Helvetica,sans-serif;color:#666666;font-size:12px;border-bottom:1px solid #dcdcdc;border-top:1px solid #dcdcdc" align="right" width="39%">
												<span>Khách hàng:</span>
											</td>	
											<td style="padding:8px 20px 8px 10px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#2525253;border-bottom:1px solid #dcdcdc;border-top:1px solid #dcdcdc" align="left">'.$data_order->cus_name.'</td>
											</tr>	
											<tr>	
												<td style="padding:8px 10px 8px 20px;font-family:Arial,Helvetica,sans-serif;color:#666666;font-size:12px;border-bottom:1px solid #dcdcdc" align="right">
													<span>Email:</span>
												</td>	
												<td style="padding:8px 20px 8px 10px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#2525253;border-bottom:1px solid #dcdcdc" align="left">
													<strong>'.$data_order->cus_email.'</strong>
												</td>	
											</tr>
											<tr>
											<td style="padding:8px 10px 8px 20px;font-family:Arial,Helvetica,sans-serif;color:#666666;font-size:12px;border-bottom:1px solid #dcdcdc" align="right">
											<span>Số điện thoại:</span>
											</td>	
											<td style="padding:8px 20px 8px 10px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#2525253;border-bottom:1px solid #dcdcdc" align="left">
											'.$data_order->cus_phone.'
											</td>	
											</tr>
											<tr>
												<td style="padding:8px 10px 8px 20px;font-family:Arial,Helvetica,sans-serif;color:#666666;font-size:12px;border-bottom:1px solid #dcdcdc" align="right">
												<span>Địa chỉ:</span>
												</td>
												<td style="padding:8px 20px 8px 10px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#2525253;border-bottom:1px solid #dcdcdc" align="left">
												'.$data_order->cus_address.'
												</td> 
											</tr>
										</tbody>
									</table>	
								</td> 
							</tr>
							<!--Thông tin đặt hàng-->
							<tr> 
								<td style="padding:4px 20px 12px 20px"> 
									<strong style="font-size:12px;color:#252525;font-family:Arial,Helvetica,sans-serif;line-height:18px"> 
										'.$message_order.'
									</strong>
								</td> 
							</tr>
							<tr> 
								<td style="padding:20px 0px 12px 0px"> 
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="	width: 750px; border-collapse: collapse; margin:0xp 20px;">	
										 <thead>
											<tr>
											  <th style="background: #3498db; color: white; font-weight: bold;padding: 10px; ">STT</th>
											  <th style="background: #3498db; color: white; font-weight: bold;padding: 10px; ">Tên SP</th>
											  <th style="background: #3498db; color: white; font-weight: bold;padding: 10px; ">Đơn giá</th>
											  <th style="background: #3498db; color: white; font-weight: bold;padding: 10px;">Số lượng</th>
											  <th style="background: #3498db; color: white; font-weight: bold;padding: 10px; ">Thành tiền</th>
											  <th style="background: #3498db; color: white; font-weight: bold;padding: 10px; ">Trạng thái</th>
											</tr>
										  </thead>
										  <tbody  style="text-align: center;">';
		$i=1;
		$subtotal = 0;
		foreach($data_cart as $cart)
		{ 	if($cart->status==1)
			{
				$subtotal+=$cart->price*$cart->quantity;
			}
			$status = ($cart->status==0)?'bị hủy':'mua';
			$content .='<tr>
					<td style="padding:10px">'.$i++.'</td>
					<td style="padding:10px">'.$cart->name.'</td>
					<td style="padding:10px">'.number_format($cart->price).' vnđ</td>
					<td style="padding:10px">'.$cart->quantity.'</td>
					<td style="padding:10px">'.number_format($cart->price*$cart->quantity).'vnđ</td>
					<td style="padding:10px">'.$status.'</td>
					</tr>';
		}
		$content .=' </tbody>
									</table>	
								</td> 
							</tr>
							<!--Tổng tiền-->
							<tr>
							<td style="padding:10px 20px 12px 20px">
								<div style="float:right;margin-right:50px"><strong>Tổng tiền:</strong><span style="color:red;font-size:20"> '.number_format($subtotal).' vnđ</span></div>
							</td> 
							</tr> 
							
						</tbody>
					</table>
				</td>
			</tr>
			<!--Thông tin người gửi-->
			<tr>
				<td>
					<table cellpadding="0" cellspacing="0" width="100%" border="0">		
						<tbody>
							<tr> 	
								<td style="padding:4px 20px 12px 20px;border-left:1px solid #3498db;border-right:1px solid #ff6e40">
									<span style="font-size:12px;color:#252525;font-family:Arial,Helvetica,sans-serif">Hân hạnh được phục vụ quý khách!</span> 
								</td> 	
							</tr>
							<tr> 	
								<td valign="middle" style="background-color:#6e6e6e;font-size:11px;vertical-align:middle;text-align:center;padding:10px 20px 10px 20px;line-height:18px;border:1px solid #6e6e6e;font-family:Arial;color:#cccccc">	
								Cao Đẳng Kỹ Thuật Cao Thắng Đồ Án Tốt Nghiệp, Lập Trình PHP(Codeigniter), Đồ Án Website Bán Thực Phẩm Chức Năng.
								</td> 	
							</tr>  		
						</tbody>
					</table>
				</td>	
			</tr>  		
		</tbody>
	</table> 
</div>';
		$config = array("protocol"=>"smtp",
						"smtp_host"=>"ssl://smtp.googlemail.com",
						"smtp_port"=>465,
						"smtp_user"=>"mxhieu8319972@gmail.com",
						"smtp_pass"=>"gacon66529372"
		);
		$this->CI->load->library("email",$config);
		$this->CI->email->set_mailtype("html");
		$this->CI->email->set_newline("\r\n");
		$this->CI->email->from("mxhieu8319972@gmail.com", "Mai Xuân Hiếu"); // thiết lập địa chỉ email và tên người gửi
		$this->CI->email->to($data_order->cus_email,$data_order->cus_name); // thiết lập địa chỉ email và tên người nhận email.
		$this->CI->email->subject("Thư từ nhà thuốc H&T"); // thiết lập tiêu đề gửi email
		$this->CI->email->message($content); // thiết lập nội dung gửi mail
		if(!$this->CI->email->send())
		{
			return false;
		}
		else
		{
			return true;
		}
	
	}

	
}
?>