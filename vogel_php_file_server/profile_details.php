<?php

session_start();

include 'function_db.php';

if(isset($_SESSION['user_delivery'])){ 

    if( isset($_POST['user_details'])){
    
        $ID_user = $_POST['user_details'];
    
        $user_rates = get_anything("count_rate","rate","WHERE rate_from = $sessionID AND rate_to = $ID_user ");
     
        if($user_rates > 0){ 
            
            $u_detail['rate_tager'] = $user_rates['count_rate'];
            
        }else{
            
            $u_detail['rate_tager'] = 0;
            
        }
    
    }else if( isset($_POST['myprofile'])){
     
        $ID_user = $sessionID;
        
    }
    
     $user_details = get_anything("*","users","INNER JOIN area ON area.id_area = users.area_tager INNER JOIN cate ON cate.id_category  = users.category_tager WHERE id = $ID_user ");
     
     $puplicc_rates = $con->prepare('SELECT SUM(count_rate) AS counrate FROM rate where rate_to = '.$ID_user);
     $puplicc_rates->execute();
     $sumrate = $puplicc_rates->fetch(PDO::FETCH_ASSOC);
     $pup_ratee = $sumrate['counrate'];
    
     $count_users_rate = countItems('id_rate','rate'," WHERE rate_to = $ID_user ");
    
    if($count_users_rate > 0){     
     $equation = ($count_users_rate * 5 );
     $equation_end = (( $pup_ratee / $equation ) * 100 );
    }else{
     $equation_end = 0;
    }
     if( isset($_POST['myprofile']) ){ 
         
        $user_rates = get_anything("count_rate","rate","WHERE rate_to = $ID_user ");
        
        if($user_rates > 0){ 
            
            $u_detail['rate_tager'] = intval($pup_ratee / $count_users_rate);
        
        }else{ 
            
            $u_detail['rate_tager'] = 0;
        
        }
     }
     $user_orders = countItems('id_order','ordarat'," WHERE own_order = $ID_user ");
     $mandop_orders = countItems('id_order','ordarat'," WHERE mandop_done = $ID_user AND stat_order ='done' ");
     $user_opinion = countItems('id_opinion','opinions'," WHERE opinion_to = $ID_user ");
    
     if($user_opinion > 0){
    
     $opinion_write = get_anything("txt_opinion","opinions","WHERE opinion_from = $sessionID AND opinion_to = $ID_user ");
     $optxt_write = $opinion_write['txt_opinion'];
         
     }else{
         $optxt_write = '';
         
     }
    
     $u_detail['avater_user'] = $user_details['avater_user'];
     $u_detail['name_tager'] = $user_details['name_tager'];
     $u_detail['pass_tager'] = $user_details['passtext_tager'];
     $u_detail['phone_tager'] = $user_details['phone_tager'];
     $u_detail['area_Name'] = $user_details['area_Name'];
     $u_detail['adres_tager'] = $user_details['adres_tager'];
     $u_detail['textt_write'] = $optxt_write;
     $u_detail['user_opinion'] = $user_opinion;
     $u_detail['pup_rate'] = $equation_end;
    
     $tansport = $user_details['trans_port'];
     $code_tager = $user_details['code_tager'];
    
    if($code_tager == 1){
        
     $u_detail['code_tager'] = '( بائع )' ;
        
    if($user_details['category_tager'] == 1){
        
        $u_detail['category_tager'] = 'لا يوجد نشاط محدد';
        
    }else{
        
        $u_detail['category_tager'] = $user_details['name_category'];
    }
        
     $u_detail['trans_port'] = '';
     $u_detail['order_done'] = ' نشر <span>'.$user_orders.'</span>';

    }else if($code_tager == 2){
        
     $u_detail['category_tager'] = '';
        
     $u_detail['code_tager'] = ' ( مندوب ) ';
        
     $u_detail['order_done'] = ' انجز <span>'.$mandop_orders.'</span>';
        
         switch ($tansport) {
      case 1:
        $u_detail['trans_port'] = 'من غير وسيلة'; 
        break;
      case 2:
        $u_detail['trans_port'] = 'عجلة'; 
        break;
      case 3:
        $u_detail['trans_port'] = 'اسكوتر'; 
        break;
      case 4:
        $u_detail['trans_port'] = 'سيارة'; 
        break;
      default:
        $u_detail['trans_port'] = '.....'; 
    
         }
        
    }
        
   echo json_encode($u_detail);

sleep(1);
}

?>