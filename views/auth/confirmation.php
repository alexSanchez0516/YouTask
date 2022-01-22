<div class="row justify-content-center alerts m-2 p-2 ">
    <?php foreach ($alerts as $alert) : ?>
        <span class="fs-5 text-center text-danger errors"><?php echo $alert ?></span>
    <?php endforeach; ?>
</div>