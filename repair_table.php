<?php
$db = mysqli_connect('localhost', 'root', '', 'board') or die('Unable to connect. Check your connection parameters.');

$query = 'REPAIR TABLE question_list';
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'Table repaired successfully.';
