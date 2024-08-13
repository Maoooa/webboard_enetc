<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webboard</title>
</head>
<body>
    <h1 style="text-align: center;">Webboard KakKak</h1>
    <hr>
    
    <?php 
    if(!isset($_SESSION['id'])){
        echo "<a href='login.php' target='_blank' style='float:right'> เข้าสู่ระบบ </a>";
    
    }else{

        echo "<span style='float:right'>ผู้ใช้งานระบบ : $_SESSION[username]&nbsp; 
              <a href='logout.php' style='float:right'> ออกจากระบบ </a> 
              </span>";

    }
    ?>
    
    หมวดหมู่ : 
    <select name="category">
        <option value="all">--ทั้งหมด--</option>
        <option value="general">เรื่องทั่วไป</option>
        <option value="study">เรื่องเรียน</option>
    </select>
    <br>
    <a href="newpost.php" >สร้างกระทู้ใหม่ </a>
    
    <br>
    <form action="post.php" method="get">
        <ul>
            <?php 
            for($i = 1; $i<= 10;$i++){
                echo "<li><a href=post.php?id=$i>กระทู้ที่ $i</a>";
                if(isset($_SESSION['id'])&&($_SESSION['role'])=='a'){
                    echo "&nbsp;&nbsp;<a href=delete.php?id=$i>ลบ</a>";
                }
            }
            echo "</il>";
        ?>
        </ul>

    </form>
    
    
   
    
</body>
</html>