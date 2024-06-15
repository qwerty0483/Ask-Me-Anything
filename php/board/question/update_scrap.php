<?php
session_start();
if (isset($_POST['boardIdx'], $_POST['userId'], $_POST['boardScrap'])) {
    $db_conn = mysqli_connect('localhost', 'root', '', 'board') or die('Unable to connect. Check your connection parameters.');

    $boardIdx = $_POST['boardIdx'];
    $userId = $_POST['userId'];
    $boardScrap = $_POST['boardScrap'];

    $scrapSql = "SELECT * FROM question_scrap WHERE boardIdx = '$boardIdx' AND userId = '$userId';";
    $scrapResult = mysqli_query($db_conn, $scrapSql);

    if (mysqli_num_rows($scrapResult) > 0) {
        $updateSql = "UPDATE question_scrap SET boardscrap = '$boardScrap' WHERE boardIdx = '$boardIdx' AND userId = '$userId';";
        mysqli_query($db_conn, $updateSql);
    } else {
        $insertSql = "INSERT INTO question_scrap (boardIdx, userId, boardScrap) VALUES ('$boardIdx', '$userId', '$boardScrap');";
        mysqli_query($db_conn, $insertSql);
    }

    $countChange = $boardScrap == 1 ? 1 : 0;
    $updateCountSql = "UPDATE question_scrap SET boardScrap = $countChange WHERE boardIdx = '$boardIdx';";
    mysqli_query($db_conn, $updateCountSql);

    echo "success";
} else {
    echo "error";
}
