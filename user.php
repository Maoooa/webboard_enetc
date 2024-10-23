<?php
session_start();

// ตรวจสอบว่าผู้ใช้มีสิทธิเป็น admin หรือไม่
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'a') {
    header("Location: index.php");
    exit();
}

// เชื่อมต่อฐานข้อมูล
$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

// ดึงข้อมูลผู้ใช้ทั้งหมด
$sql = "SELECT * FROM user";
$users = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$conn = null; // ปิดการเชื่อมต่อ
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ใช้งาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container-lg">
        <h1 style="text-align: center;" class="mt-3">Webboard KakKak</h1>
        <!-- navbar -->
        <?php include "nav.php" ?>

        <!-- แสดงข้อความแจ้งเตือน -->
        <?php if (isset($_SESSION['success'])){
            echo " <div class='alert alert-success mt-3'> $_SESSION[success] </div> ";
                unset($_SESSION['success']);
                
        } ?>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ชื่อผู้ใช้</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>เพศ</th>
                    <th>อีเมล</th>
                    <th>สิทธิ</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $row): ?>
                    <tr>
                        <td><?= $row['login'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['role'] ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $row['id'] ?>">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Modal แก้ไขผู้ใช้ -->
                    <div class="modal fade" id="editUserModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel">แก้ไขข้อมูลผู้ใช้</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="edituser.php" method="post">
                                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                        <div class="mb-3">
                                            <label for="login" class="form-label">ชื่อผู้ใช้</label>
                                            <input type="text" class="form-control" name="login" value="<?= $row['login'] ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">ชื่อ-นามสกุล</label>
                                            <input type="text" class="form-control" name="name" value="<?= $row['name'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">เพศ</label>
                                            <select name="gender" class="form-select" required>
                                                <option value="ชาย" <?= $row['gender'] == 'ชาย' ? 'selected' : '' ?>>ชาย</option>
                                                <option value="หญิง" <?= $row['gender'] == 'หญิง' ? 'selected' : '' ?>>หญิง</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">อีเมล</label>
                                            <input type="email" class="form-control" name="email" value="<?= $row['email'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">สิทธิ</label>
                                            <select name="role" class="form-select" required>
                                                <option value="m" <?= $row['role'] == 'm' ? 'selected' : '' ?>>Member</option>
                                                <option value="b" <?= $row['role'] == 'b' ? 'selected' : '' ?>>Band</option>
                                                <option value="a" <?= $row['role'] == 'a' ? 'selected' : '' ?>>Admin</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                            <button type="submit" class="btn btn-warning">บันทึกการแก้ไข</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
