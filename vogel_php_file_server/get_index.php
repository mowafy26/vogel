<?php
//header('Access-Control-Allow-Origin: *');

session_start();

include 'function_db.php';

//$url_going = 'https://2bdoctor.000webhostapp.com/back_end/';
//$url_going = 'back_end/';
    
if(isset($_SESSION['user_delivery'])){ 
    
     $da_get['count_noti'] = $count_noti; 
     $da_get['name_tager'] = '( '.$user['name_tager']. ' )'; 
    
    if($user['code_tager'] == 1){
       
     $da_get['link_profile'] = 'front_end/profile.html';       
     $da_get['your_acc'] = 'front_end/main_saller.html'; 

    }else if($user['code_tager'] == 2){
    
     $da_get['link_profile'] = 'front_end/profile_mandop.html';       
     $da_get['your_acc'] = 'front_end/main_mandop.html'; 

    }

}

    echo json_encode($da_get);

   