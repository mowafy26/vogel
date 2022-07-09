<?php

session_start();

include 'function_db.php';

if(isset($_SESSION['user_delivery']) && isset($_POST['order_num_edit'])){ 

    $ID_order = $_POST['order_num_edit'];
    
     $order_data = get_anything("*","ordarat"," INNER JOIN area ON area.id_area = ordarat.area_order WHERE id_order = $ID_order ");
    
     $c_data['code_order'] = $order_data['code_order'];
     $c_data['id_order'] = $order_data['id_order'];
     $c_data['name_order'] = $order_data['names_order'];
     $c_data['price'] = $order_data['price_order'];
     $c_data['name_client'] = $order_data['client_name'];
     $c_data['area_list'] = $order_data['area_order'];
     $c_data['adress_client'] = $order_data['adres'];
     $c_data['phone_client'] = $order_data['phone'];
     $c_data['transport_order'] = $order_data['transport_order'];
     $c_data['cost_delivery'] = $order_data['cost_delivery'];
     $c_data['code_area'] = $order_data['code_area'];
     $c_data['size_order'] = $order_data['size_order'];
     $c_data['desc_order'] = $order_data['desc_order'];
     $c_data['note_order'] = $order_data['note_order'];
     $c_data['num_home'] = $order_data['home_num'];
     $c_data['name_home'] = $order_data['home_client'];
     $c_data['num_floor'] = $order_data['floor'];
    
    echo json_encode($c_data);
     
}
 

?>