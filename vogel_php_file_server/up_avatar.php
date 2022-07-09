<?php

session_start();

include 'function_db.php';

//$url_going = 'https://2bdoctor.000webhostapp.com/back_end/';
//$url_going = 'back_end/';

if(isset($_SESSION['user_delivery'])){ 

if(isset($_FILES['postimg']["name"])){
    
    $file_name  = $_FILES["postimg"]["name"];	
    $file_tmp   = $_FILES["postimg"]["tmp_name"];
	$file_type  = $_FILES["postimg"]["type"];	
	$file_size  = $_FILES["postimg"]["size"];	
	$file_error = $_FILES["postimg"]["error"]; 
  
     $output_dir = 'avatar/';      
          
     $image_extension = array("jpg","jpeg","pjpeg","png","gif");

     if($file_error == 4){
						
    $formErrors[] = '<p class="canclemsg_erro" >  يوجد خطا في اختيار الصورة </p>';
				
     }else{
            
            $files_nsion = explode('.', $file_name);
            $filesimage_extension = end($files_nsion);
        
            $image_rand = rand(0,1000).date('ymdhis').$file_name;
            
            if($file_size > 4194304 ){	$formErrors[] = '<p class="canclemsg_erro" >  حجم الصور كبير </p>'; }
                
            if(!in_array($filesimage_extension,$image_extension)){					        

                $formErrors[] = '<p class="canclemsg_erro" >  برجاء التحقق من صيغة الصورة  </p>';
            }

            if(empty($formErrors)){	

            move_uploaded_file($file_tmp,$output_dir.$image_rand);

            resize_image($output_dir.$image_rand,150,150);

            updateItem('users',' avater_user = "'.$image_rand.'" WHERE id = '.$sessionID);      


            } 
    
     }
}

}
?>