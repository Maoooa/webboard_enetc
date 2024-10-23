<?php
session_start();

// ตรวจสอบว่ามีการส่ง ID ของโพสต์หรือไม่
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$post_id = $_GET['id'];

// เชื่อมต่อฐานข้อมูล
$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

// ดึงข้อมูลกระทู้ตาม ID
$sql = "SELECT * FROM post WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// ตรวจสอบว่าพบโพสต์หรือไม่
if (!$post) {
    header("Location: index.php");
    exit();
}

// ตรวจสอบว่าเจ้าของโพสต์คือผู้ใช้ที่ล็อกอินอยู่หรือไม่
if ($post['user_id'] != $_SESSION['user_id']) {
    header("Location: index.php");
    exit();
}

// ดึงข้อมูลหมวดหมู่เพื่อแสดงใน Dropdown
$sql = "SELECT * FROM category";
$categories = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขกระทู้</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
    <div class="container-lg">
        <h1 style="text-align: center;" class="mt-3">Webboard KakKak</h1>
        <!-- navbar -->
        <?php include "nav.php" ?>

        <div class=" text-dark bg-white col-lg-8 mx-auto mt-5">
            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($_GET['message']); // แสดงข้อความที่ส่งกลับ ?>
                </div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET['error']); // แสดงข้อความข้อผิดพลาด ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="card text-dark bg-white border-warning col-lg-8 mx-auto mt-2">
            <div class="card-header bg-warning text-white"> แก้ไขกระทู้ </div>
            <div class="card-body">
                <form action="editpost_save.php" method="post">
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">หมวดหมู่ :</label>
                        <div class="col-lg-9">
                            <select name="category" class="form-select">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $post['cat_id'] ? 'selected' : '' ?>>
                                        <?= $category['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">หัวข้อ :</label>
                        <div class="col-lg-9">
                            <input type="text" name="topic" class="form-control" value="<?= htmlspecialchars($post['title']) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">เนื้อหา :</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="comment" rows="8" required><?= htmlspecialchars($post['content']) ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <button type="submit" class="btn btn-warning btn-sm text-white">
                                    <i class="bi bi-caret-right-square me-1"></i> บันทึกการแก้ไข
                                </button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
