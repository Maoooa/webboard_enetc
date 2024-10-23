<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

// ตรวจสอบว่ามีการส่ง ID มาไหม
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ตรวจสอบว่าหมวดหมู่นี้มีอยู่จริงในฐานข้อมูล
    $check_sql = "SELECT * FROM category WHERE id = :id";
    $stmt = $conn->prepare($check_sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // ลบหมวดหมู่
        $delete_sql = "DELETE FROM category WHERE id = :id";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bindParam(':id', $id);

        if ($delete_stmt->execute()) {
            $_SESSION['success'] = "ลบหมวดหมู่เรียบร้อยแล้ว";
        } else {
            $_SESSION['error'] = "ไม่สามารถลบหมวดหมู่ได้";
        }
    } else {
        $_SESSION['error'] = "ไม่พบหมวดหมู่ที่ต้องการลบ";
    }
} else {
    $_SESSION['error'] = "ไม่มี ID ของหมวดหมู่";
}

$conn = null; // ปิดการเชื่อมต่อฐานข้อมูล
header("Location: category.php"); // ส่งกลับไปยังหน้า category.php
exit();
