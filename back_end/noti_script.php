<?php
session_start();

include 'function_db.php';

if(isset($_SESSION['user_delivery'])){ 

     if(isset($_POST['nooti'])) {
         

        $notification_all = getAllfrom( "*" ,"noti_mandop" ,"INNER JOIN users ON users.id = noti_mandop.noti_fromuser INNER JOIN ordarat ON ordarat.id_order = noti_mandop.for_ord  WHERE noti_touser = $sessionID ","", "id_noti");	
     
        $rcount_noti = count($notification_all);

         if($rcount_noti > 0 ){ ?>
             
             
    <ul style="direction:rtl;text-align:right;margin-bottom:0px;display:inline" class="media-list">
         
        <div class="user-dashboard-info-box">
          
          <table style="margin-bottom:0px" class="table manage-candidates-top">
            
              <tbody id="not_show" >
                
<?php 
                               
        foreach($notification_all as $noti){ 
        
            $Member_id = $noti['noti_fromuser'];          
            $noti_id = $noti['id_noti']; 
            $stat_noti = $noti['stat_orders'];
                  
                  ?>

              <tr style="background:#f8f8f8" id="not<?php echo $noti_id; ?>" class="candidates-list noti<?php echo $noti['notiread']?>">
                <?php if($user['code_tager'] == 1){ ?>
                  
                  <td onclick="go_list_mandop(<?php echo $noti_id; ?>,'list_mandop');" class="title">
                          
                 <?php }else{ ?>
                          
                  <td onclick="go_list_mandop(<?php echo $noti_id; ?>,'delivery_order');" class="title">
               <?php } ?>
                      <div class="thumb">
                          <img class="img-fluid" src="<?php echo $url_going.'avatar/'.$noti['avater_user']; ?>" alt="">
                            <small><?php echo $noti['name_tager']; ?></small> 

                      </div>
                  <div class="candidate-list-details">
                    <div class="candidate-list-info">
                      <div class="candidate-list-option">
                        <ul style="padding:0px" class="list-unstyled">
                            
                          <?php if($noti['noti_about'] === 'accepter_order' ){ 
             
                            if($stat_noti === 'r' ){ ?>
                                
                        <li style="word-break:break-all" >
                            <span class="go_profile" onclick="go_profile(<?php echo $Member_id; ?>,'');" >
                                <?php echo $noti['name_tager']; ?> 
                            </span>
                            <span style="color:#337ab7"> مستعد</span> توصيل
                            </li>
                            <li>( <?php echo $noti['names_order']; ?> )</li>    

                       <?php
    
                   
                            }else if($stat_noti === 'k'){
                                
        echo '<li style="word-break:break-all" > <span style="color:green">تم قبول</span> طلبك لتوصيل </li>';
                        echo '<li> ( '.$noti['names_order'].' ) </li>';

                                
                            }else if($stat_noti === 'x'){
                             
       echo '<li style="word-break:break-all" > <span style="color:red">تم رفض</span> طلبك لتوصيل </li>';
                        echo '<li> ( '.$noti['names_order'].' ) </li>';

                            }
                            
                           }
                            ?>
                         <li onclick="delete_noti(<?php echo $noti_id; ?>);" class="delete_noti" >
                             <i class="far fa-trash-alt"></i>
                         </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
                
<?php } ?>
                
            </tbody>
          
          </table>
       
        </div>

     </ul>
   
<?php    }else{
             
             echo '<div style="color:rgb(101 95 95 / 60%);margin:50px 0px"> <i style="font-size:45px" class="fas fa-bell-slash"></i><h3>   لا توجد اي اشعارات ! </h3> </div>';
             
             
         }
    
         
         
     }


}
?>
