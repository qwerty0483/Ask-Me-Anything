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
$db_conn = mysqli_connect('localhost', 'root', '', 'board') or die('Unable to connect. Check your connection parameters.');

$idx = $_GET['idx'];

$sql = "select * from information_list where boardIdx = '$idx';";
$rst = mysqli_query($db_conn, $sql);
$bdArr = mysqli_fetch_array($rst);
$formattedDate = date('Y-m-d H:i', strtotime($bdArr['boardDate']));

$userId = $_SESSION['userId'];

$likeSql = "SELECT boardLike FROM information_like WHERE boardIdx = '$idx' AND userId = '$userId';";
$likeResult = mysqli_query($db_conn, $likeSql);
$likeStatus = mysqli_fetch_array($likeResult);
$likeIcon = ($likeStatus && $likeStatus['boardLike'] == 1) ? "fa-solid" : "fa-regular";

$scrapSql = "SELECT boardScrap FROM information_scrap WHERE boardIdx = '$idx' AND userId = '$userId';";
$scrapResult = mysqli_query($db_conn, $scrapSql);
$scrapStatus = mysqli_fetch_array($scrapResult);
$scrapIcon = ($scrapStatus && $scrapStatus['boardScrap'] == 1) ? "fa-solid" : "fa-regular";
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
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/view.css">
    <script src="/js/jquery-3.7.1.min.js"></script>
</head>
<link rel="shortcut icon" href="#">

<body>
    <div class="header"></div>
    <div class="login"></div>

    <main class="board_container" id="information_view">
        <div id="board_main">
            <div id="title"><?php echo $bdArr['boardTitle']; ?></div>
            <div class="meta_head">
                <div id="nickname"><?php echo $bdArr['userNickname']; ?></div>
                <div id="date"><?php echo $formattedDate; ?></div>
                <div id="views">조회 <span id="viewCount"><?php echo $bdArr['boardViews']; ?></span></div>
            </div>
            <div id="content"><?php echo $bdArr['boardDetail']; ?></div>
            <div class="board_bottom">
                <div id="goodBtn" data-liked="<?php echo ($likeStatus && $likeStatus['boardLike'] == 1) ? '1' : '0'; ?>">
                    <i class="<?php echo $likeIcon; ?> fa-heart" style="color: rgb(183, 84, 79);"></i> 좋아요 <span id="likeCount"><?php echo $bdArr['boardGood']; ?></span>
                </div>
                <div id="scrapBtn" data-scrap="<?php echo ($scrapStatus && $scrapStatus['boardScrap'] == 1) ? '1' : '0'; ?>">
                    <i class="<?php echo $scrapIcon; ?> fa-star" style="color: rgb(232, 232, 20);"></i> 스크랩
                </div>
            </div>
        </div>
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

        $("#goodBtn").click(function() {
            var liked = $(this).data("liked");
            var newLiked = liked == 1 ? 0 : 1;
            var newClass = newLiked == 1 ? 'fa-solid' : 'fa-regular';

            $.ajax({
                url: 'http://localhost/php/board/information/update_like.php',
                method: 'POST',
                data: {
                    boardIdx: '<?php echo $idx; ?>',
                    userId: '<?php echo $userId; ?>',
                    boardLike: newLiked
                },
                success: function(response) {
                    if (response == "success") {
                        $("#goodBtn").data("liked", newLiked);
                        $("#goodBtn i").removeClass('fa-regular fa-solid').addClass(newClass);
                        var likeCount = parseInt($("#likeCount").text());
                        likeCount = newLiked == 1 ? likeCount + 1 : likeCount - 1;
                        $("#likeCount").text(likeCount);
                    }
                }
            });
        });
        $("#scrapBtn").click(function() {
            var scrap = $(this).data("scrap");
            var newScrap = scrap == 1 ? 0 : 1;
            var newClass = newScrap == 1 ? 'fa-solid' : 'fa-regular';

            $.ajax({
                url: 'http://localhost/php/board/information/update_scrap.php',
                method: 'POST',
                data: {
                    boardIdx: '<?php echo $idx; ?>',
                    userId: '<?php echo $userId; ?>',
                    boardScrap: newScrap
                },
                success: function(response) {
                    if (response == "success") {
                        $("#scrapBtn").data("scrap", newScrap);
                        $("#scrapBtn i").removeClass('fa-regular fa-solid').addClass(newClass);
                    }
                }
            });
        });
    </script>
</body>

</html>