<?php
//header('Access-Control-Allow-Origin: *');

ob_start("ob_gzhandler");

$url_going = '';

session_start();

unset($_SESSION['user_delivery'] , $_SESSION['id_delivery']);
?>
<script type="text/javascript" >
      sessionStorage.setItem("loginedon", 0);
</script>
<?php
session_destroy();
    
ob_end_flush();

?>