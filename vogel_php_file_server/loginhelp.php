<?php 
//header('Access-Control-Allow-Origin: *');

session_start();

include 'function_db.php';

$pattuser = "/^[a-zA-Z]{4,10}$/";
$pattpas = "/^[\w]{8}$/";
$pattphone = "/^1[0-9]{9}$/";

$precover = "XWZ012201110000qo" ;   
$pascover = "AaBC01201145678Zz" ;

if(isset($_POST['usernamelogin'] ) && $_POST['passwordlogin'] != '' ) {
  
$user1 = $_POST['usernamelogin'];
$statuserreg = preg_match($pattuser,$user1);
$passreg = preg_match($pattpas,$_POST['passwordlogin']);
    
$pass = $precover.$_POST['passwordlogin'].$pascover ;
$hashedpass = sha1($pass) ;
$stmtuserbuy = $con->prepare("SELECT * FROM 
                                       users 
                                   WHERE
                                       name_tager = ? 
                                   AND
                                       pass_tager = ?
                                   
                                       ");

 $stmtuserbuy->execute(array($user1,$hashedpass));
 $getts = $stmtuserbuy->fetch(); 
 $countsuserbuy = $stmtuserbuy->rowCount();
		
  if($countsuserbuy > 0){
      
$_SESSION['user_delivery'] = $user1; 
$_SESSION['id_delivery'] = $getts['id'];
      
    echo $getts['code_tager'];
           
  }else{
	  
      if($statuserreg == 1){
    
      $check = checkItem('name_tager','users',$user1);
      
          if($check != 1){
      
          echo "10" ; 
          
          }else{ 
              
              if( $passreg == 1){ echo "20"; }else{ echo "30"; }  
          } 
      
      }else{ 
          
        echo "40";
        
      }
  }
    
sleep(1);
    
}else if(isset($_POST['name_tager'] ) && isset($_POST['phone_tager']) && $_POST['pass_tager'] != ''){
    
		  //=========================	
    $nameRegsale = $_POST['name_tager'];
    $passRegsale = $_POST['pass_tager'];
    $passwordsale = $precover.$passRegsale.$pascover;
    $phoneRegsale = $_POST['phone_tager'];
    $areaRegsale = $_POST['area_list'];
    $cateRegsale = $_POST['cate_list'];
    $code_user = 1;

    $salename = preg_match($pattuser,$nameRegsale); 
    $salepass = preg_match($pattpas,$passRegsale); 
    $salephone = preg_match($pattphone,$phoneRegsale); 
    
    $checkstudent_name = checkItem('name_tager','users',$nameRegsale);
    $checkstudent_phone = checkItem('phone_tager','users',$phoneRegsale);
    
    if($salename != 1){ 
        
        echo "50";               
    
            if($salepass != 1){ 
    
            echo "60"; 
    
            }else if($salephone != 1){ 
    
             echo "70"; 
            
            }else if($areaRegsale == 1){ 
    
             echo "100"; 
            
            }
    
    }else{
                 
        
        if($checkstudent_name > 0 ){

        echo "80" ;
        
        }else if($checkstudent_phone > 0 ){ 
            
        echo "90" ;
               
        }else{

        $stmtsale = $con->prepare("INSERT INTO 
        users(name_tager,pass_tager,passtext_tager,phone_tager,city_tager,area_tager,category_tager,code_tager,adres_tager,place_own,place_write,trans_port,avater_user)
        VALUES(:zuserReg,:zpassReg,:zpasstext,:zuserphone,1,:zuserarea,:zusercate,:zuser_code,:zadres_tager,:zplace_own,:zplace_write,:ztrans_port,:zavatar)");

        $stmtsale->execute(array(
        'zuserReg'   => $nameRegsale,
        'zpassReg'   => sha1($passwordsale),
        'zpasstext'  => $passRegsale,   
        'zuserphone' => $phoneRegsale,
        'zuserarea' => $areaRegsale,
        'zusercate'  => $cateRegsale,            
        'zuser_code'  => $code_user,
        'zadres_tager'  => '',
        'zplace_own'  => '',
        'zplace_write'  => '',
        'ztrans_port'  => 0,
        'zavatar' => 'none.png'   
        ));

        echo "1" ;

        }
            
    }
			                
            
sleep(1);    
    
//=======================================================
                
}else{
    
    //header('Location:');
    echo 'error';
}

?>