<?php
    session_start();
    $id = $_POST['ID'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $mail = $_POST['email'];
    $role = $_POST['role'];

    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");

    $sql = "UPDATE user Set name='$name',gender='$gender',email='$mail',role='$role' Where id='$id'";

    $conn->exec($sql);
    $conn = null;
    $_SESSION['seccess'] = 'done';
    header("location: user.php");
?>