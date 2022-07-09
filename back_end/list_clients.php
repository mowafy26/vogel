<?php
session_start();

include 'function_db.php';

if(isset($_SESSION['user_delivery'])){ 

    if(isset($_POST['info_client'])){
            
 if($count_client > 0 ){
    
     $clientslist = getAllfrom( "*" ,"client" ,"INNER JOIN area ON area.id_area = client.area_client WHERE own_saller = $sessionID ","", "id_client");	
     foreach($clientslist as $rowclient){ 
         
        $id_clie = $rowclient['id_client'];
         
    ?>
            <div id="info_cli_<?php echo $id_clie; ?>" class="panel">
                <div style="padding:15px 0px" class="panel-body">
                    <div class="media-main">
                        <div class="col-xs-12">
                            <div style="display:flex;margin-bottom:15px;direction:ltr">
                            <div style="padding:6px 9px;margin-right:20px" class="btn btn-info">
                                <i onclick="edit_clients(<?php echo $id_clie; ?>)" class="fa fa-edit"></i>
                            </div>
                            <div style="padding:6px 9px;" class="btn btn-danger">
                                <i onclick="delete_clients(<?php echo $id_clie; ?>)" class="fa fa-trash"></i>
                            </div>
                            </div>
                        </div>
                        <div class="info col-xs-12">
                            <div  class="home_info">
                                 <table style="margin-bottom:0px" class="table user-list">
                            <thead style="background-color:#ffffff;color:black" >
                                <tr style="text-align:center" class="maintrinfo">
                                    <td colspan="3" class="name_clients" >اسم العميل : <label><?php echo $rowclient['name_client']; ?></label> </td>
                                </tr>
                                <tr class="maintrinfo">
                                    <td colspan="3" class="col_tit" >العنوان : <span><?php echo $rowclient['adres_client']; ?></span></td>
                                </tr>
                                <tr class="maintrinfo">
                                    <td colspan="3" class="col_tit" >رقم الهاتف : 
                                    <span style="letter-spacing:4px" ><?php echo '0'.$rowclient['phone_client']; ?></span>
                                    </td>
                                </tr>
                                 <tr class="maintrinfo">
                                    <td class="col_tit" >اسم المنزل : <span><?php echo $rowclient['name_home']; ?></span> </td>
                                    <td class="col_tit" >رقم المنزل : <span><?php echo $rowclient['num_home']; ?></span> </td>
                                    <td class="col_tit">رقم الطابق : <span><?php echo  $rowclient['num_floor']; ?></span></td> 
                                </tr> 
                                 
                            </thead>           
                        </table>
                            </div>
                        </div>
                        <div style="margin-top:23px" class="col-xs-12"> 
                        
                        <small style="color:#d9534f" >
                        <i class="fas fa-map-marker-alt"></i>
                            <?php echo $rowclient['area_Name']; ?>
                        </small>
                    <small style="letter-spacing:4px;float:left" ><?php echo date('d/m/Y', strtotime($rowclient['date_client'])); ?></small>
                        
                        </div>
                        
                    </div>
                </div>
            </div>
    <?php
             
         }
 echo '</div>';
 }else{
     
       echo '<div id="noneclients" style="text-align:center" class="col-xs-12"> <img style="opacity:0.5;" src="photo/icon/resume.png" />';
       echo '<p class="" style="color:#3086a3;margin-top:20px;font-size:23px" > ! لايوجد عملاء </p></div>';
    }

    }

    sleep(1);

}