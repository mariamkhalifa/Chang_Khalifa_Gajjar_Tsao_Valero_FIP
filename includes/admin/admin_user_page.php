<?php

    require_once '../../load.php';
    confirm_logged_in();
    
    $getUsers = getAllUsers();
    $message = greeting();

    if(!empty($_GET['create'])){
        $msg = $_GET['create'];
        $create = '<p class="actions">'.$msg.'</p>';
    }
    if(!empty($_GET['edit'])){
        $msg = $_GET['edit'];
        $edit = '<p class="actions">'.$msg.'</p>';
    }
    if(!empty($_GET['set'])){
        $msg = $_GET['set'];
        $set = '<p class="actions">'.$msg.'</p>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../template/head.php'; ?>
    <title>User Settings</title>
</head>
<body>
    <div class="userCMS">
        <header>
            <h1>User Settings</h1>
        <?php include '../template/header.php'; ?>
        <div id="userIndex">
            <div id="topSec">
                <h3><?php echo !empty($message)?$message: ''; ?>, <?php echo $_SESSION['user_fname']; ?>!</h3>
                <div class="topSecRow">
                    <a href="admin_edit_account.php">Edit Account</a>
                    <a href="admin_create_user.php">Create User</a>
                    <a href="admin_delete_user.php">Delete User</a>
                </div>
            </div>
            <?php echo !empty($create)?$create: ''; ?>
            <?php echo !empty($set)?$set: ''; ?>
            <?php echo !empty($edit)?$edit: ''; ?>
            <main>
                <h2>Users list:</h2>
                <div id="dashP">
                    <?php while($row = $getUsers->fetch(PDO::FETCH_ASSOC)):?>
                    <div class="users-list">
                        <h3><?php echo $row['user_fname'];?></h3>
                        <p>Username: <?php echo $row['user_name'];?></p>
                        <h4>Email:</h4>
                        <p><?php echo $row['user_email'];?></p>
                        <h4>Last Logged In Time:</h4>
                        <p><?php echo $row['user_lastlogin'];?></p>
                        <h4>Account locked?</h4>
                        <p><?php echo $row['user_locked'];?></p>
                        <h4>Account suspended?</h4>
                        <p><?php echo $row['user_sus'];?></p>
                        <h4>IP Address:</h4>
                        <p><?php echo $row['user_ip'];?></p>
                    </div>
                    <?php endwhile;?>
                </div>
            </main>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
</body>
</html>