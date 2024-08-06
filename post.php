<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $id = $_GET["id"];
    ?>
    <h1 style="text-align: center;"> Webboard KakKak</h1>
    <hr>
    <p style="text-align: center;">
    ต้องการดูกระทู้หมายเลข
        <?php  
        echo $id ."<BR>";
            if(($id % 2) == 0)
                echo "เป็นกระทู้หมายเลขคู่";
            else
                echo "เป็นกระทู้หมายเลขคี่";
            
        ?> 
    </p>
    
    <div style="text-align: center;">
        <table style="border: 2px soild black;"; width: 40; align="center">
            <tr><td style="background-color: #6CD2FE;">แสดงความคิดเห็น</td></tr>
            <tr><td><textarea></textarea></td></tr>
            <tr><td><input type="submit" value="ส่งข้อความ"></td></tr>
        </table>
        <p><a href="index.php">กลับไปหน้าหลัก</a></p>
    </div>

    
</body>
</html>