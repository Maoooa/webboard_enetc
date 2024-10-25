<?php
session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['id'])) {
    header("location:index.php");
    die();
}

// เชื่อมต่อฐานข้อมูล
$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

// ดึง user_id ของโพสต์นั้น ๆ เพื่อตรวจสอบเจ้าของ
$post_id = $_GET['id'];
$sql = "SELECT user_id FROM post WHERE id = $post_id";
$result = $conn->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);

// ตรวจสอบสิทธิ์: ต้องเป็น admin หรือเจ้าของโพสต์เท่านั้น
if ($row && ($_SESSION['role'] == 'a' || $_SESSION['user_id'] == $row['user_id'])) {
    // ลบโพสต์และความคิดเห็นที่เกี่ยวข้อง
    $conn->exec("DELETE FROM post WHERE id = $post_id");
    $conn->exec("DELETE FROM comment WHERE post_id = $post_id");

    header("location:index.php");
} else {
    // หากไม่มีสิทธิ์ในการลบ
    header("location:index.php");
    die();
}

$conn = null;
?>
