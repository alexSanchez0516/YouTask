<div class="row justify-content-center alerts m-4 p-2 ">
    <?php foreach ($alerts as $alert) : ?>
        <?php if ($typeAlert) : ?>
            <span class="fs-5 text-center text-primary errors"><?php echo $alert ?></span>
        <?php elseif (!$typeAlert) : ?>
            <span class="fs-5 text-center text-danger errors"><?php echo $alert ?></span>
        <?php endif; ?>
    <?php endforeach; ?>
</div>