<?php

session_start();

include 'function_db.php';

if(isset($_SESSION['user_delivery']) ){ 
    
     //$client_data = get_anything("*","client"," WHERE id_client = $ID_client ");
    
     $c_saller['name_tager'] = $user['name_tager'];
     $c_saller['count_noti'] = $count_noti;
    
    if($user['code_tager'] == 1){
        
         $c_saller['num_client'] = $count_client;
         $c_saller['count_watting_orderes'] = $count_watting_orderes;
         $c_saller['count_done_orderes'] = $count_done_orderes;
         $c_saller['count_manadep'] = $count_manadep;
    
    }
    
    echo json_encode($c_saller);
     
}
 
?>
                