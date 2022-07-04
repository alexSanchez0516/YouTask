<div class="row">
    <?php include_once __DIR__ . "/../templates/alerts.php" ?>

    <h1 class="">YouTask</h1>
    <form action="" method="post" class="">

        <div class=" col-md-6">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" required minlength="1" name="name" class="form-control" value="<?php echo s($project->name) ?>" id="name">
        </div>
        <div class="col-10">
            <label for="description" class="form-label">Descripcion</label>
            <textarea name="description" minlength="3" required class="form-control" rows="10" id="description" placeholder="Describe tu proyecto con matices"><?php echo s($project->description); ?></textarea>
        </div>



        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4">
                    <label for="adminID" class="form-label">Creador</label>
                    <select id="adminID" name="adminID" class="form-select" required>
                        <option value='<?php echo $project->adminID ?>' selected><?php echo $creator->username; ?></option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="priority" class="form-label">Prioridad</label>
                    <select id="priority" name="priority" required class="form-select">
                        <option value="<?php echo $project->priority; ?>" selected><?php echo $project->priority; ?></option>

                        <?php if ($project->priority == 'ALTA') : ?>
                            <option value="MEDIA">MEDIA</option>
                            <option value="BAJA">BAJA</option>
                        <?php elseif ($project->priority == 'MEDIA') : ?>
                            <option value="ALTA">ALTA</option>
                            <option value="BAJA">BAJA</option>
                        <?php else : ?>
                            <option value="ALTA">ALTA</option>
                            <option value="MEDIA">MEDIA</option>
                        <?php endif; ?>

                    </select>
                </div>

                <div class="col-md-4">
                    <label for="state" class="form-label">Estado</label>
                    <select id="state" name="state" required class="form-select">
                        <option value="<?php echo $project->state; ?>" selected><?php echo $project->state; ?></option>

                        <?php if ($project->state == 'REALIZADO') : ?>
                            <option value="EN PROCESO">EN PROCESO</option>
                            <option value="CANCELADO">CANCELADO</option>
                        <?php elseif ($project->state == 'EN PROCESO') : ?>
                            <option value="REALIZADO">REALIZADO</option>
                            <option value="CANCELADO">CANCELADO</option>
                        <?php else : ?>
                            <option value="EN PROCESO">EN PROCESO</option>
                            <option value="REALIZADO">REALIZADO</option>
                        <?php endif; ?>

                    </select>
                </div>


                <div class="col-md-4">
                    <label for="date_end" class="form-label">Fecha Fin (Y-m-d H:i:s)</label>

                    <input type="datetime" required class="form-control" id="inputDate" name="date_end" value="<?php echo $project->date_end; ?>" min="" max="" required>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <button type="submit" class="btn btn-primary py-2 my-2">Guardar</button>
            <button onclick="window.location.href='/proyecto?id=<?php echo $_GET['id'] . '&limit=10&page=1'; ?>'" type="button" class="btn btn-primary">Ir atrás</button>
        </div>
    </form>
</div>