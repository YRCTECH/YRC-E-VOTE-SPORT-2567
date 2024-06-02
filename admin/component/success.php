<?php if (isset($_SESSION['success'])) { ?>
    <div class="text-white bg-success p-3 fs-bold rounded-3 text-center">
        <p class="mb-0 mt-0">
            <?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </p>
    </div>
<?php } ?>