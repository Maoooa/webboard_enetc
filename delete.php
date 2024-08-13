<?php
session_start();
if(isset($_SESSION['id']) && $_SESSION['role'] == 'a'){
    echo "ลบกระทู้ หมายเลข $_GET[id]";
}else{
    header("location:index.php");
    die();
}
?>
