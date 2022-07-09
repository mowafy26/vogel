<?php
header('Access-Control-Allow-Origin: *');
/*
$dsn = 'mysql:host=localhost;dbname=delivery';
$userw = 'root';
$pass = '';
$option = array(
PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
);
*/
$dsn = 'mysql:host=localhost;dbname=id18170871_d';
$userw = 'id18170871_dv';
$pass = 'mzWpUc47fbL<0Ei%';
$option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',);

try{
    $con = new PDO($dsn,$userw,$pass,$option);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);    
}
catch(PDOException $e ){
    echo 'Failed To Connect ' . $e->getMessage();    
}

date_default_timezone_set('Africa/Cairo');

$sessionUesr = '';
$sessionID = 0;

$url_going_to = 'https://2bdoctor.000webhostapp.com/back_end/';
$url_going = 'https://2bdoctor.000webhostapp.com/back_end/';

//$url_going_to = 'back_end/';
//$url_goio = '../back_end/';

if(isset($_SESSION['user_delivery'])) {
    
$sessionID = $_SESSION['id_delivery'];
$sessionUser = $_SESSION['user_delivery'];

 $user = get_anything("*","users","INNER JOIN city ON city.id_city = users.city_tager INNER JOIN area ON area.id_area = users.area_tager INNER JOIN cate ON cate.id_category = users.category_tager  WHERE id = $sessionID AND name_tager = '$sessionUser' ");
 
 $count_client = countItems('id_client','client'," WHERE own_saller = $sessionID ");
    
 $count_done_orderes = countItems('id_order','ordarat'," WHERE own_order = $sessionID AND stat_order = 'done' ");
    
 $count_watting_orderes = countItems('id_order','ordarat'," WHERE own_order = $sessionID AND stat_order = 'wait' ");
 
 $count_noti = countItems('id_noti','noti_mandop'," WHERE noti_touser = $sessionID AND notiread = 0 ");
 
 $count_manadep = countItems('accepter_id','accepter_order'," WHERE own_userr = $sessionID ");
    
}

/*=========================================================================*/

// func help system to get sql 

function getAllfrom($field,$table,$where = NULL , $and = NULL ,$orderfield , $ordering = "DESC" ){
   global $con;

   $getAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering ");
   $getAll->execute();
   $all = $getAll->fetchAll();
   return $all;
}
function get_anything($filed,$tabel,$write_any_things = NULL){
    
    global $con;
    $statment_anything = $con->prepare("SELECT $filed FROM  $tabel $write_any_things "); 
    $statment_anything->execute();    
    $get = $statment_anything->fetch();
    return $get;
        
    }

function get_arealist($idpeer = NULL){

    $arealist = getAllfrom( "*" , "area" ,"where city_area = '1' ","", "", "id_area");	

    foreach($arealist as $rowu){ 
        echo '<option id="'.$rowu["code_area"].'" value="'.$rowu["id_area"].'"';
        if($idpeer == $rowu["id_area"]) { echo 'selected'; }
        echo '>'.$rowu["area_Name"].'</option>';
    }

}

function get_categorylist($idcater = NULL){
    
    $catelist = getAllfrom( "*" , "cate" ,"WHERE NOT id_category = 2 ","", "", "id_category");	
    
    foreach($catelist as $rowcate){ 
        echo '<option value="'.$rowcate["id_category"].'"';
        if($idcater == $rowcate["id_category"]) { echo 'selected'; }
        echo '>'.$rowcate["name_category"].'</option>';
    }

}

function get_transportlist($idtrans = NULL){
     
        echo '<option value="1" ';if($idtrans == 1) { echo 'selected'; }echo '>من غير وسيلة</option>';
        echo '<option value="2" ';if($idtrans == 2) { echo 'selected'; }echo '>عجلة</option>';
        echo '<option value="3" ';if($idtrans == 3) { echo 'selected'; }echo '>اسكوتر</option>';
        echo '<option value="4" ';if($idtrans == 4) { echo 'selected'; }echo '>سيارة</option>';
    
}

function getTitle() {
    global $pageTitle;
    if(isset($pageTitle)) {
        
        echo $pageTitle;
        
    }else{  echo 'Default'; }
    
}

function countItems($item,$table,$where = NULL) {
 global $con;   
 $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table $where ");
 $stmt2->execute();
 return $stmt2->fetchColumn();  
    
}

function insertItems($insert,$key_feildin,$valuein) {
 global $con;   
 $stmt_insert_new = $con->prepare("INSERT INTO $insert $key_feildin $valuein ");
 $stmt_insert_new->execute();
}	

function insertNotification($table_noti,$noti_about,$noti_type,$noti_to,$statnoti,$smsnoti) {
 global $con;   
$stmt_insert_noti = $con->prepare("INSERT INTO notification (table_noti,ite_foo_id,food_item,noti_to,stat_noti,sms_noti) VALUES('".$table_noti."',".$noti_about.",'".$noti_type."',".$noti_to.",".$statnoti.",'".$smsnoti."')" );
 $stmt_insert_noti->execute();
}	

function deletItems($deletfrom,$whatdelet) {
 global $con;   
 $stmt_delet = $con->prepare("DELETE FROM $deletfrom $whatdelet");
 $stmt_delet->execute();
}

function checkItem($select,$from,$value) {
    global $con;
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    
    return $count;
    
}

function updateItem($tabel,$key_val,$where = NULL){
    global $con;
    $stmt_updat = $con->prepare("UPDATE $tabel SET $key_val $where ");
    $stmt_updat->execute();

}

// my func fust { fill --> select } 

