<div class="row">
    <?php include_once __DIR__ . "/../templates/alerts.php" ?>

    <h1 class="">YouTask</h1>
    <form action="" method="post" class="">

        <div class=" col-md-6">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" required minlength="1" name="name" class="form-control" value="<?php echo s($Task->name) ?>" id="name">
        </div>
        <div class="col-10">
            <label for="description" class="form-label">Descripcion</label>
            <textarea name="description" minlength="3" required class="form-control" rows="10" id="description" placeholder="Describe tu proyecto con matices"><?php echo s($Task->description); ?></textarea>
        </div>



        <div class="col-md-8">
            <div class="row">

                <div class="col-md-4">
                    <label for="priority" class="form-label">Prioridad</label>
                    <select id="priority" name="priority" required class="form-select">
                        <option value="<?php echo $Task->priority; ?>" selected><?php echo $Task->priority; ?></option>

                        <?php if ($Task->priority == 'ALTA') : ?>
                            <option value="MEDIA">MEDIA</option>
                            <option value="BAJA">BAJA</option>
                        <?php elseif ($Task->priority == 'MEDIA') : ?>
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
                        <option value="<?php echo $Task->state; ?>" selected><?php echo $Task->state; ?></option>

                        <?php if ($Task->state == 'REALIZADO') : ?>
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

                    <input type="datetime" required class="form-control" id="inputDate" name="date_end" value="<?php echo $Task->date_end; ?>" min="" max="" required>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <button onclick="window.location.href='/tarea?id=<?php echo $_GET['id']; ?>'" type="button" class="btn btn-primary m-2">Ir atrás</button>
            <button type="submit" class="btn btn-primary py-2 my-2">Guardar</button>

        </div>
    </form>
</div>