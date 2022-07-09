<?php

session_start();

include 'function_db.php';

$pattphone = "/^01[0-9]{9}$/";

if(isset($_SESSION['user_delivery'])){ 

    if(isset($_POST['id_client'])) {
             
    $client_id = $_POST['id_client'];  
    $name_client = $_POST['client_name'];
    $area_client = $_POST['client_area'];
    $adress_client = $_POST['client_adress'];
    $phone_client = $_POST['client_phone'];
    $num_home = $_POST['home_num'];
    $name_home = $_POST['home_name'];
    $num_floor = $_POST['floor_num'];
        
    $checkphone = preg_match($pattphone,$phone_client); 
      
    if(trim($name_client) === ''){
    echo '10';
        
    }
    if($area_client == 1){
    echo '20';    
        
    }
    if(trim($adress_client) === ''){
    echo '30';
        
    }
    if($checkphone != 1){ 
    echo '40';

    }else{

 $key_val = 'name_client="'.$name_client.'",phone_client ='.$phone_client.',adres_client ="'.$adress_client.'",name_home ="'.$name_home.'",num_home ='.$num_home.',num_floor ='.$num_floor.',area_client = '.$area_client;
        
    updateItem('client', $key_val.' WHERE id_client = '.$client_id); 
            
    $count_order_user = countItems('id_order','ordarat',"WHERE clients_ides = $client_id ");
                
    if($count_order_user > 0){
        
    updateItem('ordarat','area_order = '.$area_client ,' WHERE clients_ides = '.$client_id );
     
    }

        echo "1";
}   

}
}
?>