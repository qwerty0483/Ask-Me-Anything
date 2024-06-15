<?php
$db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');

$query = 'CREATE DATABASE IF NOT EXISTS users';
mysqli_query($db, $query) or die(mysqli_error($db));

mysqli_select_db($db, 'users') or die(mysqli_error($db));

$query = 'CREATE TABLE user_info(
    user_id         VARCHAR(50)     NOT NULL UNIQUE,     #사용자 ID
    user_nickname   VARCHAR(50)     NOT NULL UNIQUE,
    user_password   VARCHAR(255)    NOT NULL,       #사용자 비밀번호
    user_email      VARCHAR(100)    NOT NULL,       #사용자 이메일
    user_date       TIMESTAMP DEFAULT CURRENT_TIMESTAMP     #사용자 회원가입일
)
ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'Users database successfully created!';
