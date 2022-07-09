<?php
session_start();

include 'function_db.php';

if(isset($_SESSION['user_delivery'])){ 

     if(isset($_POST['delivery_order'])) {
         
  $place_num = $user['place_own'];
    
$list_delivery_order = getAllfrom( "*" ,"accepter_order" ,"INNER JOIN users ON users.id = accepter_order.own_userr INNER JOIN ordarat ON ordarat.id_order = accepter_order.order_about WHERE mandop_accept = $sessionID AND stat_accept = 'k' ","", "", "accepter_id");

   
$rcount_ordert = count($list_delivery_order);

   if($rcount_ordert > 0){
       
    foreach($list_delivery_order as $orderr){ 
    
        $id_ord = $orderr['id_order'];
        
        $own_ord = $orderr['own_order'];
        
        $stat_ac = $orderr['stat_accept'];
        
        $order_from_ar = get_anything("area_Name","area"," WHERE id_area = ".$orderr['area_order']);
        $order_to_ar = get_anything("area_Name","area"," WHERE id_area = ".$orderr['order_from']);
?>

<div style="margin-bottom:25px">
            <section class="widget">
                <div class="widget-body">
                    <div style="padding:10px 5px 0px 0px" class="widget-top-overflow windget-padding-md clearfix bg-info text-white">
                    <p style="position: absolute;left: 20px;" ><?php echo getDateTimeDiff($orderr['date_order']); ?></p>
                    
                        <h3 class="mt-sm fw-normal text-white">
                        
                            <p style="word-break: break-all;">
                                
        <?php echo '<i class="fas fa-tag"></i> '.$orderr['names_order']; ?> </p>
                             
    <p onclick="go_profile(<?php echo $orderr['id']; ?>,'')"  style="text-align:center;text-decoration: underline;color: #f1d11b;" >
        تواصل مع <?php echo $orderr['name_tager']; ?></p>
            
                        </h3>
                        
                        <ul style="float:left" id="ac_ord<?php echo $id_ord; ?>" class="tags text-white">
                            <?php '<li class="acp_order" > <i class="fas fa-check"></i> تم القبول</li>'; ?>
                            
    <li style="display:none;position: relative;left:0px" id="loader-accepter<?php echo $id_ord; ?>" class="lds-spinner accepter-sp"> 
                            <div></div><div></div><div></div><div></div><div></div><div></div>
                            <div></div><div></div><div></div><div></div><div></div><div></div>
                            </li>  
                        </ul>
                        
                    </div>
                    <div style="margin-top:15px" class="post-user mt-n-lg">
                        <p style="float:left">
                            <small>سعر الشحن</small>
                            <span class="cost-circle" ><?php echo $orderr['cost_delivery']; ?> </span>
                        </p>
                        <p><?php echo '<i style="margin-left:5px;" class="fas fa-dollar-sign"></i> المقدم '.$orderr['price_order']; ?></p>
                        
                        <p style="margin-top:20px;" class="text-muted">
                            <i class="fas fa-map-marker-alt"></i>
                            من
                            <span style="color:red"> <?php echo $order_from_ar['area_Name'].' '; ?></span>
                            إلي
                            <span style="color:red"> <?php echo $order_to_ar['area_Name'].' '; ?></span>
                        </p>
                        <section id="showmaincate" class="radio_maincate">
                            <div class="row">
                                <input type="hidden" value="<?php echo $orderr['stat_order'] ?>" id="check_selected" >
                                 <div class="col-xs-6" >
                                    <label>
                                    <input onchange="statchange(this.name,this.value);" type="radio" value="wait" name="stat<?php echo $id_ord; ?>">   
                                    <span class="design"></span>
                                    <span class="text">جاري التسليم</span>
                                    </label>
                                </div> 
                                <div class="col-xs-6" >
                                    <label>
                                    <input onchange="statchange(this.name,this.value);" type="radio" value="done" name="stat<?php echo $id_ord; ?>" >
                                    <span class="design"></span>
                                    <span class="text">تم التسليم</span>
                                    </label>
                                </div> 
                                <div class="col-xs-6" >
                                    <label>
                                    <input onchange="statchange(this.name,this.value);" type="radio" value="return" name="stat<?php echo $id_ord; ?>">
                                    <span class="design"></span>
                                    <span class="text"> مرتجع</span>
                                    </label>
                                </div>
                                <div class="col-xs-6" >
                                    <label>
                                    <input onchange="statchange(this.name,this.value);" type="radio" value="refuse" name="stat<?php echo $id_ord; ?>"> 
                                    <span class="design"></span>
                                    <span class="text"> مرفوض</span>
                                    </label>
                                </div>
                            </div>
                        </section>   
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                عرض تفاصيل الطلب
                                <span class="caret"></span>
                              </button>
                            
                              <ul style="width:100%;text-align:right;padding:15px;font-size:17px" class="dropdown-menu" aria-labelledby="dropdownMenu1">
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
                        </div>
                    </div>
            </section>
		</div>

 
<?php
    
    }  
   
   }else{
       
     echo '<div class="col-xs-12"> <img style="width:100%" src="photo/icon/nodata.png" /> </div>';
       echo '<p style="color:#3086a3;text-align: center;font-size: 34px; }" > ! لاتوجد طلبات حاليا </p> ';
   }

}
    
     if(isset($_POST['order_stat'])){
        
         $order_stat = $_POST['order_stat'];
         $order_idd = $_POST['order_idd'];
         
         updateItem('ordarat', 'stat_order="'.$order_stat.'",mandop_done ='.$sessionID.'  WHERE id_order = '.$order_idd);

    }
    
    sleep(1);
}
?>
