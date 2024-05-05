<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $note = $_POST['bill_note'];
        
        $_SESSION['bill_note'] = $note;

        header("Location: ../orderinfo.php");
    }
?>