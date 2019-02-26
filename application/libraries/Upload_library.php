<?
class Upload_library
{
	var $CI ='';

	function __construct()
	{
		$this->CI = & get_instance();
	}

	function upload($upload_path = '',$file_name = '')
	{
    $new_name = "";
    $config = $this->config($upload_path);
    $newfilename="";
    //lưu biến môi trường khi thực hiện upload
    $file  = $_FILES[$file_name];
    $filename = $file['name'];
    $file_ext = substr($filename, strripos($filename, '.'));
    $_FILES['userfile']['name']     = "0_".time().$file_ext;  //Tên hình trong thư mục upload
    $_FILES['userfile']['type']     = $file['type']; //khai báo kiểu của file thứ i
    $_FILES['userfile']['tmp_name'] = $file['tmp_name']; //khai báo đường dẫn tạm của file thứ i
    $_FILES['userfile']['error']    = $file['error']; //khai báo lỗi của file thứ i
    $_FILES['userfile']['size']     = $file['size']; //khai báo kích cỡ của file thứ i
    //load thư viện upload và cấu hình
    $this->CI->load->library('upload', $config);
    //thực hiện upload từng file
    if($this->CI->upload->do_upload())
    {
        //nếu upload thành công thì lưu toàn bộ dữ liệu
        $data = $this->CI->upload->data();
        //in cấu trúc dữ liệu của các file
        $newfilename="0_".time().$data['file_ext'];//Lưu trên phpmyadmin
        $new_name = $newfilename;
    }
    
    return $new_name;    
	}

	function multi_upload($upload_path='',$file_name = '')
	{
		$config = $this->config($upload_path);
    $newfilename="";
    //lưu biến môi trường khi thực hiện upload
    $file  = $_FILES[$file_name];
    $count = count($file['name']);//lấy tổng số file được upload

    
    $image_list = array();
    for($i=0; $i<=$count-1; $i++) {
          $i1 = $i+1;
          $filename = $file['name'][$i];
          $file_ext = substr($filename, strripos($filename, '.'));
          $_FILES['userfile']['name']     = $i1."_".time().$file_ext;  //Tên hình trong thư mục upload
          $_FILES['userfile']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
          $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
          $_FILES['userfile']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
          $_FILES['userfile']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
          //load thư viện upload và cấu hình
          $this->CI->load->library('upload', $config);
          //thực hiện upload từng file
          if($this->CI->upload->do_upload())
          {
              //nếu upload thành công thì lưu toàn bộ dữ liệu
              $data = $this->CI->upload->data();
              //in cấu trúc dữ liệu của các file
              $newfilename=$i1."_".time().$data['file_ext'];//Lưu trên phpmyadmin
              $image_list[] = $newfilename;
          }
    } 
    return $image_list;    
	}

	function config($upload_path='')
	{
		//Khai bao bien cau hinh
         $config = array();
         //thuc mục chứa file
         $config['upload_path']   = $upload_path;
         //Định dạng file được phép tải
         $config['allowed_types'] = 'jpg|png|gif';
         //Dung lượng tối đa
         $config['max_size']      = '10000';
         //Chiều rộng tối đa
         $config['max_width']     = '2000';
         //Chiều cao tối đa
         $config['max_height']    = '2000 ';
         //load thư viện upload
         return $config;
	}
}
?>