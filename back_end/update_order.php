<?php

session_start();

include 'function_db.php';

$pattphone = "/^01[0-9]{9}$/";

if(isset($_SESSION['user_delivery'])){ 

    if(isset($_POST['id_order'])) {
             
    $order_id = $_POST['id_order'];  
    $name_order = $_POST['name_order'];  
    $price = $_POST['price'];
    $size_order = $_POST['size_order'];
    $desc_order = $_POST['desc_order'];
    $note_order = $_POST['note_order'];
    $name_client = $_POST['name_client'];
    $area_client = $_POST['area_client'];
    $adress_client = $_POST['adress_client'];
    $phone_client = $_POST['phone_client'];
    $cost_delivery = $_POST['cost_delivery'];
    $trans_port = $_POST['transport_order'];
    $num_home = $_POST['num_home'];
    $name_home = $_POST['name_home'];
    $num_floor = $_POST['num_floor'];
        
    $checkphone = preg_match($pattphone,$phone_client); 
            
    if(trim($name_order) === ''){
        $name_order = 'بدون عنوان';
    }
    if($area_client == 1){
    echo '20';    
    }
    if(trim($adress_client) === ''){
    echo '30';  
    }
    if($trans_port <= 0 ){
    echo '60';  
    }
    if($checkphone != 1){ 
    echo '40';

    }else{    

 $key_val = 'names_order="'.$name_order.'",size_order ="'.$size_order.'",desc_order ="'.$desc_order.'",price_order ='.$price.',area_order = '.$area_client.',note_order ="'.$note_order.'",phone ='.$phone_client.',client_name ="'.$name_client.'",adres = "'.$adress_client.'",cost_delivery ='.$cost_delivery.',transport_order = '.$trans_port.',home_client="'.$name_home.'",home_num='.$num_home.',floor='.$num_floor;
        
    updateItem('ordarat', $key_val.' WHERE id_order = '.$order_id);        
        
        echo "1" ;
  
    }

}   

}
?>