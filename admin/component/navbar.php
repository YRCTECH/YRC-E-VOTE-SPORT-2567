<?php

  // Check for login
  if (empty($_SESSION['admin_ID'])) {
    header('location: ./login.php');
  }

  // Check for rank
  if ($_SESSION['rank'] != 'admin') {
    header('location: ../index.php');
  }

  // Get admin data
  $admin_ID = $_SESSION['admin_ID'];
  $admin = new Admin_func();
  $admin_data = $admin->getAdminData($admin_ID);

  // Get student information
  $student = new Student_func();
  $num_row_student = $student->getNumRowStudent();
  $num_row_vote = $student->getNumRowVote();

  // Get vote status
  $setting = $admin->getSetting();

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index.php" class="nav-link fs-bold">หน้าหลัก</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link"><?php echo $admin_data["ad_username"] ?></a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->