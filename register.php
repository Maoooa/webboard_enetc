<?php
session_start();
if (isset($_SESSION['id'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>register</title>
</head>

<body>
    <div class="container-lg">
        <h1 style="text-align: center;" class="mt-3">Register</h1>
        <!-- navbar -->
        <?php include "nav.php" ?>
        <!-- class crad -->
        <form action="register_save.php" method="post">
            <div class="row mt-4">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto">
                    <!-- alert -->
                    <?php
                    if(isset($_SESSION['add_login'])){
                        if($_SESSION['add_login']=='error'){
                            echo "<div class='alert alert-danger'>ชื่อบัญชีซ้ำหรือฐานข้อมูลมีปัญหา</div>";
                        }else{
                            echo "<div class='alert alert-success'>เพิ่มบัญชีเรียบร้อย</div>";
                        }
                        unset($_SESSION['add_login']);
                    }
                    ?>
                    <div class="card  border-primary">
                        <h5 class="card-header bg-primary text-white ">เข้าสู่ระบบ</h5>
                        <div class="card-body">
                            <!-- login -->
                            <div class="row mb-3">
                                <div class="col-lg-3 mx-auto my-auto ">
                                    <label for="login" class="from-label">ชื่อบัญชี:</label>
                                </div>
                                <div class="col-lg-9 mx-auto my-auto ">
                                    <input type="text" id="login" class="form-control" name="login" require>
                                </div>
                            </div>

                            <!-- pwd -->
                            <div class="row mb-3">
                                <div class="col-lg-3 mx-auto my-auto ">
                                    <label for="pwd" class="from-label">รหัสผ่าน:</label>
                                </div>
                                <div class="col-lg-9 mx-auto my-auto ">
                                    <input type="password" id="pwd" class="form-control" name="pwd" require>
                                </div>
                            </div>

                            <!-- name -->
                            <div class="row mb-3">
                                <div class="col-lg-3 mx-auto my-auto ">
                                    <label for="name" class="from-label">ชื่อ-นามสกุล:</label>
                                </div>
                                <div class="col-lg-9 mx-auto my-auto ">
                                    <input type="text" id="name" class="form-control" name="name" require>
                                </div>
                            </div>

                            <!-- gender -->
                            <div class="row mb-3">
                                <div class="col-lg-3 mx-auto my-auto ">
                                    <label for="gender" class="from-label">เพศ:</label>
                                </div>
                                <div class="col-lg-9 mx-auto my-auto ">
                                    <input type="radio" class="form-check-input" name="gender" value="m" require> ชาย <br>
                                    <input type="radio" class="form-check-input" name="gender" value="f" require> หญิง <br>
                                    <input type="radio" class="form-check-input" name="gender" value="o" require> อื่น ๆ <br>
                                </div>
                            </div>

                            <!-- email -->
                            <div class="row mb-3">
                                <div class="col-lg-3 mx-auto my-auto ">
                                    <label for="email" class="from-label">email:</label>
                                </div>
                                <div class="col-lg-9 mx-auto my-auto ">
                                    <input type="email" id="email" class="form-control" name="email" require>
                                </div>
                            </div>

                            <!-- button -->
                            <div class=" row mb-3">
                                <div class="col-lg-3 mx-auto my-auto "></div>
                                <div class="col-lg-9 mx-auto my-auto ">
                                    <button type="submit" id="login" class="btn btn-primary  me-2" require><i class="bi bi-save"></i> สมัครสมาชิก</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- register -->
        <div style="text-align: center;" class="mt-3">
            ถ้ายังไม่ได้เป็นสมาชิก <a href="register.php">กรุณาสมัครสมาชิก</a>
        </div>

    </div>

</body>

</html>