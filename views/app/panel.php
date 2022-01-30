<?php if (empty($data)) : ?>
    <div class="d-flex flex-column w-100 align-items-center" id="wrap_initials">
        <h1><span class="badge bg-success">Bienvenido a YouTask ❤️</span></h1>
        <div class="d-flex w-50  mt-4 justify-content-center">
            <button type="button" id="create_project" class="btn btn-success mx-2">Crear proyecto</button>
            <button type="button" id="create_task" class="btn btn-success ">Crear tarea</button>
        </div>
    </div>
    <div class="" id="wrap_create_project">
        <!--<form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="First name" aria-label="First name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                </div>
            </div>
        </form> -->
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

            <div class="col-12">
                <label for="inputAddress" class="form-label">Descripcion</label>
                <textarea name="description" class="form-control" rows="10" id="inputDescription" placeholder="Describe tu proyecto con matices"></textarea>
            </div>

            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="inputZip">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
    </div>

<?php else : ?>


<?php endif; ?>