<?php if (empty($data)) : ?>
    <div class="d-flex flex-column w-100 align-items-center" id="wrap_initials">
        <h1><span class="badge bg-success">Bienvenido a YouTask ❤️</span></h1>
        <div class="d-flex w-50  mt-4 justify-content-center">
            <button type="button" id="create_project" class="btn btn-success mx-2">Crear proyecto</button>
            <button type="button" id="create_task" class="btn btn-success ">Crear tarea</button>
        </div>
    </div>
    <!-- COMPONENT CREATE PROJECTS ADD TASK-->
    <div class="" id="wrap_create_project">
        <h2 class="mb-4 mt-2">Crear proyecto</h2>
        <form class="row g-3" action="" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Nombre</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Administrador</label>
                <select id="inputState" class="form-select">
                    <option selected>Tú</option>
                    <option>...</option>
                </select>
            </div>

            <div class="col-10">
                <label for="inputAddress" class="form-label">Descripcion</label>
                <textarea name="description" class="form-control" rows="10" id="inputDescription" placeholder="Describe tu proyecto con matices"></textarea>
            </div>

            <div class="col-md-4">
                <label for="inputState" class="form-label">Miembros</label>
                <select id="inputState" class="form-select" multiple="" required>
                    <option selected>Tú</option>
                    <option>JUAN</option>
                    <option>JUAN</option>
                    <option>JUAN</option>
                    <option>JUAN</option>
                    <option>JUAN</option>
                    <option>JUAN</option>
                    <option>JUAN</option>
                    <option>JUAN</option>

                </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Prioridad</label>
                <select id="inputState" class="form-select">
                    <option selected>Baja</option>
                    <option>Media</option>
                    <option>Alta</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Fecha Fin</label>
                
                <input type="datetime-local" class="form-control" id="inputDate" name="dateEnd" value="<?php echo date("Y-m-d H:i:s") ?>" min="" max="">
            </div>
            
            <div class="col-12 mb-2">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </form>
    </div> 
    

<?php else : ?>
    para usuarios ya con proyectos y tareas


<?php endif; ?>