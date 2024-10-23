<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หมวดหมู่</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script>
        function myfunction() {
            return confirm("คุณแน่ใจหรือไม่ว่าต้องการลบหมวดหมู่นี้?");
        }
    </script>
    
</head>

<body>
    <div class="container-lg">
        <h1 style="text-align: center;" class="mt-3">Webboard KakKak</h1>
        <!-- navbar -->
        <?php include "nav.php"; ?>

        <div class=" text-dark bg-white col-lg-8 mx-auto mt-5">
            <?php 
                if (isset($_SESSION['success'])){
                    echo "<div class='alert alert-success mt-3'> $_SESSION[success] </div>";
                    unset($_SESSION['success']); 
                }
            else if (isset($_SESSION['error'])){
                    echo "<div class='alert alert-danger mt-3'>$_SESSION[error] </div>";
                    unset($_SESSION['error']);
                 }
            ?>

        <table class="table table-striped mt-4" style="text-align: center;">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อหมวดหมู่</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // เชื่อมต่อฐานข้อมูล
                $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");
                $sql = "SELECT * FROM category";
                $stmt = $conn->query($sql);
                $index = 1;

                while ($row = $stmt->fetch()) {
                    echo "<tr>
                            <td>$index</td>
                            <td>{$row['name']}</td>
                            <td>
                                <a href='edit_category.php?id={$row['id']}' class='btn btn-warning btn-sm'>
                                    <i class='bi bi-pencil'></i> แก้ไข
                                </a>
                                <a href='deletecategory.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return myfunction()'>
                                    <i class='bi bi-trash'></i> ลบ
                                </a>
                            </td>
                          </tr>";
                    $index++;
                }

                // ปิดการเชื่อมต่อ
                $conn = null;
                ?>
            </tbody>
            </div>
        </table>
        <div class="mt-5">
            <center>
                <!-- ปุ่มเพิ่มหมวดหมู่ -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'a'): ?>
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="bi bi-plus-lg"></i> เพิ่มหมวดหมู่ใหม่
                    </button>
                <?php endif; ?>
            </center>
        </div>
        <!-- Modal ยืนยันการลบ -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">ยืนยันการลบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    คุณแน่ใจหรือไม่ว่าต้องการลบหมวดหมู่นี้?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <a id="confirmDelete" class="btn btn-danger">ลบ</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal เพิ่มหมวดหมู่ -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">เพิ่มหมวดหมู่ใหม่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="category_save.php" method="post">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">ชื่อหมวดหมู่:</label>
                            <input type="text" class="form-control" name="categoryName" id="categoryName" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-success">เพิ่ม</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // ปุ่มที่เปิด Modal
    const categoryId = button.getAttribute('data-id'); // ดึง ID หมวดหมู่

    // กำหนด URL สำหรับลบหมวดหมู่
    const deleteUrl = 'deletecategory.php?id=' + categoryId;
    const confirmDeleteButton = document.getElementById('confirmDelete');
    confirmDeleteButton.setAttribute('href', deleteUrl);
});

</script>
</body>

</html>
