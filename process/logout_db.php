<?php require_once '../server/connet.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
        session_destroy();
        header("location: ../login.php");
        exit();
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}