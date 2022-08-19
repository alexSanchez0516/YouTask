<?php include_once __DIR__ . "/../templates/menuTopPanel.php"; ?>


<div class="content my-5">
    <h2 class="text-center text-primary">EVENTOS</h2>
    <div id='calendar'></div>

</div>

<!-- Modal INFO TASK -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tarea</h5>
                <button type="button" class="btn-close" onclick="closeModal('#staticBackdrop')" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal__calendar_event">

            </div>

            <div class="modal-footer" id="modal__footer">

            </div>
        </div>
    </div>
</div>

<!-- END MODAL INFO TASK -->



<!-- Modal CREATE EVENT TASK -->
<?php include_once __DIR__ . "/../templates/createEvents.php"; ?>




<link rel="stylesheet" type="text/css" href="build/css/main.css" />
<script src='https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js'></script>
<script type="text/javascript" src='build/js/main.js'></script>

