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
        <form class="row g-3 justify-content-center" action="/panel" method="POST" enctype="multipart/form-data">
            <?php include_once __DIR__ . "/../templates/createProject.php"; ?>
        </form>
    </div>

<?php else : ?>
    para usuarios ya con proyectos y tareas


<?php endif; ?>