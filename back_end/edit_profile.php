<?php 
session_start();
include 'function_db.php';

if(isset($_SESSION['user_delivery'])){
    
// update avatar    
if(isset($_POST['avatar'])){

    $avatar = $_POST['avatar'];
    
    updateItem('users','avater_user = "'.$avatar.'"' ,' WHERE id = '.$sessionID );

}

// update info_text_profile     
if(isset($_POST['name_feild']) && isset($_POST['inp_save']) && $_POST['inp_save'] != ''){
    
$inp_save = $_POST['inp_save'];    
$name_feild =  $_POST['name_feild'];
    
$pattshop = "/^[a-zA-Z]{4,10}$/";
$pattpas = "/^[\w]{8}$/";
$patt_phone = "/^(01[\d]{9})*$/";    
$precover = "XWZ012201110000qo" ;   
$pascover = "AaBC01201145678Zz" ;     
    
    $formError = array();
   
    switch($name_feild) {
    
        case 'pass_tager': 
        $uspass = preg_match($pattpas,$inp_save);
        break;    
        
        case 'name_tager':
        $nameshop = preg_match($pattshop,$inp_save);
        break;
        
        case 'phone_tager':
        $patphone = preg_match($patt_phone,$inp_save); 
        break;
                     
    }
    
//============
    
if(isset($uspass) && $uspass != 1 ){ $formError[] = ' تاكد من عدم وجود حروف غريبة ، رموز ، مسافات إضافية '; }
        
if(isset($nameshop) && $nameshop != 1){ $formError[] = ' تاكد من عدم وجود حروف غريبة ، رموز ، مسافات إضافية '; }
        
if(isset($patphone) && $patphone != 1){ $formError[] = ' أكتب رقم الهاتف بطريقة صحيحة '; }
        
if(empty($formError)){
                
    if($name_feild == 'pass_tager'){
    
    $passwordedit = $precover.$inp_save.$pascover;
    $pas = sha1($passwordedit);  

updateItem('users','pass_tager = "'.$pas.'", passtext_tager = "'.$inp_save ,'"  WHERE id = '.$sessionID );
   
    }else{
                
updateItem('users',$name_feild.' = "'.$inp_save.'"' ,' WHERE id = '.$sessionID );

    }
    
        echo  $inp_save." ,  تم الحفظ ";
                          
        sleep(1);
             
}else{
                    
    echo $formError[0];
                         
}
/*=========================================================*/
}
    
// update info_select_profile     
if(isset($_POST['felid_name']) && isset($_POST['this_id_val']) ){
 
$this_id_val = $_POST['this_id_val'];    
$felid_name =  $_POST['felid_name'];
    
updateItem('users',$felid_name.' = '.$this_id_val ,' WHERE id = '.$sessionID );
    
    
 $count_order_user = countItems('id_order','ordarat',"WHERE own_order = $sessionID ");
                
    if($count_order_user > 0){
    
        updateItem('ordarat','order_from = '.$this_id_val ,' WHERE own_order = '.$sessionID );
        
    }
        
    sleep(1);
       
}    
 
}
    
?>
