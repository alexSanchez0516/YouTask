<!-- Modal CREATE EVENT TASK -->
<div class="modal fade" id="modalCreateEvent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Crear Evento</h5>
                <button type="button" class="btn-close" onclick="closeModal('#modalCreateEvent')" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="body__calendar__create">
                <form id="form__create_ev">
                    <div class="mb-3 d-flex flex-column">
                        <label for="recipient-name" class="col-form-label">Tarea:</label>


                        <select name="id_task" id="id_task" class="form-control" required>
                            <option selected value="null">NINGUNO</option>
                            <?php foreach ($tasks as $task) : ?>
                                <option value="<?php echo $task['id'] ?>"><?php echo $task['name'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="start">Inicio:</label>
                        <input type="date" name="start" id="start_event" value="" required />

                        <label for="end">Fin:</label>
                        <input type="date" name="end" id="end_event" required />


                    </div>
                </form>

            </div>
            <div class="modal-footer" id="modal__footer__create">
                <button type="button" id="btn_close_modal_event" data-dismiss="#staticBackdrop" class="btn btn-secondary" onclick="closeModal('#modalCreateEvent')">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="createEventC()">Crear</button>
            </div>
        </div>
    </div>
</div>