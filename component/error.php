<?php if (isset($_SESSION['error'])) { ?>
    <div class="text-white bg-danger p-3 fs-bold rounded-3 text-center">
        <p class="mb-0 mt-0">
            <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </p>
    </div>
<?php } ?>