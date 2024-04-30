<?php
    // Bắt đầu hoặc tiếp tục phiên session
    session_start();

    // Xóa tất cả các biến session
    $_SESSION = array();

    // Nếu cần, xóa cả cookie session
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Hủy phiên session
    session_destroy();

    // Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính (tuỳ vào yêu cầu của bạn)
    header("Location: ../home.php");
    exit(); 

?>