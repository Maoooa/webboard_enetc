<?php
session_start();

// ตรวจสอบว่าผู้ใช้มีสิทธิเป็น admin หรือไม่
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'a') {
    header("Location: index.php");
    exit();
}

// เชื่อมต่อฐานข้อมูล
$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

// ตรวจสอบว่ามีการส่งข้อมูล POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // อัพเดทข้อมูลผู้ใช้
    $sql = "UPDATE user SET name = ?, gender = ?, email = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $gender, $email, $role, $user_id]);

    // แจ้งเตือนว่าการอัพเดทสำเร็จ
    $_SESSION['success'] = "แก้ไขข้อมูลผู้ใช้เสร็จสิ้น !";
    header("Location: user.php");
    exit();
}

// รับ user_id จาก URL
$user_id = $_GET['id'];

// ดึงข้อมูลผู้ใช้
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // ถ้าไม่พบผู้ใช้ให้ redirect ไปที่ user.php
    header("Location: user.php");
    exit();
}

$conn = null; // ปิดการเชื่อมต่อ
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผู้ใช้</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-lg">
        <h1 class="mt-3" style="text-align: center;">แก้ไขข้อมูลผู้ใช้</h1>
        <form action="" method="post"> <!-- ส่งข้อมูลไปที่หน้าเดียวกัน -->
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <div class="mb-3">
                <label for="login" class="form-label">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" name="login" value="<?= $user['login'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">เพศ</label>
                <select name="gender" class="form-select" required>
                    <option value="ชาย" <?= $user['gender'] == 'ชาย' ? 'selected' : '' ?>>ชาย</option>
                    <option value="หญิง" <?= $user['gender'] == 'หญิง' ? 'selected' : '' ?>>หญิง</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">สิทธิ</label>
                <select name="role" class="form-select" required>
                    <option value="u" <?= $user['role'] == 'm' ? 'selected' : '' ?>>Member</option>
                    <option value="b" <?= $user['role'] == 'b' ? 'selected' : '' ?>>Band</option>
                    <option value="a" <?= $user['role'] == 'a' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">บันทึกการแก้ไข</button>
            <a href="user.php" class="btn btn-secondary">ย้อนกลับ</a>
        </form>
    </div>
</body>
</html>
