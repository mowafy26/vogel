<?php
session_start();

include 'function_db.php';

if(isset($_SESSION['user_delivery'])){ 

     if(isset($_POST['delete_noti'])) {
         
        deletItems('noti_mandop','WHERE id_noti = '.$_POST['delete_noti'] );
     
     }
    
    if(isset($_POST['num_ord_delete'])) {
         
        deletItems('ordarat','WHERE id_order = '.$_POST['num_ord_delete'] );
        deletItems('noti_mandop','WHERE for_ord = '.$_POST['num_ord_delete'] );
        
     
     }
    
    if(isset($_POST['num_clients_user'])) {
         
        deletItems('client','WHERE id_client = '.$_POST['num_clients_user'] );
     
     }

}?>

