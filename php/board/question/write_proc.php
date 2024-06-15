<?php
session_start();
$db_conn = mysqli_connect('localhost', 'root', '', 'board') or die('Unable to connect. Check your connection parameters.');

$id = $_SESSION['userId'];
$nickname = $_SESSION['userNickname'];
$title = mysqli_real_escape_string($db_conn, $_POST['boardTitle']);
$detail = mysqli_real_escape_string($db_conn, $_POST['boardDetail']);
date_default_timezone_set('Asia/Seoul');
$date = date("Y-m-d H:i:s");

$sql = "INSERT INTO question_list
        (userId, userNickname, boardTitle, boardDetail, boardDate)
        VALUES('$id', '$nickname', '$title', '$detail', '$date');";
$result = mysqli_query($db_conn, $sql);

if ($result) {
    header('Location:  http://localhost/pages/question_list.php');
    exit();
} else {
    echo " 
	    <script>
            alert(\"게시글이 올라가지 못했습니다.\");
            history.back();
        </script>
	";
    exit;
}
