<?php
$db_conn = mysqli_connect('localhost', 'root', '', 'board') or die('Unable to connect. Check your connection parameters.');

$page = isset($_GET["page"]) ? $_GET["page"] : 1; // page 변수 값이 있을 경우 page 개수 가져오고 아니면 1 가져옴
$cntSql =  "select * from question_list";
$cntRe = mysqli_query($db_conn, $cntSql);
$row = mysqli_num_rows($cntRe);

$pagePer = 5; // 페이지당 게시물 제한 개수
$pageIdx = ($page - 1) * $pagePer + 1;
$pageIdx -= 1;

$user_db_conn = mysqli_connect('localhost', 'root', '', 'users') or die('Unable to connect to user database.');

$sql = "SELECT il.*, u.user_nickname AS userNickname 
        FROM question_list il 
        JOIN users.user_info u ON il.userId = u.user_id 
        ORDER BY il.boardDate DESC 
        LIMIT $pageIdx, $pagePer;";
$result = mysqli_query($db_conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>question_list</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/list.css">
    <script src="/js/jquery-3.7.1.min.js"></script>
</head>
<link rel="shortcut icon" href="#">

<body>
    <div class="header"></div>
    <div class="login"></div>

    <main class="board_container" id="question_list">
        <div id="board_header">
            <p id="page_title">질문 게시판</p>
        </div>
        <div id="board_main">
            <?php
            while ($arr = mysqli_fetch_array($result)) {
                date_default_timezone_set('Asia/Seoul');
                $currentDate = date('Y-m-d');
                $boardDate = date('Y-m-d', strtotime($arr['boardDate']));
                if ($currentDate == $boardDate) {  // 날짜가 같으면 시:분 형식으로 출력
                    $displayDate = date('H:i', strtotime($arr['boardDate']));
                } else {  // 날짜가 다르면 년-월-일 형식으로 출력
                    $displayDate = date('Y-m-d', strtotime($arr['boardDate']));
                }
            ?>
                <div class="board">
                    <a href="question_view.php?idx=<?php echo $arr['boardIdx']; ?>">
                        <div class="title"><?php echo $arr['boardTitle']; ?></div>
                        <div class="content"><?php echo $arr['boardDetail']; ?></div>
                        <div class="meta">
                            <div class="nickname"><?php echo $arr['userNickname']; ?></div>
                            <div class="date"><?php echo $displayDate; ?></div>
                            <div class="vies"><i class="fa-solid fa-eye"></i> <?php echo $arr['boardViews']; ?></div>
                            <div class="good"><i class="fa-solid fa-heart"></i> <?php echo $arr['boardGood']; ?></div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div id="page_num">
            <?php
            if ($page > 1) {
                $page--;
                echo "<a href=\"question_list.php?page=1\"><i class='fa-solid fa-angles-left' style='margin-right: 10px;'></i></a>";
                echo "<a href=\"question_list.php?page=$page\"><i class='fa-solid fa-angle-left' style='margin-right: 10px;'></i></a>";
                $page++;
            }
            $totalPage = ceil($row / $pagePer);
            $pageNum = 1;

            while ($pageNum <= $totalPage) {
                if ($page == $pageNum)
                    echo "<a href=\"question_list.php?page=$pageNum\">$pageNum</a>";
                else
                    echo "<a href=\"question_list.php?page=$pageNum\">$pageNum</a>";
                $pageNum++;
                echo "<span style='margin-right: 10px;'></span>";
            }
            if ($page < $totalPage) {
                $page++;
                echo "<a href=\"question_list.php?page=$page\"><i class='fa-solid fa-angle-right' style='margin-right: 10px'></i></a>";
                echo "<a href=\"question_list.php?page=$totalPage\"><i class='fa-solid fa-angles-right' style='margin-right: 10px'></i></a>";
            }
            ?>
        </div>
        <div id="board_write">
            <input type="button" value="글쓰기" onclick="location.href='question_write.php'" id="writeBtn" />
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
    </script>
</body>

</html>