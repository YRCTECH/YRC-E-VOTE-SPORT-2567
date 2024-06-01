<?php require_once '../server/connet.php';
require_once '../function/student.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
        $student_ID = htmlspecialchars($_POST['student_ID'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

        // Check if the input is empty
        if (empty($student_ID) || empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
            header("location: ../login.php?error=1");
            exit();
        }

        // Call the function
        $func = new Student_func();

        // Login
        $login = $func->userLogin($student_ID);
        if ($login) {
            // Check if the password is correct
            if ($password != $login["st_password"]) {
                $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
                header("location: ../login.php?error=1");
                exit();
            } else {
                // Set the session
                $_SESSION['student_ID'] = $login['st_idstudent'];
                $_SESSION["t_color"] = $login["st_colort"];
                $_SESSION["rank"] = "student";
                $_SESSION['success'] = 'เข้าสู่ระบบสำเร็จ';
                header("location: ../login.php?success=1");
                exit();
            }
        } else {
            $_SESSION['error'] = 'ไม่พบข้อมูลนักเรียน';
            header("location: ../login.php?error=1");
            exit();
        }

    }
} catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
    header("location: ../login.php?error=1");
    exit();
}