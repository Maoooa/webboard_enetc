<?php
session_start();
if (isset($_SESSION['id'])) {
    header('location:index.php');
}
?>
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
    <?php
    if ($_POST["login"] == "admin" && $_POST["pwd"] == "ad1234") {
        $_SESSION["username"] = "admin";
        $_SESSION["role"] = "a";
        $_SESSION["id"] = session_id();
        header('location:index.php');
        die();
        //echo "ยินดีต้อนรับคุณ ADMIN ";
        //echo "<a href="."index.php"."> <BR> กลับไปยังหน้าหลัก</a>";
    } elseif ($_POST["login"] == "member" && $_POST["pwd"] == "mem1234") {
        $_SESSION["username"] = "member";
        $_SESSION["role"] = "m";
        $_SESSION["id"] = session_id();
        header('location:index.php');
        die();
        //echo "ยินดีต้อนรับคุณ MEMBER ";
        //echo "<a href="."index.php"."> <BR> กลับไปยังหน้าหลัก</a>";
    } else {
        // echo "ชื่อบัญชีและรหัสผ่านไม่ถูกต้อง";
        $_SESSION['error'] = 'error';
        header('location:login.php');
        die();
    }
    ?>


</body>

</html>