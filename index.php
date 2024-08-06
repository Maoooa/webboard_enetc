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
    <p style="float: right;">
        <a href="login.html" target="_blank">เข้าสู่ระบบ</a>
    </p>
    หมวดหมู่: 
    <select name="category">
        <option value="all">--ทั้งหมด--</option>
        <option value="general">เรื่องทั่วไป</option>
        <option value="study">เรื่องเรียน</option>
    </select>
    <br>
    <form action="post.php" method="get">
        <ul>
            <?php 
            for($i = 1; $i<= 10;$i++){
                echo "<li><a href=post.php?id=$i>กระทู้ที่ $i</a></li>";
            }
            ?>
        </ul>
    </form>
    
    
   
    
</body>
</html>