<?php include_once __DIR__ . "/../templates/perfil_header.php"; ?>

<div class="row my-4 d-flex justify-content-center">
  <h4 class="text-center" id="countFriends"></h4>
</div>

<div class="row w-100 justify-content-center mb-5"> ">
  <form class="d-flex flex-column col-10 col-sm-5 col-lg-4 my-2 my-lg-0">
    <input class="form-control mb-2 mr-sm-2" minlength="3" name="profile" type="text" id="search_profile" placeholder="Search">
    <button id="btn__search__friends" class="btn btn-outline-dark mb-2 my-2 my-sm-0" data-bs-toggle="modal" data-bs-target="#modal__profiles" type="button">Search</button>
  </form>
</div>

<!-- Modal -->
<div class="modal fade" id="modal__profiles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Búsqueda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="content__profiles" class="modal-body">
        No hay resultados
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<div class="row justify-content-center" id="container_friends">


</div>