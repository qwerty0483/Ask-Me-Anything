<?php
$db_conn = mysqli_connect('localhost', 'root', '', 'users') or die('Unable to connect. Check your connection parameters.');

$id = $_POST['userId'];
$nickname = $id;
$pw = $_POST['userPw'];
$email = $_POST['userEmail'];
date_default_timezone_set('Asia/Seoul');
$date = date('Y-m-d H:i:s');

$pw_hash = password_hash($pw, PASSWORD_DEFAULT);

$sql = "INSERT INTO user_info
        (user_id, user_nickname, user_password, user_email, user_date)
        VALUES('$id', '$nickname', '$pw_hash', '$email', '$date')";

$result = mysqli_query($db_conn, $sql);

if ($result) {
    header('Location:  http://localhost/index.php');
    exit();
} else {
    echo " 
	    <script>
            alert(\"회원가입이 안 되었습니다.\");
            history.back();
        </script>
	";
    exit;
}
