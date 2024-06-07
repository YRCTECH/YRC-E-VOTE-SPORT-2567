<?php require_once './server/connet.php'; 
require_once './function/student.php';

// Check for login
if (empty($_SESSION['student_ID'])) {
    header("location: ./login.php");
    exit();
}

// Call function student
$student = new Student_func();
$voteStatus = $student->getStatusVote(); // Get status vote

// Check status vote
if ($voteStatus["setting_status"] == "ON") {
    header("location: ./index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบเลือกตั้งประธานสี - โรงเรียนยุพราชวิทยาลัย</title>
    <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./plugin/bootstrap-5.3.3-dist/bootstrap.css">
    <link rel="stylesheet" href="./plugin/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="./dist/style.css">
</head>
<body>
    <?php 
        if ($voteStatus["setting_status"] == "ON") {
            require_once './component/navbar.php'; 
        }
    ?>
    <div class="full-screen bg-gray flex align-items-center justify-content-center position-relative" style="opacity: 0.7;">
        <div class="container text-center">
            <div class="m-auto mb-4 w-75">
                <img src="./assets/logo.png" alt="" class="col-4 col-md-3 col-lg-2 m-auto d-block">
            </div>
            <h3>ระบบเลือกตั้งประธานสี<br>ได้ทำการปิดแล้ว</h3>
            <p>กรุณาออกจากระบบ</p>
            <button id="logout" class="btn btn-danger">ออกจากระบบ</button>
        </div>
        <div class="position-absolute bottom-0 start-50 mb-1 w-100 text-center" style="font-size: 10px; transform:translateX(-50%);">&copy; 2024 YRC Gifted Computer - Techin Pongmukda</div>
    </div>
</body>
<script src="./plugin/sweetalert2/sweetalert2.min.js"></script>
<script src="./plugin/jquery.js"></script>
<script src="./plugin/bootstrap-5.3.3-dist/bootstrap.bundle.min.js"></script>
<!-- Everypage -->
<script>
    // Logout
    $("#logout").click(function() {
        Swal.fire({
            title: 'ออกจากระบบ',
            text: "คุณต้องการออกจากระบบหรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'ออกจากระบบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "./process/logout_db.php",
                    data: {
                        logout: true
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'ออกจากระบบสำเร็จ',
                            text: "กำลังออกจากระบบ...",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.href = './login.php';
                        });
                    }
                });
            }
        });
    });
</script>
</html>