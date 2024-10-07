<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newpost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <!-- <h1 style="text-align: center;">Webboard KakKak</h1>
    <hr>
    <br> 
    <table>
        <tr>
            <td>
                ผู้ใช้ :
            </td>
            <td >
                <?php 
                echo "$_SESSION[username]";
                ?>
            </td>
        </tr>
        <tr>
            <td>
                หมวดหมู่ :
            </td>
            <td >
                <select name="category">
                    <option value="all">--ทั้งหมด--</option>
                    <option value="general">เรื่องทั่วไป</option>
                    <option value="study">เรื่องเรียน</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                หัวข้อ :
            </td>
            <td>
                <input type="text">
            </td>
        </tr>
            <td>
                เนื้อหา :  
            </td>
            <td>
                <textarea></textarea>
            </td>
        </tr>
        <tr>
            <td ></td> 
            <td >
                <input type="submit" value="บันทึกข้อความ">
            </td>
        </tr>
    </table>
     -->
     <div class="container-lg">
        <h1 style="text-align: center;" class="mt-3">Webboard KakKak</h1>
        <!-- navbar -->
        <?php include "nav.php" ?>
        <div class="card text-dark bg-white border-info col-lg-8 mx-auto mt-5">
            <div class="card-header bg-info text-white"> ตั้งกระทู้ใหม่ </div>
            <div class="card-body">
                <form action="newpost_save.php" method="post">
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">หมวดหมู่ :</label>
                        <div class="col-lg-9">
                            <select name="category" class="form-select">
                                <option value="general">เรื่องทั่วไป</option>
                                <option value="study">เรื่องเรียน</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">หัวข้อ :</label>
                        <div class="col-lg-9">
                            <input type="text" name="topic" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label">เนื้อหา :</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="comment" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <button type="submit" class="btn btn-info btn-sm text-white">
                                    <i class="bi bi-caret-right-square me-1"></i> บันทึกข้อความ
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