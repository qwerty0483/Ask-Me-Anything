<?php
session_start();
$db_conn = mysqli_connect('localhost', 'root', '', 'users') or die('Unable to connect. Check your connection parameters.');

$id = $_SESSION['userId'];
$sql = "select * from user_info where user_id = '$id';";
$rst = mysqli_query($db_conn, $sql);
$arr = mysqli_fetch_array($rst);

$scrapDB = mysqli_connect('localhost', 'root', '', 'board') or die('Unable to connect. Check your connection parameters.');
$scrapQSql = "SELECT * FROM question_scrap WHERE userId = '$id' AND boardScrap = 1;";
$scrapQResult = mysqli_query($scrapDB, $scrapQSql);
$scrapISql = "SELECT * FROM information_scrap WHERE userId = '$id' AND boardScrap = 1;";
$scrapIResult = mysqli_query($scrapDB, $scrapISql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>question_view</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/profile_edit.css">
    <script src="/js/jquery-3.7.1.min.js"></script>
</head>
<link rel="shortcut icon" href="#">

<body>
    <div class="header"></div>

    <main class="profile">
        <div class="profile_container">
            <div id="img"><i class="fa-solid fa-graduation-cap"></i></div>
            <div class="meta">
                <div id="id"><span>아이디</span><?php echo $arr['user_id']; ?></div>
                <div id="nickname"><span>닉네임</span><?php echo $arr['user_nickname']; ?></div>
                <div id="email"><span>이메일</span><?php echo $arr['user_email']; ?></div>
            </div>
            <div id="editBtn">프로필 편집</div>
        </div>
        <div class="scrap_container">
            <div id="scrapTop">스크랩</div>
            <div class="question_scrap">
                <div id="top">질문</div>
                <?php
                while ($scrapRow = mysqli_fetch_assoc($scrapQResult)) {
                    $boardIdx = $scrapRow['boardIdx'];

                    $postSql = "SELECT * FROM question_scrap WHERE boardIdx = $boardIdx;";
                    $postRst = mysqli_query($scrapDB, $postSql);
                    $post = mysqli_fetch_assoc($postRst);

                    $titleSql = "SELECT * FROM question_list WHERE boardIdx = $boardIdx;";
                    $titleRst = mysqli_query($scrapDB, $titleSql);
                    $title = mysqli_fetch_assoc($titleRst);


                    echo "<div>";
                    echo "<a href='/pages/question_view.php?idx={$post['boardIdx']}'>{$title['boardTitle']}</a>";
                    echo "</div>";
                }
                ?>
            </div>
            <div class="information_scrap">
                <div id="top">정보</div>
                <?php
                while ($scrapRow = mysqli_fetch_assoc($scrapIResult)) {
                    $boardIdx = $scrapRow['boardIdx'];

                    $postSql = "SELECT * FROM information_scrap WHERE boardIdx = $boardIdx;";
                    $postRst = mysqli_query($scrapDB, $postSql);
                    $post = mysqli_fetch_assoc($postRst);

                    $titleSql = "SELECT * FROM information_list WHERE boardIdx = $boardIdx;";
                    $titleRst = mysqli_query($scrapDB, $titleSql);
                    $title = mysqli_fetch_assoc($titleRst);

                    echo "<div>";
                    echo "<a href='/pages/information_view.php?idx={$post['boardIdx']}'>{$title['boardTitle']}</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>

        <div class="profileEdit_modal" style="display: none;">
            <div class="edit_container">
                <div id="head">프로필 편집</div>
                <div id="closeBtn">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <form action="/php/member/profile_edit.php" method="POST" class="form">
                    <div>닉네임</div>
                    <input type="text" name="userNickname" id="user_nickname">
                    <label for="userEmail">이메일</label>
                    <input type="text" name="userEmail" id="user_email">
                    <input type="submit" value="수정" id="edit_btn">
                </form>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".header").load("/includes/header.php");
            $("#editBtn").click(function() {
                $(".profileEdit_modal").css("display", "block");
            });
            $("#closeBtn").click(function() {
                $(".profileEdit_modal").css("display", "none");
            });
        });
    </script>
</body>

</html>