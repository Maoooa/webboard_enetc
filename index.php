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
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-lg">
        <h1 style="text-align: center;" class="mt-3">Webboard KakKak</h1>
        <!--navbar -->
        <?php include"nav.php" ?>
        <!-- หมวดหมู่ -->
        <label class="mt-3">หมวดหมู่ :</label>
        <span class="dropdown">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                --ทั้งหมด--
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">ทั้งหมด</a></li>
                <li><a class="dropdown-item" href="#">เรื่องทั่วไป</a></li>
                <li><a class="dropdown-item" href="#">เรื่องเรียน</a></li>
            </ul>
            <?php 
                if(isset($_SESSION['id'])){
                    echo  "<a href='newpost.php' class='btn btn-success float-end mt-3'>
                    <i class='bi bi-plus-lg'></i>สร้างกระทู้ใหม่ </a>";
                }
            ?>
        </span>
        
        <form action="post.php" method="get">
            <table class="table table-striped mt-4">
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo "<tr><td><a href=post.php?id=$i style='text-decoration:none'>กระทู้ที่ $i</a>";
                    if (isset($_SESSION['id']) && ($_SESSION['role']) == 'a') {
                        echo "&nbsp;&nbsp;
                        <span class='btn btn-danger float-end'><a href=delete.php?id=$i class='link-light'><i class='bi bi-trash'></i></a></span>";
                    }
                }
                echo "</td></tr>";
                ?>

            </table>
        </form>
        </table>

    </div>



</body>

</html>