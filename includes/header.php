<?php
session_start();
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <header>
        <div id="logo">
            <a href="/index.php"><img src="/assets/logo.png"></a>
        </div>
        <nav>
            <li><a href="/pages/question_list.php">질문</a></li>
            <li><a href="/pages/information_list.php">정보</a></li>
            <?php if ($isLoggedIn) : ?>
                <li id="logoutBtn"><a href="/php/member/logout.php">로그아웃</a></li>
                <li><a href="/pages/profile.php">프로필</a></li>
            <?php else : ?>
                <li id="loginBtn">로그인</li>
                <li><a href="/pages/signup.html">회원가입</a></li>
            <?php endif; ?>
        </nav>
    </header>

    <script>
        $(document).on("click", "#logoutBtn", function() {
            window.localStorage.clear();
        });
    </script>
</body>

</html>