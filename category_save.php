<?php
session_start();

try {
    // เชื่อมต่อฐานข้อมูล
    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

    // ตั้งค่าให้เกิดข้อผิดพลาดหากมี
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ตรวจสอบว่ามีการส่งข้อมูล
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['categoryName'])) {
        $categoryName = $_POST['categoryName'];

        // เพิ่มหมวดหมู่ใหม่ลงในฐานข้อมูล
        $sql = "INSERT INTO category (name) VALUES (:categoryName)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':categoryName', $categoryName);
        $stmt->execute();

        // ตั้งค่าแจ้งเตือน
        $_SESSION['success'] = "เพิ่มหมวดหมู่เรียบร้อย";

        // ส่งกลับไปยังหน้า category.php
        header("Location: category.php");
        exit();
    }
} catch (PDOException $e) {
    // หากเกิดข้อผิดพลาด
    $_SESSION['error'] = "เกิดข้อผิดพลาดในการเพิ่มหมวดหมู่: " . $e->getMessage();
    header("Location: category.php");
    exit();
}
?>
