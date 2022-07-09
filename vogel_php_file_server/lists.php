<?php
session_start();

include 'function_db.php';

if(isset($_POST['list_area'])) {

    if($_POST['list_area'] === 'user_area' ){
        
    get_arealist($user['area_tager']);
        
    }else{
        
    get_arealist();
        
    }  
    
}

if(isset($_POST['list_category'])) {
    
    if($_POST['list_category'] === 'user_cate' ){
        
    get_categorylist($user['category_tager']);
        
    }else{
        
    get_categorylist();
        
    }

}

if(isset($_POST['list_transport'])){
        
    get_transportlist($user['trans_port']);
    
}

if(isset($_SESSION['user_delivery'])){ 
 
if(isset($_POST['list_clients'])) {

    $outclients= '';
        
 if($count_client > 0 ){
    
     $clientslist = getAllfrom( "*" ,"client" ," WHERE own_saller = $sessionID ","", "id_client");	

     $outclients .= '<label style="color:black" > اختر عميل من القائمة </label>';
     $outclients .= '<select onchange="put_data_clients(this.value)" style="height: 46px" class="form-control" >';
    
         $outclients .= '<option value="0">اختر عميل </option>';
     foreach($clientslist as $rowclient){ 
     
         $outclients .= '<option value="'.$rowclient["id_client"].'">'.$rowclient["name_client"].'</option>';
     }
     
     $outclients .= '</select>';

  }else{
     
     $outclients = '<a class="addclients" href="add_clients.html" > إضافة عميل جديد <i class="fas fa-user-plus"></i></a>';
          
 }
    echo $outclients;

}

if(isset($_POST['order_from'])) {
    
    echo $user['code_area'];
}

if(isset($_POST['client_data'])) {
    
     $ID_clientss = $_POST['client_data'];
     $clients_data = get_anything("*","client","INNER JOIN area ON area.id_area = client.area_client WHERE own_saller = $sessionID AND id_client = $ID_clientss ");
    
     $c_data['code_area'] = $clients_data['code_area'];
     $c_data['name_client'] = $clients_data['name_client'];
     $c_data['phone_client'] = $clients_data['phone_client'];
     $c_data['adres_client'] = $clients_data['adres_client'];
     $c_data['name_home'] = $clients_data['name_home'];
     $c_data['num_home'] = $clients_data['num_home'];
     $c_data['num_floor'] = $clients_data['num_floor'];
     $c_data['area_client'] = $clients_data['area_client'];
     //$c_data['city_client'] = $clients_data['city_client'];
    
    echo json_encode($c_data);

}
    
if(isset($_POST['get_place']) && $user['code_tager'] == 2 ){
    
    echo $user['place_write'];
    
}    
 
if(isset($_POST['json_place'])){

    $place_own = $_POST["json_place"];
    
    $place_write = $_POST["text_place"];
    
    updateItem('users','place_own = '.$place_own.', place_write = '.$place_write,' WHERE id = '. $sessionID);
    
}   

if(isset($_POST['nooti_id'])){
        
    updateItem('noti_mandop','notiread = 1 ',' WHERE id_noti = '.$_POST['nooti_id']);

}
    
}
?>
