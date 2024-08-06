<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $login = $_POST["login"];
    $pwd = $_POST["pwd"];
    ?>
    <h1 style="text-align: center;"> Webboard KakKak</h1>
    <div style="text-align: center;">
        <br>
        <?php 
        if($login == "admin" && $pwd == "ad1234"){
            echo "ยินดีต้อนรับคุณ ADMIN ";
        } 
        elseif ($login == "member" && $pwd == "mem1234"){
            echo "ยินดีต้อนรับคุณ MEMBER ";
        }
        else{
            echo "ชื่อบัญชีและรหัสผ่านไม่ถูกต้อง";
        }
        ?>
        <p style="text-align: center;"><a href="index.php">กลับไปหน้าหลัก</a></p>
    </div>
</body>
</html>