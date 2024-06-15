<?php
session_start();
if (isset($_POST['boardIdx'], $_POST['userId'], $_POST['boardLike'])) {
    $db_conn = mysqli_connect('localhost', 'root', '', 'board') or die('Unable to connect. Check your connection parameters.');

    $boardIdx = $_POST['boardIdx'];
    $userId = $_POST['userId'];
    $boardLike = $_POST['boardLike'];

    $likeSql = "SELECT * FROM question_like WHERE boardIdx = '$boardIdx' AND userId = '$userId';";
    $likeResult = mysqli_query($db_conn, $likeSql);

    if (mysqli_num_rows($likeResult) > 0) {
        $updateSql = "UPDATE question_like SET boardLike = '$boardLike' WHERE boardIdx = '$boardIdx' AND userId = '$userId';";
        mysqli_query($db_conn, $updateSql);
    } else {
        $insertSql = "INSERT INTO question_like (boardIdx, userId, boardLike) VALUES ('$boardIdx', '$userId', '$boardLike');";
        mysqli_query($db_conn, $insertSql);
    }

    $countChange = $boardLike == 1 ? 1 : -1;
    $updateCountSql = "UPDATE question_list SET boardGood = boardGood + $countChange WHERE boardIdx = '$boardIdx';";
    mysqli_query($db_conn, $updateCountSql);

    echo "success";
} else {
    echo "error";
}
