<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 full-screen">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../assets/logo.png" alt="YRC logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">YRC E-Vote</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Homepage -->
                <li class="nav-item">
                    <a href="./index.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>
                            หน้าหลัก
                        </p>
                    </a>
                </li>

                <!-- Vote history -->
                <li class="nav-item">
                    <a href="./votehistory.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-check-to-slot"></i>
                        <p>
                            ประวัติการโหวต
                        </p>
                    </a>
                </li>

                <!-- Top vote -->
                <li class="nav-item">
                    <a href="./topvote.php" class="nav-link">
                        <i class="nav-icon fa-solid fa-star text-warning"></i>
                        <p>
                            ผลโหวดยอดนิยม
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- Bottom sidebar -->
    <div class="mt-auto sidebar mb-3">
        <!-- Chage mode status -->
        <div class="mb-3">
            <button type="submit" id="changeStatus" class="text-white bg-gray btn w-100 align-items-center">
                <?php echo $setting["setting_status"] == "ON" ? '<i class="fa-solid fa-unlock"></i>' : '<i class="fa-solid fa-lock"></i>' ?>
                <span id="voteStatusText" class="ps-1">เปลี่ยนสถานะระบบโหวด</span>
            </button>
        </div>

        <!-- Logout -->
        <button type="submit" id="logout" class="text-white bg-danger btn w-100"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</button>
    </div>
    <!-- /.sidebar -->
</aside>