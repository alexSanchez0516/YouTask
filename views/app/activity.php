<?php include_once __DIR__ . "/../templates/perfil_header.php"; ?>
<div class="row mt-3">
    <div class="activity_perfil col">
        <div class="d-flex flex-column">
            <h3 class="text-center text-secondary mb-2">Actividad Reciente </h3>
        </div>
    </div>

</div>

<div class="table-responsive activity_perfil">
    <table class="table">
        <tbody>

            <?php foreach ($activities as $activity) : ?>

                <?php


                $item_name = null;

                if ($activity->project_name != null) {
                    $item_name = $activity->project_name;
                }

                if ($activity->task_name != null) {
                    $item_name = $activity->task_name;
                }

                if ($activity->post_name != null) {
                    $item_name = $activity->post_name;
                }

                ?>

                <tr>
                    <td class="text-center">
                        <i class="fa fa-comment"></i>
                    </td>
                    <td>
                        <?php echo $activity->username . " ";
                        echo $activity->action;

                        ?> <a href="#"><?php echo $item_name; ?></a> .
                    </td>
                    <td>
                        <?php echo $activity->create_at; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>