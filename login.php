<?php require_once './server/connet.php'; 

    if (isset($_SESSION['student_ID'])) {
        header('Location: ./index.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./plugin/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="./dist/style.css">
    <link rel="stylesheet" href="./dist/log.css">
</head>
<body class="d-flex align-items-center justify-content-center w-100" style="min-height: 100vh;">
    <!-- Box -->
    <div class="col-10 col-md-9 col-xl-6 d-block d-md-flex shadow-lg rounded-4 bg-white">
        <!-- Image -->
        <div class="d-none d-md-flex overflow-hidden h-100 align-items-center justify-content-center rounded-start-4">
            <img src="./assets/image/login_asset.jpg" alt="image-asset" class="login-asset d-block">
        </div>

        <!-- Form -->
        <div class="col-12 col-md-6">
            <form action="./process/login_db.php" method="post" class="p-5 pb-1 pt-4 d-flex flex-column" style="min-height: 100%;">
                <!-- Logo -->
                <div class="mb-4">
                    <img src="./assets/logo2.png" alt="" class="col-4 col-lg-3 m-auto d-block">
                </div>

                <!-- Title -->
                <div class="mb-5">
                    <h3 class="text-res text-center fs-bold">ระบบเลือกตั้ง<br>ประธานคณะสี</h3>
                    <p class="text-secondary text-center m-0 fs-bold" style="font-size: small;">ปี พ.ศ. 2567</p>
                </div>

                <!-- ID -->
                <div class="mb-4">
                    <input type="text" name="student_ID" id="student_ID" class="inp-login" placeholder="เลขประจำตัวนักเรียน" autocomplete="off">
                </div>

                <!-- Password -->
                <div class="mb-4 w-100" style="position: relative;">
                    <input type="password" name="password" id="password" class="inp-login" placeholder="รหัสผ่าน" autocomplete="off">
                    <i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                </div>

                <!-- Submit -->
                <div class="mb-4">
                    <button type="submit" name="login" id="login" class="btn btn-login w-100 fs-bold text-white">เข้าสู่ระบบ</button>
                </div>

                <!-- Cradit -->
                <div class="w-100 mt-auto">
                    <p class="text-secondary text-center m-0 mb-3" style="font-size: small;">
                        &copy; 2024 YRC Gifted Computer<br>By Techin Pongmukda
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="./plugin/bootstrap-5.3.3-dist/bootstrap.bundle.min.js"></script>
<script src="./plugin/sweetalert2/sweetalert2.min.js"></script>
<script src="./plugin/jquery.js"></script>
<script>
    // Show and hide password
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // toggle the icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

<!-- Alert -->
<?php if (isset($_GET["error"])) { ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: '<?php echo $_SESSION['error']; unset($_SESSION['error']) ?>',
            timer: 2000
        }).then(() => {
            window.location.href = './login.php';
        });
    </script>
<?php } else if (isset($_GET["success"])) { ?>
    <script>
        Swal.fire({
                icon: 'success',
                title: 'เข้าสู่ระบบสำเร็จ',
                timer: 2000
            }).then(() => {
                window.location.href = './index.php';
            });
    </script>
<?php } ?>
</html>