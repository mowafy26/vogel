<?php

session_start();

include 'function_db.php';

$pattphone = "/^01[0-9]{9}$/";

if(isset($_SESSION['user_delivery'])){ 

if(isset($_POST['name_client'])) {
             
    $name_order = $_POST['name_order'];  
    $price = $_POST['price'];
    $size_order = $_POST['size_order'];
    $desc_order = $_POST['desc_order'];
    $note_order = $_POST['note_order'];
    $name_client = $_POST['name_client'];
    $clients_ides = $_POST['clients_ides'];
    $area_client = $_POST['area_client'];
    $adress_client = $_POST['adress_client'];
    $phone_client = $_POST['phone_client'];
    $cost_delivery = $_POST['cost_delivery'];
    $trans_port = $_POST['transport_order'];
    $order_from = $user['area_tager'];
    $num_home = $_POST['num_home'];
    $name_home = $_POST['name_home'];
    $num_floor = $_POST['num_floor'];
    
    $char_code = 'ABCDEFGHIGKLMNOPQRSTUVWXYZabcdefghigklmnopqrstuvwxyz123456789';
    $charund_code = substr(str_shuffle($char_code),0,5);
    $numrund_code = (rand(1, 1000000));

    $code_order = $charund_code.'_'.$numrund_code ;
    
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

$stmt_order = $con->prepare("INSERT INTO 
ordarat(own_order,code_order,names_order,size_order,desc_order,date_order,price_order,order_from,area_order,note_order,phone,clients_ides,client_name,adres,cost_delivery,transport_order,home_client,home_num,floor,stat_read,stat_order,mandop_done) VALUES($sessionID,'$code_order','$name_order','$size_order','$desc_order',now(),'$price',$order_from,$area_client,'$note_order',$phone_client,$clients_ides,'$name_client','$adress_client',$cost_delivery,$trans_port,'$name_home','$num_home','$num_floor','f','wait',0)");
    
$stmt_order->execute();
                
        echo "1" ;
  
    }

}   

if(isset($_POST['client_name'])) {
    
    $client_name = $_POST['client_name'];
    $client_area = $_POST['client_area'];
    $client_adress = $_POST['client_adress'];
    $home_num = $_POST['home_num'];
    $home_name = $_POST['home_name'];
    $floor_num = $_POST['floor_num'];
    $client_phone = $_POST['client_phone'];
    
    $phonecheck = preg_match($pattphone,$client_phone); 
            
    if($client_name == ''){
    echo '10';
        
    }
    if($client_area == 1){
    echo '20';    
        
    }
    if($client_adress == ''){
    echo '30';
        
    }
    if($phonecheck != 1){ 
    echo '40';

    }else{

$stmt_clients = $con->prepare("INSERT INTO 
client(own_saller,name_client,phone_client,adres_client,name_home,num_home,num_floor,city_client,area_client)
VALUES($sessionID,'$client_name',$client_phone,'$client_adress','$home_name','$home_num','$floor_num',1,$client_area)");
    
$stmt_clients->execute();
     
        echo "1" ;
  
    }

}   

}                             
