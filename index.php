<?php
$db_conn = mysqli_connect('localhost', 'root', '', 'board') or die('Unable to connect. Check your connection parameters.')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/js/jquery-3.7.1.min.js"></script>
</head>
<link rel="shortcut icon" href="#">

<body>
    <div class="header"></div>
    <div class="login"></div>

    <main>
        <div class="popularPost" id="question">
            <h1>질문 인기글</h1>
            <span>view</span>
            <div class="view">
                <?php
                $query = "SELECT * FROM question_list ORDER BY boardViews DESC, boardDate DESC LIMIT 3";
                $result = mysqli_query($db_conn, $query) or die(mysqli_error($db_conn));

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="post">';
                        echo '<h2><a href="/pages/question_view.php?idx=' . htmlspecialchars($row['boardIdx']) . '">' . htmlspecialchars($row['boardTitle']) . '</a></h2>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>게시물이 없습니다.</p>';
                }
                ?>
            </div>
            <span>good</span>
            <div class="good">
                <?php
                $query = "SELECT * FROM question_list ORDER BY boardGood DESC, boardDate DESC LIMIT 3";
                $result = mysqli_query($db_conn, $query) or die(mysqli_error($db_conn));

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="post">';
                        echo '<h2><a href="/pages/question_view.php?idx=' . htmlspecialchars($row['boardIdx']) . '">' . htmlspecialchars($row['boardTitle']) . '</a></h2>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>게시물이 없습니다.</p>';
                }
                ?>
            </div>
        </div>
        <div class="popularPost" id="information">
            <h1>정보 인기글</h1>
            <span>view</span>
            <div class="view">
                <?php
                $query = "SELECT * FROM information_list ORDER BY boardViews DESC, boardDate DESC LIMIT 3";
                $result = mysqli_query($db_conn, $query) or die(mysqli_error($db_conn));

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="post">';
                        echo '<h2><a href="/pages/information_view.php?idx=' . htmlspecialchars($row['boardIdx']) . '">' . htmlspecialchars($row['boardTitle']) . '</a></h2>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>게시물이 없습니다.</p>';
                }
                ?>
            </div>
            <span>good</span>
            <div class="good">
                <?php
                $query = "SELECT * FROM information_list ORDER BY boardGood DESC, boardDate DESC LIMIT 3";
                $result = mysqli_query($db_conn, $query) or die(mysqli_error($db_conn));

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="post">';
                        echo '<h2><a href="/pages/information_view.php?idx=' . htmlspecialchars($row['boardIdx']) . '">' . htmlspecialchars($row['boardTitle']) . '</a></h2>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>게시물이 없습니다.</p>';
                }
                ?>
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
    </script>
</body>

</html>