<?php
    // Check for login
    if (empty($_SESSION['student_ID'])) {
        header("location: ./login.php");
        exit();
    }

    $st_ID = $_SESSION['student_ID'];

    // Call function student
    $student = new Student_func();
    $studentData = $student->getStudentData($st_ID); // Get student data
    $voteStatus = $student->getStatusVote(); // Get status vote

    // Check status vote
    if ($voteStatus["setting_status"] == "OFF") {
        header("location: ./closevote.php");
        exit();
    }
?>
<?php if ($voteStatus["setting_status"] == "ON") { ?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light ml-0">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item d-block">
            <a href="index.php" class="nav-link fs-bold">หน้าหลัก</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item d-block">
                <p class="m-0 nav-link Howtouse" style="cursor: pointer;">วิธีการใช้งาน</p>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
<?php } ?>