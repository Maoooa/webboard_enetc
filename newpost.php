<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 style="text-align: center;">Webboard KakKak</h1>
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
    
    
</body>
</html>