<?php
session_start();

include 'function_db.php';

if(isset($_SESSION['user_delivery'])){ 
    

    if(isset($_POST['num_ord'])){
   
    $order_idnum = $_POST['num_ord'];
    
    $to_owner = $_POST['touserowner'];
    
insertItems('accepter_order','(order_about,own_userr,mandop_accept,date_acc,stat_accept)','VALUES('.$order_idnum.','.$to_owner.','.$sessionID.',now(),"r")');


insertItems('noti_mandop','(noti_about,noti_touser,noti_fromuser,stat_accept,stat_orders,for_ord,notiread)','VALUES("accepter_order" ,'.$to_owner.','.$sessionID.',"r","r",'.$order_idnum.',0)');
      
    
    echo '<li class="waitter_order" > <i class="fas fa-clock"></i> انتظار الموافقة </li>';


sleep(2);
    
}
    
    if(isset($_POST['id_orderr_acc']) && isset($_POST['statacc_ord'])){
   
    $acc_statss = $_POST['statacc_ord'];        
    $orrd_id = $_POST['id_orderr_acc'];
    $tostat_users = $_POST['tostat_users'];
            
    updateItem('accepter_order','stat_accept = "'.$acc_statss.'" ',' WHERE order_about = '. $orrd_id);
    
    insertItems('noti_mandop','(noti_about,noti_touser,noti_fromuser,stat_accept,stat_orders,for_ord,notiread)','VALUES("accepter_order" ,'.$tostat_users.','.$sessionID.'," ","'.$acc_statss.'",'.$orrd_id.',0)');
      
        if($acc_statss === 'k'){
            
            updateItem('ordarat','stat_order = "B" ',' WHERE id_order = '. $orrd_id);
            
            echo 'تم القبول , .... انتظر رد المندوب عليك';
            
        }else if($acc_statss === 'x'){
            
            echo ' تم رفض المندوب ';
            
        }

        
}
    
}