<?php
session_start();

include 'function_db.php';

if(isset($_SESSION['user_delivery'])){ 

     if(isset($_POST['allopinions'])) {
         
         if(isset($_POST['users_opinions'])) {
        
             $users_opinions = $_POST['users_opinions'];
             
         }else if(isset($_POST['myopinion_show'])) {
             
             $users_opinions = $sessionID;
             
         }
         
        $opinions_all = getAllfrom( "*" ,"opinions" ,"INNER JOIN users ON users.id = opinions.opinion_from WHERE opinion_to = $users_opinions ","", "id_opinion");	
     
        $rcount_opinion = count($opinions_all);

         if($rcount_opinion > 0 ){ ?>
             
             
    <ul style="direction:rtl;text-align:right;margin-bottom:0px;display:inline" class="media-list">
         
        <div class="user-dashboard-info-box">
          
          <table style="margin-bottom:0px" class="table manage-candidates-top">
            
              <tbody id="not_show" >
                
<?php 
                               
        foreach($opinions_all as $opinions){ 
        

            $opinions_id = $opinions['id_opinion']; 
            
            $reported_count = countItems('reporter_id ','reporter'," WHERE report_opinion = $opinions_id ");
                              
                  ?>

              <tr style="background:#f8f8f8" class="candidates-list" >
                <td class="title">
                        <div style="display: grid;text-align: center;" class="thumb">
                          <img class="img-fluid" src="photo/avatar/unknown.png" alt="">
                          <small style="margin-top:10px;">
                              <?php $nameuse = $opinions['name_tager']; replce_char($nameuse); ?>
                          </small>
                      </div>
                  <div class="candidate-list-details">
                    <div class="candidate-list-info">
                      <div class="candidate-list-option">
                        <ul class="list-unstyled">
                                                    
                        <li style="word-break:break-all" >
                            <?php echo $opinions['txt_opinion']; ?>
                        </li>
                   
                        </ul>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  <ul style="float: left;margin-left: 14px;width:100px" class="list-unstyled d-flex justify-content-end">
                  <?php if($reported_count == 0){ 
                      
                      if($sessionID == $opinions['opinion_to']){ ?>
                      
                      <li style="border-bottom:2px solid" onclick="opinion_report(<?php echo $opinions_id; ?>);" >
                      <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>ابلاغ</span>
                      </li>
                      
                 <?php 
                      }
                  }else{ ?>
                      
                  <li style="border-bottom:2px solid" >
                      <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>تم الابلاغ</span>
                      </li>    
                      
                  <?php } ?>
                      
                  </ul>
                </td>
              </tr>             
<?php } ?>
                
            </tbody>
          
          </table>
       
        </div>

     </ul>
   
<?php    }else{
             
             echo '<div style="color:rgb(101 95 95 / 60%);margin:50px 0px"> <i style="font-size:45px" class="fa-solid fa-face-grin-beam-sweat"></i><h3> لا توجد اي آراء ! </h3> </div>';
             
         }
    
         
         
     }

     if(isset($_POST['opioion_user_to'])) {
         
     $touser = $_POST['opioion_user_to'];
     $msgcomment = $_POST['msg'];
         
        $count_write = countItems('id_opinion','opinions'," WHERE opinion_from = $sessionID AND opinion_to = $touser ");

         if($count_write == 0){
    
             insertItems('opinions','(txt_opinion,opinion_from,opinion_to)','VALUES("'.$msgcomment.'",'.$sessionID.','.$touser.')');
             
         }else if($count_write == 1){
    
             updateItem('opinions','txt_opinion = "'.$msgcomment ,'" WHERE opinion_from = '.$sessionID.' AND opinion_to = '.$touser );

         }
         
            echo  $user_opinion = countItems('id_opinion','opinions'," WHERE opinion_to = $touser ");

         
     }
    
     if(isset($_POST['idreport_opinion'])) {
         
     $idopinion = $_POST['idreport_opinion'];
     $msgcomment = $_POST['msg_report'];
         
    $report_opinion = $con->prepare("INSERT INTO reporter(report_from,report_opinion,report_about,resone_report) VALUES($sessionID,$idopinion,'opinion','$msgcomment')");
    
     $report_opinion->execute();  
         
         
     }
    
     if(isset($_POST['rate_star_num'])){
        
         $user_torate = $_POST['user_torate'];
         $rate_star_user = $_POST['rate_star_num'];
        
        $count_star = countItems('id_rate','rate'," WHERE rate_from = $sessionID AND rate_to = $user_torate ");

         if($count_star == 1 ){
             
             updateItem('rate','count_rate = '.$rate_star_user ,' WHERE rate_from = '.$sessionID.' AND rate_to = '.$user_torate );
        
         }else if ($count_star == 0 ){
            
             insertItems('rate','(count_rate,rate_from,rate_to)','VALUES('.$rate_star_user.','.$sessionID.','.$user_torate.')');
    
         }
     
         
    }
    
}
?>
