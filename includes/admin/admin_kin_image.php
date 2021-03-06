<?php
    require_once '../../load.php';
    confirm_logged_in();

    if(isset($_GET['img_id']) && isset($_GET['tbl']) && isset($_GET['page'])){
        $id = trim($_GET['img_id']);
        $tbl = trim($_GET['tbl']);
        $page = trim($_GET['page']);
        $getSingleImg = getImg($id, $tbl);
    } else {
        $message = 'Cannot get the image info.';
    }

    if(isset($_POST['submit-img'])) {
        $id = trim($_POST['id']);
        $img = $_FILES['img'];
        $tbl = trim($_POST['tbl']);
        $page = trim($_POST['page']);
        
        if ($_FILES['img']['size'] == 0 && $_FILES['img']['error'] > 0) {
            $message = 'image required';
        } else {
            $message = updateImg($id, $img, $tbl, $page);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../template/head.php'; ?>
    <title>Edit Image</title>
</head>
<body>
    <div class="userCMS">
        <header>
            <h1>Edit This Image</h1>
        <?php include '../template/header.php'; ?>
        <?php echo !empty($message)?$message: ''; ?>
        <p class="imgbk"><a href="<?php echo $page;?>"><-Go Back</a></p>
        <form action="admin_kin_image.php" method="post" class="imgUpForm" enctype="multipart/form-data">
            <?php while($row = $getSingleImg->fetch(PDO::FETCH_ASSOC)):?>
            <div class="imgTop">
                <h2>Current Image:</h2>
                <img src="../../images/<?php echo $row['img'];?>" alt="image <?php echo $row['img'];?>">
            </div>
            <label for="img">Upload new image: </label>
            <input class="hidden" type="number" name="id" value="<?php echo $row['id'];?>">
            <input class="hidden" type="text" name="tbl" value="<?php echo $tbl;?>">
            <input class="hidden" type="text" name="page" value="<?php echo $page;?>">
            <?php endwhile;?>
            <input type="file" name="img" value="">
            <input type="submit" name="submit-img" value="Upload Image">
        </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
</body>
</html>