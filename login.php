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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- iconpwd -->
    <script>
        function togglepwd(){
            const passwordInput = document.getElementById('pwd');
            const icon = document.getElementById('click');
            if(passwordInput.type == 'password'){
                passwordInput.type = 'text';
                icon.classList.remove("bi-eye-fill"); 
                icon.classList.add("bi-eye-slash-fill"); 
            }else{
                passwordInput.type = 'password';
                icon.classList.remove("bi-eye-slash-fill"); 
                icon.classList.add("bi-eye-fill"); 
            }
        }
    </script>
</head>

<body>
    <div class="container-lg">
        <h1 style="text-align: center;" class="mt-3">Webboard KakKak</h1>
        <!-- navbar -->
        <?php include "nav.php" ?>
        <!-- class crad -->
        <form action="verify.php" method="post">
            <div class="row mt-4">
                <div class="col-sm-8 col-md-6 col-lg-4 mx-auto">
                    <!-- alret -->
                    <?php 
                    if(isset($_SESSION['error'])){
                        echo "<div class='alert alert-danger '>ชื่อบัญชีหรือรหัสผ่านไม่ถูกต้อง</div>";
                        unset($_SESSION['error']);
                    }
                    ?>
                    <div class="card  ">
                        <h5 class="card-header">เข้าสู่ระบบ</h5>
                        <div class="card-body">
                            <div class="from-group mb-3">
                                <label for="login" class="from-label">Login:</label>
                                <input type="text" id="login" class="form-control" name="login">
                            </div>
                            <div class="from-group  mb-3" >
                                <label for="pwd" class="from-label ">Password:</label><br>
                                <div class="input-group">
                                    <input type="password" id="pwd" class="form-control" name="pwd">
                                    <button type="button" onclick="togglepwd()" class="input-group-text" ><i class="bi bi-eye-fill" id="click"></i></button>
                                </div>
                            </div>
                            <div class="mt-3 d-flex justify-content-center ">
                                <button type="submit" id="login" class="btn btn-primary  me-2">Login</button>
                                <button type="submit" id="reset" class="btn btn-danger">Reset</a></button>
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