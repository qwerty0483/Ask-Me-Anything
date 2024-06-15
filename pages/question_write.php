<?php
session_start();
if (!isset($_SESSION['userId'])) {
    echo "
            <script>
                alert(\"로그인 해주세요.\");
                window.location.href = 'http://localhost/index.php';
            </script>
	";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>question_write</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/write.css">
    <script src="/js/jquery-3.7.1.min.js"></script>
</head>
<link rel="shortcut icon" href="#">

<body>
    <div class="header"></div>
    <div class="login"></div>

    <main class="board_container" id="question_write">
        <div id="board_header">
            <p id="page_title">질문 게시글 쓰기</p>
        </div>
        <form action="/php/board/question/write_proc.php" method="post" id="board_main">
            <div>
                <input type="submit" value="올리기" id="subBtn">
            </div>
            <div>
                <input type="text" name="boardTitle" id="title" placeholder="제목을 입력해주세요">
            </div>
            <div>
                <textarea name="boardDetail" id="content" placeholder="내용을 입력해주세요."></textarea>
            </div>
        </form>
    </main>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".header").load("/includes/header.php", function() {
                $("#loginBtn").click(function() {
                    $(".login_modal").css("display", "block");
                })
            });
            $(".login").load("/pages/login.html", function() {
                $("#closeBtn").click(function() {
                    $(".login_modal").css("display", "none");
                })
            });
        });
    </script>
</body>

</html>