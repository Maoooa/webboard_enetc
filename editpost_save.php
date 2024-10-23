<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $post_id = $_POST['post_id'];
    $category_id = $_POST['category'];
    $topic = $_POST['topic'];
    $content = $_POST['comment'];
    
    // อัปเดตข้อมูลในตาราง post
    $sql = "UPDATE post SET cat_id = :category_id, title = :title, content = :content WHERE id = :id";
    $stmt = $conn->prepare($sql);
    
    // Execute the statement
    if ($stmt->execute([
        'category_id' => $category_id,
        'title' => $topic,
        'content' => $content,
        'id' => $post_id
    ])) {
        // ส่งกลับไปยัง editpost.php พร้อมกับข้อความแจ้งเตือนใน URL
        header("Location: editpost.php?id=$post_id&message=แก้ไขข้อมูลเรียบร้อย");
        exit();
    } else {
        // ถ้าการอัปเดตไม่สำเร็จ ส่งกลับไปยัง editpost.php พร้อมข้อความข้อผิดพลาดใน URL
        header("Location: editpost.php?id=$post_id&error=เกิดข้อผิดพลาดในการแก้ไขข้อมูล");
        exit();
    }
}

// ปิดการเชื่อมต่อ
$conn = null;
?>
