<?php
$db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');

$query = 'CREATE DATABASE IF NOT EXISTS board';
mysqli_query($db, $query) or die(mysqli_error($db));

mysqli_select_db($db, 'board') or die(mysqli_error($db));

$query = 'CREATE TABLE question_list(
    boardIdx    	int primary key auto_increment,	# 게시판 번호
	userId      	varchar(50) not null,		# 작성자 ID
	userNickname 	varchar(50) not null,		# 작성자 닉네임
	boardTitle  	varchar(200) not null,	# 게시판 제목
	boardDetail 	text not null,		#게시판 내용
	boardDate   	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  # 게시판 작성일
	boardViews  	int not null default 0,	# 게시판 조회수
	boardGood   	int not null default 0	# 게시판 추천/좋아요
)
ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'CREATE TABLE information_list(
    boardIdx    	int primary key auto_increment,	# 게시판 번호
	userId      	varchar(50) not null,		# 작성자 ID
	userNickname 	varchar(50) not null,		# 작성자 닉네임
	boardTitle  	varchar(200) not null,	# 게시판 제목
	boardDetail 	text not null,		#게시판 내용
	boardDate   	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  # 게시판 작성일
	boardViews  	int not null default 0,	# 게시판 조회수
	boardGood   	int not null default 0	# 게시판 추천/좋아요
)
ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'Users database successfully created!';
