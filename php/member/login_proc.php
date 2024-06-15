<?php
session_start();
$db_conn = mysqli_connect('localhost', 'root', '', 'users') or die('Unable to connect. Check your connection parameters.');

$id = $_POST['userId'];
$pw = $_POST['userPw'];

$sql =  "select * from user_info where user_id='$id';";
$result = mysqli_query($db_conn, $sql);
$row = mysqli_fetch_array($result);

$pw_hash = $row['user_password'];

if (!$row) {
    echo "<script> 
        alert(\"아이디 또는 비밀번호가 잘못되었습니다.\");
        history.back();
        </script>";
    exit;
} else {
    if (!password_verify($pw, $pw_hash)) {
        echo "<script> 
        alert(\"아이디 또는 비밀번호가 잘못되었습니다.\");
        history.back();
        </script>";
        exit;
    } else {
        $_SESSION['loggedin'] = true;
        $_SESSION['userId'] = $row['user_id'];
        $_SESSION['userNickname'] = $row['user_nickname'];
        $_SESSION['userEmail'] = $row['user_email'];
        $_SESSION['userDate'] = $row['user_date'];

        mysqli_close($db_conn);
        header('Location:  http://localhost/index.php');
        exit();
    }
}
