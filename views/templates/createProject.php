<div class="col-md-6">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" required minlength="1" name="name" class="form-control" id="name">
</div>
<div class="col-md-4">
    <label for="adminID" class="form-label">Administrador</label>
    <select id="adminID" name="adminID" class="form-select" required>
        <option value=<?php echo $_SESSION['user'] ?> selected>Tú</option>
    </select>
</div>

<div class="col-10">
    <label for="description" class="form-label">Descripcion</label>
    <textarea name="description" minlength="3" required class="form-control" rows="10" id="description" placeholder="Describe tu proyecto con matices"></textarea>
</div>

<div class="col-md-4">

    <label for="members" class="form-label">Miembros</label>
    <select id="members" name="members[]" class="form-select" multiple required>
        <option value="<?php echo $_SESSION['user'] ?>" selected>Tú</option>
        <?php foreach ($contacts as $contact) : ?>
            <option value="<?php echo $contact['id'] ?>"><?php echo $contact['username'] ?></option>
        <?php endforeach; ?>

    </select>
</div>
<div class="col-md-4">
    <label for="priority" class="form-label">Prioridad</label>
    <select id="priority" name="priority" required class="form-select">
        <option value="BAJA" selected>Baja</option>
        <option value="MEDIA">Media</option>
        <option value="ALTA">Alta</option>
    </select>
</div>
<div class="d-flex flex-column align-items-center">
    <div class="col-md-2">
        <label for="date_end" class="form-label">Fecha Fin</label>
    </div>
    <div class="col-md-2">
        <label for="date_end" class="form-label">(Y-m-d H:i:s)</label>

        <input type="datetime" requiredclass="form-control" id="inputDate" name="date_end" value="" " min="" max="" required>
    </div>
</div>


<div class=" col-12 mb-2 d-flex justify-content-center">
        <button type="button" onclick="window.location.href='/panel'" class="btn btn-danger mx-2" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Crear</button>

    </div>