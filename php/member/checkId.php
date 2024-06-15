<?php
$db_conn = mysqli_connect('localhost', 'root', '', 'users') or die('Unable to connect. Check your connection parameters.');

$id = $_GET['userId'];

$sql = "SELECT user_id FROM user_info";
$result = $db_conn->query($sql);

if ($result->num_rows >= 0) {
    while ($row = $result->fetch_assoc()) {
        if ($id == $row['user_id']) {
            echo $row['user_id'];
            echo "O";
            return;
        }
    }
    echo "X";
}