function filltag_mark($con,$idtag,$counterr){
       
 $quetag = "SELECT * FROM markat WHERE id_Tag = '$idtag' ";
 $statetag = $con->prepare($quetag);
 $statetag->execute();
    
$countmarka = $statetag->fetchColumn();
 $outmarka = " ";
    
if($countmarka > 0){
    
    $outoo = $statetag->fetchAll();

$outmarka .= "<label>الماركة</label><select name='marka[]' id='marka".$counterr."' data-sub_marrk='".$counterr."' class='form-control merk col-lg-offset-5 col-lg-4' > <option value='0' > الماركة </option> " ;
 foreach($outoo as $don)
 {
	 	 
  $outmarka .= '<option value="'.$don["idmarka"].'">'.$don["marka_name"].'</option>';
 
 }
$outmarka .= '</select>';
        
}else{ $outmarka .= "<select name='marka[]'  id='marka".$counterr."' data-sub_marrk='".$counterr."' class='form-control merk col-lg-offset-5 col-lg-4' hidden > <option value='1' ></option> </select> " ; }
    
  return $outmarka;   

}

function fill_selcategory($con,$iddtag){
 $qutag = "SELECT * FROM tagsitems WHERE idcate = '$iddtag' ";

 $stattag = $con->prepare($qutag);

 $stattag->execute();

 $outcat = $stattag->fetchAll();

 $showtag = " ";
	if($iddtag != 0 ){

  $showtag .= '<option value="0" > اختر الفئة  </option> ';     
 foreach($outcat as $tagercat){
     
  $showtag .= '<option value="'.$tagercat["idt"].'">'.$tagercat["tagname"].'</option>';
                      
    }
}else if($iddtag == 0){
        
  $showtag .= '<option value="0" > اختر الفئة </option> ';
 
        
    }
 

 return $showtag;
}

function fill_selarea($con,$iddarea){
    
 $quearea = "SELECT * FROM area WHERE cityarea = '$iddarea' ";

 $statearea = $con->prepare($quearea);

 $statearea->execute();

 $outarea = $statearea->fetchAll();

 $showarea = " ";
    
	if($iddarea > 0 ){

 foreach($outarea as $areacity){
     
  $showarea .= '<option value="'.$areacity["IDarea"].'">'.$areacity["areaName"].'</option>';
                      
    }
}

 return $showarea;
}

function fill_select_box($con,$iacate){
    
 $queryddd = "SELECT * FROM tagsitems WHERE idcate = '$iacate' ";
 $statementddd = $con->prepare($queryddd);
 $statementddd->execute();
 $rdesult = $statementddd->fetchAll();
 $outputdd = " ";
 foreach($rdesult as $rowu)
 {
	 	 
  $outputdd .= '<option value="'.$rowu["idt"].'">'.$rowu["tagname"].'</option>';
 
 }

 return $outputdd; 
}

// my func 
/*
function check_field($what,$tab,$useID,$UserName){
    
$cheekk = get_anything($what,$tab,"WHERE ID = $useID AND username = '$UserName' ");
$phoneshop = empty($cheekk['phoneNum']);
$passshop = empty($cheekk['Password']);

    $arr = array('1', '2', '3', '4');
$is_inarray = in_array($cheekk['workshop'],$arr);
$output_check = array($cheekk['usercity'],$cheekk['placeshop']);    
$is_this_array = in_array('1',$output_check);
    
if($nameshop || $addresshop || $phoneshop || $passshop || $is_inarray || $is_this_array ){
    
    $status = "0";
    updateItem('users','data_full = 0','WHERE IDuser = '.$useID.' AND Adminuser = '.$useAdmin);    
   
}else{
    
    $status = "1";
    updateItem('users','data_full = 1','WHERE IDuser = '.$useID.' AND Adminuser = '.$useAdmin);    
}
    
return $status;    
}
*/

function resize_image($file, $max_resolution,$heightth) {
    $imgdata = base64_decode($file);

   $original_image = imagecreatefromstring(file_get_contents($file));
	 // var_dump($original_image); 
   $original_width = imagesx($original_image);
   $original_height = imagesy($original_image);
//   $ratio = $max_resolution / $original_width;
   $ratio = 1;
   $new_width = $max_resolution;
//   $new_height = $original_height * $ratio;
     $new_height = $heightth;

   if($new_width > $max_resolution) {
//      $ratio = $max_resolution / $original_height;
       $ratio = 1;
      $new_height = $heightth;
//      $new_width = $original_width * $ratio;
      $new_width = $max_resolution;
    }

   if($original_image) {
     $new_image = imagecreatetruecolor($new_width, $new_height);
     imagecopyresampled($new_image, $original_image,0,0,0,0,$new_width, $new_height, $original_width, $original_height);
     imagejpeg($new_image, $file, 100);
    }

  }

function getDateTimeDiff($date){
    
 $now_timestamp = strtotime(date('Y-m-d H:i:s'));
 $diff_timestamp = $now_timestamp - strtotime($date);
 
 if($diff_timestamp < 60){
     
  return 'منذ ث';
 }
 else if($diff_timestamp>=60 && $diff_timestamp < 3600){
  return ' منذ '.round($diff_timestamp/60).' د ';
 }
 else if($diff_timestamp>=3600 && $diff_timestamp < 86400){
  return ' منذ '.round($diff_timestamp/3600).' س';
 }
 else if($diff_timestamp>=86400 && $diff_timestamp < (86400*30)){
  return ' منذ '.round($diff_timestamp/(86400)).' ي ';
 }

}
function replce_char($nameuse){
        
    $count_name = strlen($nameuse);
    if($count_name >= 6){ $count_minuss = $count_name - 2 ; }else{ $count_minuss = 2;  }
    $lopstres = '';
    for($x = 1; $x <= $count_minuss; $x++) { $lopstres .= "*"; }            
    echo substr_replace($nameuse,$lopstres,1,$count_minuss);        
}


?>