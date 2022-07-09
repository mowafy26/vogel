<?php

session_start();

include 'function_db.php';

//$url_going = 'https://2bdoctor.000webhostapp.com/back_end/';
//$url_going = 'back_end/';
    
if(isset($_SESSION['user_delivery']) && $user['code_tager'] == 2 ){ 

    $place_num = $user['place_own'];
    $trans_port = $user['trans_port'];
    $area_tager = $user['area_tager'];

    
 $ordert_mandop = getAllfrom( "*" ,"ordarat" ,"INNER JOIN users ON users.id = ordarat.own_order INNER JOIN area ON area.id_area = ordarat.order_from WHERE stat_order = 'wait' AND ( transport_order IN ($trans_port,5) AND (order_from IN($place_num,$area_tager)) or (area_order IN($place_num,$area_tager))) ","", "id_order");	
   
$rcount_ordert = count($ordert_mandop);

?>

<div style="margin-top:40px;" class="container">
    <div class="row">
<!---------------------------------------------->
<?php 
   if($rcount_ordert > 0){
       
    foreach($ordert_mandop as $orderr){ 
    
        $id_ord = $orderr['id_order'];
        
        $own_ord = $orderr['own_order'];
        
        $order_to_ar = get_anything("area_Name","area"," WHERE id_area = ".$orderr['area_order']);
        
        $count_accpeter = countItems('accepter_id','accepter_order'," WHERE order_about = $id_ord AND mandop_accept = $sessionID ");
        
        if($count_accpeter > 0){
        
            $order_accpet = get_anything("stat_accept","accepter_order"," WHERE order_about = $id_ord AND mandop_accept = $sessionID ");
        
            $stat_ac = $order_accpet['stat_accept'];
        
        }else{
        
            $stat_ac = '';
        }
        
     if($stat_ac != 'x'){ 
?>

<div style="margin-bottom:25px;padding:0px" class="col-xs-12">
    
            <section class="widget">
                    <div style="padding:10px" class="widget-top-overflow clearfix bg-info text-white">
                                  <ul style="float:left" id="ac_ord<?php echo $id_ord; ?>">
                            <?php
                       
            if($stat_ac === 'r'){ echo '<li class="waitter_order" > <i class="fas fa-clock"></i> انتظار الموافقة </li>';
                                                                                                
            }else if($stat_ac === 'k' ){ echo '<li class="acp_order" > <i class="fas fa-check"></i> تم القبول</li>'; 
        
            }else{ echo '<li id="accepter'.$id_ord.'" class="accepter_order" onclick="accepter_order('.$id_ord.','.$own_ord.');">مستعد</li>';}
        
                            ?>
                            
<li style="display:none;position: relative;left:0px" id="loader-accepter<?php echo $id_ord; ?>" class="lds-spinner accepter-sp"> 
                            <div></div><div></div><div></div><div></div><div></div><div></div>
                            <div></div><div></div><div></div><div></div><div></div><div></div>
                            </li>  
                        </ul>
                        
                    
                        <h4 class="text-white">
                        
                <p style="word-break: break-all;"> <?php echo '<i class="fas fa-tag"></i> '.$orderr['names_order']; ?> </p>
                        
    <?php if($stat_ac === 'k' ){ ?>
                            
        <p onclick="go_profile(<?php echo $orderr['id']; ?>,'')"  style="text-align:center;text-decoration: underline;color: #f1d11b;" > تواصل مع <?php echo $orderr['name_tager']; ?></p>
                <?php } ?>
                        </h4>
                    </div>
                    
                     <div style="margin-top:25px" class="post-user">
                        
                        <p style="text-align:center">
                            <small>سعر الشحن</small>
                            <span class="cost-circle" ><?php echo $orderr['cost_delivery'] ?> </span>
                        </p>
                        
                        <p style="margin-top:20px;" class="text-muted">
                            <i class="fas fa-map-marker-alt"></i>
                            من
                            <span style="color:red"> <?php echo $orderr['area_Name'].' '; ?></span>
                            إلي
                            <span style="color:red"> <?php echo $order_to_ar['area_Name'].' '; ?></span>
                        </p>
                       
                        <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        عرض تفاصيل الطلب 
        <span class="caret"></span>
    </button>
                              <ul style="width:100%;text-align:right;padding:8px;" class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                  <li style="padding:10px 15px" ><?php echo ' المقدم :'.$orderr['price_order']; ?></li>
                                  <li style="padding:10px 15px" >
                                      حجم الاوردر : 
                                    <?php 
                                    if($orderr['size_order'] != ''){
                                        
                                        echo $orderr['size_order'].' . ';
                                        
                                    }else{
                                    
                                        echo ' لايوجد وصف  . ';

                                    }
                                    ?>
                                  </li>
                                  <li style="padding:10px 15px" >
                                     وصف الطلب :
                                    <?php 
                                    if($orderr['desc_order'] != ''){
                                        
                                        echo $orderr['desc_order'].' . ';
                                        
                                    }else{
                                    
                                        echo ' لايوجد وصف خاص بالطلب . ';

                                    }
                                    ?>
                                  </li>
                                  <li style="padding:10px 15px" >
                                      ملاحظات : 
                                    <?php
        
                                     if($orderr['note_order'] != '' ){
                                        
                                        echo $orderr['note_order'].' . ';
                                        
                                    }else{
                                        
                                        echo ' لايوجد ملاحظات خاصة بالطلب .  ';
                                    }
                                    
                                    ?> 
</li>         
                              </ul>
                            </div>
                        
    <p style="position: absolute;left:10px;bottom:0px;" class="text-muted" ><?php echo getDateTimeDiff($orderr['date_order']); ?></p>
        
                   </div>
                
            </section>
</div>

 
<?php
    }
    }  
   
   }else{
       
     echo '<div class="col-xs-12"> <img style="width:100%" src="photo/icon/nodata.png" /> </div>';
       echo '<p style="color:#3086a3;text-align: center;font-size: 34px; }" > ! لاتوجد طلبات حاليا </p> ';
   }
    ?> 
        
	</div>
</div>


<?php 

} 
 