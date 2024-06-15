<?php
session_start();
$db_conn = mysqli_connect('localhost', 'root', '', 'users') or die('Unable to connect. Check your connection parameters.');

function validate_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

$id = $_SESSION['userId'];

$nickname = mysqli_real_escape_string($db_conn, $_POST['userNickname']);
$email =  mysqli_real_escape_string($db_conn, $_POST['userEmail']);

// Validate email if provided
if ($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "
            <script>
                alert(\"유효한 이메일 주소를 입력해주세요.\");
            </script>
        ";
        exit;
    } else {
        $sql = "UPDATE user_info SET user_email = '$email' WHERE user_id = '$id'";
        $result = mysqli_query($db_conn, $sql);
    }
}

// Check if nickname is already in use
if ($nickname) {
    $sql = "SELECT user_nickname FROM user_info";
    $result = $db_conn->query($sql);
    $flag = 0;

    if ($result->num_rows >= 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row['user_nickname'];
            if ($nickname == $row['user_nickname']) {
                $flag = 1;
                echo "
                <script>
                    alert(\"이미 사용 중인 닉네임입니다. 다른 닉네임을 입력해주세요.\");
                    history.back();
                </script>";
                exit;
            }
        }
    }

    if ($flag == 0) {
        $Nsql = "UPDATE user_info SET user_nickname = '$nickname' WHERE user_id = '$id'";
        $Nresult = mysqli_query($db_conn, $Nsql);
    }
}

$db_conn->close();

echo "<script>history.back();</script>";
