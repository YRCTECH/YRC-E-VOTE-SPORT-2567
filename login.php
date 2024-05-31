<?php require_once './server/connet.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบเลือกตั้งประธานสี - โรงเรียนยุพราชวิทยาลัย</title>
    <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./plugin/bootstrap-5.3.3-dist/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./dist/style.css">
    <link rel="stylesheet" href="./dist/log.css">
</head>
<body class="d-flex align-items-center justify-content-center w-100 position-relative" style="min-height: 100vh;">
    <!-- Box -->
    <div class="col-10 col-md-9 col-xl-7 d-block d-md-flex shadow-lg rounded-4 bg-white">
        <!-- Image -->
        <div class="col-0 col-md-6 d-none d-md-flex overflow-hidden h-100 align-items-center justify-content-center rounded-start-4">
            <img src="./assets/image/login_bg.jpeg" alt="image-asset" class="login-asset d-block">
        </div>

        <!-- Form -->
        <div class="col-12 col-md-6">
            <form action="" method="post" class="p-5">
                <!-- Title -->
                <h3 class="mb-5 text-res text-center fs-bold">ระบบเลือกตั้งประธานคณะสี</h3>

                <!-- ID -->
                <div class="mb-4">
                    <input type="text" name="student_ID" id="student_ID" class="inp-login" placeholder="รหัสนักเรียน" autocomplete="off">
                </div>

                <!-- Password -->
                <div class="mb-4 w-100" style="position: relative;">
                    <input type="password" name="password" id="password" class="inp-login" placeholder="รหัสผ่าน" autocomplete="off">
                    <i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                </div>

                <!-- Submit -->
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary btn-login px-4 w-100">เข้าสู่ระบบ</button>
                </div>

                <!-- Cradit -->
                <div class="w-100 mt-auto">
                    <p class="text-secondary text-center m-0">
                        &copy; 2024 YRC TECH - Techin Pongmukda
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
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
</html>