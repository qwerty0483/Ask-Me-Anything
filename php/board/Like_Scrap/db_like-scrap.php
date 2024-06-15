<?php
$db_conn = mysqli_connect('localhost', 'root', '', 'board') or die('Unable to connect. Check your connection parameters.');

$query = 'CREATE TABLE question_like(
    boardIdx    	int,	# 게시판 번호
	userId      	varchar(50) not null,		# 사용자 ID
	boardLike   	int not null default 0	# 게시판 좋아요
)
ENGINE=MyISAM';
mysqli_query($db_conn, $query) or die(mysqli_error($db_conn));

$query = 'CREATE TABLE question_scrap(
    boardIdx    	int,	# 게시판 번호
	userId      	varchar(50) not null,		# 사용자 ID
	boardScrap   	int not null default 0	# 게시판 스크랩
)
ENGINE=MyISAM';
mysqli_query($db_conn, $query) or die(mysqli_error($db_conn));

$query = 'CREATE TABLE information_like(
    boardIdx    	int,	# 게시판 번호
	userId      	varchar(50) not null,		# 사용자 ID
	boardLike   	int not null default 0	# 게시판 좋아요
)
ENGINE=MyISAM';
mysqli_query($db_conn, $query) or die(mysqli_error($db_conn));

$query = 'CREATE TABLE information_scrap(
    boardIdx    	int,	# 게시판 번호
	userId      	varchar(50) not null,		# 사용자 ID
	boardScrap   	int not null default 0	# 게시판 스크랩
)
ENGINE=MyISAM';
mysqli_query($db_conn, $query) or die(mysqli_error($db_conn));

echo 'Users database successfully created!';
