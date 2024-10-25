<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function myfunction() {
            return confirm("ต้องการที่จะลบกระทู้นี้จริงหรือไม่");
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-lg">
        <h1 style="text-align: center;" class="mt-3">Webboard KakKak</h1>
        
        <?php include "nav.php"; ?>
        
        <label class="mt-3">หมวดหมู่ :</label>
        <span class="dropdown">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                --ทั้งหมด--
            </a>
            <ul class="dropdown-menu" aria-labelledby="button2">
                <li><a class="dropdown-item" href="index.php">ทั้งหมด</a></li>
                <?php
                $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");
                $sql = "SELECT * FROM category";
                foreach ($conn->query($sql) as $row) {
                    echo "<li><a class='dropdown-item' href='index.php?cat_id=$row[id]'>$row[name]</a></li>";
                }
                $conn = null;
                ?>
            </ul>
            <?php
            // ตรวจสอบว่าผู้ใช้งานถูกแบนหรือไม่
            if (isset($_SESSION['id']) && $_SESSION['role'] !== 'b') {
                echo "<a href='newpost.php' class='btn btn-success float-end mt-3'>
                    <i class='bi bi-plus-lg'></i>สร้างกระทู้ใหม่ </a>";
            }
            ?>
        </span>

        <form action="post.php" method="get">
            <table class="table table-striped mt-4">
                <?php
                $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

                $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
                $sql = "SELECT t3.name, t1.title, t1.id, t2.login, t1.post_date, t1.user_id FROM post AS t1
                        INNER JOIN user AS t2 ON (t1.user_id = t2.id)
                        INNER JOIN category AS t3 ON (t1.cat_id = t3.id)
                        WHERE t2.role != 'b'"; // ตรวจสอบว่าผู้ใช้ไม่ได้ถูกแบน
                
                if ($cat_id) {
                    $sql .= " AND t1.cat_id = :cat_id"; // ใช้ AND แทนการใช้ WHERE ที่สอง
                }
                $sql .= " ORDER BY t1.post_date DESC";

                $stmt = $conn->prepare($sql);
                if ($cat_id) {
                    $stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
                }
                $stmt->execute();
                
                $count = $stmt->rowCount(); // นับจำนวนโพสต์ที่ได้

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>[ $row[name] ] <a href='post.php?id=$row[id]' style='text-decoration:none'>$row[title]</a>";
                    
                    // ปุ่มลบสำหรับ admin หรือเจ้าของโพสต์
                    if (isset($_SESSION['id']) && ($_SESSION['role'] == 'a' || $_SESSION['user_id'] == $row['user_id'])) {
                        echo " <a onclick='return myfunction()' class='btn btn-danger' style='float:right; margin-left: 5px;' role='button' href='delete.php?id=$row[id]'>
                            <i class='bi bi-trash'></i></a>";
                    }
                    // ปุ่มแก้ไขสำหรับผู้ใช้ที่เป็นเจ้าของโพสต์
                    if (isset($_SESSION['id']) && $_SESSION['user_id'] == $row['user_id']) {
                        echo " <a href='editpost.php?id=$row[id]' class='btn btn-warning' style='float:right' role='button'>
                            <i class='bi bi-pencil'></i></a>";
                    }
                
                    echo "<br>$row[login] - $row[post_date]</td></tr>";
                }
                
                $conn = null;
                ?>
            </table>
        </form>
    </div>
</body>

</html>