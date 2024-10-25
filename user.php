<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ใช้งาน</title>
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

        <!-- แสดงข้อความแจ้งเตือน -->
        <?php if (isset($_SESSION['success'])){
            echo " <div class='alert alert-success mt-3'> $_SESSION[success] </div> ";
                unset($_SESSION['success']);
                
        } ?>

        <table class="table table-striped mt-4" style="text-align: center;">
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
            <center>
            <?php
                $conn=new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root", "");
                $sql="SELECT id,login,name,gender,email,role From user Order by id ASC";
                $result=$conn->query($sql);
                $i=1;
                    while($row = $result->fetch()){
                        $rowData = json_encode($row);
                        echo "<tr>
                                <td >$i</td>
                                <td >$row[1]</td>
                                <td >$row[2]</td>
                                <td >$row[3]</td>
                                <td >$row[4]</td>
                                <td >$row[5]</td>
                                <td >
                                    <a class='btn btn-warning' role='button' data-bs-toggle='modal' data-bs-target='#editModal' data-value-raw='$rowData' onclick='setModalData(this)'>
                                        <i class='bi bi-pencil-fill'></i>
                                    </a>
                                </td>
                            </tr>";
                            $i++;
                   }
                    $conn=null;
            ?>
            </center>
            </tbody>
        </table>
        
    </div>
    <!-- Modal แก้ไขผู้ใช้ -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> แก้ไขข้อมูลผู้ใช้</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edituser.php" method="post">
                    <div class="modal-body">
                        <div class="mb-1">ชื่อผู้ใช้ </div>
                        <input id="username" class="form-control" type="text" name="login" disabled>

                        <div class="mb-1">ชื่อ-นามสกุล </div>
                        <input id="name" class="form-control" type="text" name="name">

                        <div class="mb-1">เพศ </div>
                        <select id="gender" name="gender" class="form-select">
                            <option value="m">ชาย</option>
                            <option value="f">หญิง</option>
                            <option value="o">อื่นๆ</option>
                        </select>

                        <div class="mb-1">อีเมล </div>
                        <input id="mail" class="form-control" type="text" name="email">

                        <div class="mb-1">สิทธิ์</div>
                        <select id="role" name="role" class="form-select">
                            <option value="m">Member</option>
                            <option value="a">Admin</option>
                            <option value="b">Ban</option>
                        </select>
                        <input id="ID" class="form-control" type="hidden" name="ID">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <script>
            function setModalData(button){
                const rowData = JSON.parse(button.getAttribute('data-value-raw'));

                document.getElementById('ID').value = rowData[0];
                document.getElementById('username').value = rowData[1];
                document.getElementById('name').value = rowData[2];
                document.getElementById('gender').value = rowData[3];
                document.getElementById('mail').value = rowData[4];
                document.getElementById('role').value = rowData[5];
            }
        </script>
    </div>
       
</body>
</html>
