<?php
//header('Access-Control-Allow-Origin: *');

session_start();

include 'function_db.php';

//$url_going = 'https://2bdoctor.000webhostapp.com/back_end/';
//$url_going = 'back_end/';

if(isset($_SESSION['user_delivery'])){
    
     $listmandops = getAllfrom( "*" ,"accepter_order" ,"INNER JOIN users ON users.id = accepter_order.mandop_accept INNER JOIN ordarat ON ordarat.id_order = accepter_order.order_about  WHERE own_userr = $sessionID ","", "", "accepter_id");
    
    $cou_mandop = count($listmandops);
 
   if($cou_mandop > 0){   
    
       foreach($listmandops as $mandop){
        
        $num_mandop = $mandop['accepter_id'];
        $Member_id = $mandop['id'];
           
if($mandop['stat_accept'] === 'r'){ 

echo '<tr class="candidates-list id="num_order_'.$num_mandop.'" style="background:#ddd;">';
    
     }else{ 

echo '<tr class="candidates-list id="num_order_'.$num_mandop.'" style="background:aliceblue;">';
    
    /*onclick="show_order(<?php echo $num_order; ?>)"*/
 }         
?>   

<td onclick="go_profile(<?php echo $Member_id; ?>,'');" >
    <span><?php echo $mandop['name_tager']; ?></span>
</td>
    <td style="word-break: break-all;" ><span><?php echo $mandop['names_order']; ?></span></td>

<td>
    
 <?php 

    if($mandop['stat_accept'] === 'r'){ ?>

    <span style="background:#0ce50c" class="ok_no_acc" onclick="ok_no_accepter(<?php echo $mandop['id_order']; ?>,'k',<?php echo $Member_id; ?>);" >قبول</span>                    
    <span style="background:#f76619" class="ok_no_acc" onclick="ok_no_accepter(<?php echo $mandop['id_order']; ?>,'x',<?php echo $Member_id;?>);" >رفض</span>

    <?php }else if($mandop['stat_accept'] === 'k'){

            echo '<span style="color:#0ce50c" class="ok_no_acc"> تم القبول </span>';

    }else if($mandop['stat_accept'] === 'x'){

            echo '<span style="color:#f76619" class="ok_no_acc">تم الرفض </span>';

    } ?>
    <small><?php echo getDateTimeDiff($mandop['date_acc']); ?></small>
</td>
  

 <?php
    echo '</tr>';
            
     }
       
   }else{
       
       echo '<div style="position:absolute"> <div class="col-xs-12"> <img style="width:100%" src="photo/icon/nodata.png" /> </div>';
       echo '<p style="color:#3086a3;text-align: center;font-size: 23px;direction:ltr" > ! لايوجد مناديب </p></div> ';
   
   }
     
    sleep(1);

}
