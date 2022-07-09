<?php
//header('Access-Control-Allow-Origin: *');

session_start();

include 'function_db.php';

//$url_going = 'https://2bdoctor.000webhostapp.com/back_end/';
//$url_going = 'back_end/';

if(isset($_SESSION['user_delivery'])){ 
    
     $ordertabel = getAllfrom( "*" ,"ordarat" ,"INNER JOIN area ON area.id_area = ordarat.area_order  WHERE own_order = $sessionID ","", "id_order");
    
    $cou_orders = count($ordertabel);
 
   if($cou_orders > 0){   
    
       foreach($ordertabel as $orderr){
        
        $num_order = $orderr['id_order'];
        
if($orderr['stat_order'] === 'd'){ 

echo '<tr style="background:#e9f8e9;">';
    
     }else{ 

echo '<tr id="num_order_'.$num_order.'" style="background:aliceblue;">';
    
    /*onclick="show_order(<?php echo $num_order; ?>)"*/
 } ?>   
    <td style="width: 30%;word-break: break-all;" ><span><?php echo $orderr['names_order']; ?></span></td>
    <td style="text-align:right;padding-right:10px"> 
        <li><label> المكان : </label><span><?php echo $orderr['area_Name']; ?></span></li>
        <li><label> المقدم : </label><span><?php echo $orderr['price_order']; ?></span></li>
        <li><label> الحالة : </label>
            <?php if($orderr['stat_order'] === 'd'){ ?>
            <span style="color:#42bd42;">تم التسليم</span>

    <?php }else{ ?>
  
            <span style="color:#d9534f;">قيد التسليم</span>

    <?php } ?>   
            
        </li>
        <li><label> التاريخ : </label><span><?php echo date('d/m', strtotime($orderr['date_order'])); ?></span></li>
            
        
    </td>
    <td style="font-size:18px">
        <i style="margin-left:25px;color:#15a7ef;" onclick="edit_order(<?php echo $num_order; ?>)" class="fa fa-edit"></i>
        <i style="color:#ce0707;" onclick="delete_order(<?php echo $num_order; ?>)" class="far fa-trash-alt"></i>
    </td>

 <?php
    echo '</tr>';
       
     }

   }else{
       
       echo '<div style="position:absolute"> <div class="col-xs-12"> <img style="width:100%" src="photo/icon/nodata.png" /> </div>';
       echo '<p style="color:#3086a3;text-align: center;font-size: 23px;direction:ltr" > ! لاتوجد طلبات </p></div> ';
   
   }
      
    sleep(1);
 
}
