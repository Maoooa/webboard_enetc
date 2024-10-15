<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- card -->
    <div class="container-lg">

        <?php
        $id = $_GET["id"];
        ?>
        <h1 style="text-align: center;" class="mt-3"> Webboard KakKak</h1>
        <!-- navbar -->
        <?php
        session_start();
        include "nav.php" ?>
        <!-- post -->
        <div class="card text-dark bg-white border-primary mt-5 col-sm-11 col-md-10 col-lg-8  mx-auto">
            <?php
            $post_id = $_GET['id'];
            $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");
            $sql = "SELECT title,content,post_date FROM post WHERE $post_id = id ";

            $result = $conn->query($sql);
            $row = $result->fetch();
            ?>
            <!-- title -->
            
            <div class="card-header bg-primary text-white "><?php echo "$row[0]"; ?></div>
            <div class="card-body ">
                <div class="mt-2"> <?php echo "$row[1] <BR> " ?> </div>
                <div class="mt-2"> <?php echo "$row[2] "?> </div>
            </div>
        </div>
        <!-- แสดงผลความคิดเห็น -->
        <?php
        $id = 0;
        $sql_com = "SELECT comment.id,comment.content,comment.post_date,user.login FROM comment  
                INNER JOIN user ON (comment.user_id = user.id) WHERE $post_id = comment.post_id ORDER BY comment.post_date ;";
        $result = $conn->query($sql_com);

        while ($row = $result->fetch()) {
            $id = $id + 1;
            echo "  <div class='card text-dark bg-white border-info mt-3 col-sm-11 col-md-10 col-lg-8  mx-auto'>
                        <div class='card-header bg-info text-white  '> ความคิดเห็นที่ $id </div>
                        <div class='card-body'> 
                            <div > $row[1] </div>
                            <div class='mt-2'> $row[3] : $row[2]</div>
                        </div>
                    </div>";
        }
        ?>

        <!-- textarea -->
        <div class="card text-dark bg-white border-success mt-5 col-sm-11 col-md-10 col-lg-8   mx-auto">
            <div class="card-header bg-success text-white ">แสดงความคิดเห็น</div>
            <div class="card-body">
                <form action="post_save.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $_GET['id']; ?>">
                    <div class="row mb-3 justify-content-center ">
                        <div class="col-lg-10">
                            <textarea name="comment" class="form-control" rows="8"></textarea>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <button type="submit" class="btn btn-success btn-sm text-white">
                                    <i class="bi bi-box-arrow-up-right me-10"></i><i>ส่งข้อความ</i>
                                </button>
                            </center>

                        </div>

                    </div>

                </form>

            </div>

        </div>

</body>

</html>