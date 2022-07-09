<?php

session_start();

include 'function_db.php';

if(isset($_SESSION['user_delivery']) && isset($_POST['client_num_edit'])){ 

    $ID_client = $_POST['client_num_edit'];
    
     $client_data = get_anything("*","client"," WHERE id_client = $ID_client ");
    
     $c_clien['id_client'] = $client_data['id_client'];
     $c_clien['client_name'] = $client_data['name_client'];
     $c_clien['area_list'] = $client_data['area_client'];
     $c_clien['client_adress'] = $client_data['adres_client'];
     $c_clien['home_num'] = $client_data['num_home'];
     $c_clien['home_name'] = $client_data['name_home'];
     $c_clien['floor_num'] = $client_data['num_floor'];
     $c_clien['client_phone'] = $client_data['phone_client'];
    
    echo json_encode($c_clien);
     
}
 

?>