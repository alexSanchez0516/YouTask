<?php include_once __DIR__ . "/../templates/perfil_header.php"; ?>

<div class="row mt-3">
    <div class="col">
        <div class="d-flex flex-column">
            <h3 class="text-center text-secondary mb-2">Actividad Reciente </h3>
        </div>
    </div>
    <div class="col">
        <button type="button" class="btn btn-primary w-50">Ocultar</button>
    </div>
</div>

<div class="table-responsive ">
    <table class="table">
        <tbody>
            <tr>
                <td class="text-center">
                    <i class="fa fa-comment"></i>
                </td>
                <td>
                    John ha escrito un comentario en el projecto <a href="#">Avengers Initiative</a> .
                </td>
                <td>
                    2014/08/08 12:08
                </td>
            </tr>

            <tr>
                <td class="text-center">
                    <i class="fa fa-check"></i>
                </td>
                <td>
                    Angel ha <span class="label label-success">completado la tarea <a href="">Validar HTML</a></span>
                </td>
                <td>
                    2014/08/08 12:08
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <i class="fa fa-users"></i>
                </td>
                <td>
                    John se ha unido al projecto<a href="#"> Avengers Initiative</a>.
                </td>
                <td>
                    2014/08/08 12:08
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <i class="fa fa-heart"></i>
                </td>
                <td>
                    John le ha dado me gusta al articulo <a href="#">Avengers Initiative</a>
                </td>
                <td>
                    2014/08/08 12:08
                </td>
            </tr>

        </tbody>
    </table>
</div>
<nav aria-label="..." class="mb-4">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Anterior</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active">
            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Siguiente</a>
        </li>
    </ul>
</nav>



<div class="row w-100 justify-content-center mb-2 mx-2">
    <div class="col-md-12 col-lg-3  mx-2 mb-2">
        <div class="row">
            <span class="border shadow p-2 mb-4"><strong>Sobre mi</strong> <a href="editar-perfil"><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="19" cy="12" r="1"></circle>
                        <circle cx="5" cy="12" r="1"></circle>
                    </svg></a> <br> Hi, I'm Alexander. I'm a multi-talented human with over 2+ years of experiences in wide range of programming disciplines.
            </span>
            <div class="col mt-2 border shadow p-2">
                <h3 class="bg-grey p-2">Skills <i class="fa fa-trophy fs-4"></i></h3>
                <span class="badge bg-primary">Java</span>
                <span class="badge bg-primary">Php</span>
                <span class="badge bg-primary">Bootstrap</span>
                <span class="badge bg-primary">Django</span>
                <span class="badge bg-primary">JavaScript</span>
                <span class="badge bg-primary">MySql</span>
                <span class="badge bg-primary">Git</span>
                <span class="badge bg-primary">HTML</span>
                <span class="badge bg-primary">CSS</span>
                <span class="badge bg-primary">SaSS</span>

            </div>

        </div>

    </div>

    <section id="wrap-articles" class="col-md-12 col-lg-6 border shadow mx-2 p-4 mb-2">
        <article class="wrap-article m-2">
            <span class="text-right d-block w-100 text-end">2015-05-17 19:00</span>
            <h3>API GatsBy JS</h3>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam dolores dolorum repellat facere dolore impedit? Ex accusamus a incidunt iure maxime corrupti vero facere necessitatibus ut corporis. Pariatur, perferendis libero. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa accusamus suscipit fugiat, dolores perspiciatis hic omnis incidunt officiis minus! Sit aut ipsum nobis qui illum at eos veniam incidunt quo.
            </p>
            <div>
                <div class="d-flex post-actions">
                    <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart icon-md">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        <p class="d-none d-md-block mx-2">Like</p>
                    </a>
                    <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square icon-md">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <p class="d-none d-md-block mx-2">Comentar</p>
                    </a>
                    <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share icon-md">
                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                            <polyline points="16 6 12 2 8 6"></polyline>
                            <line x1="12" y1="2" x2="12" y2="15"></line>
                        </svg>
                        <p class="d-none d-md-block ml-2">Compartir</p>
                    </a>
                </div>
            </div>
        </article>
        <hr />
        <article classs="wrap-article m-2">
            <span class="text-right d-block w-100 text-end">2015-05-17 19:00</span>
            <h3>API GatsBy JS</h3>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam dolores dolorum repellat facere dolore impedit? Ex accusamus a incidunt iure maxime corrupti vero facere necessitatibus ut corporis. Pariatur, perferendis libero. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa accusamus suscipit fugiat, dolores perspiciatis hic omnis incidunt officiis minus! Sit aut ipsum nobis qui illum at eos veniam incidunt quo.
            </p>
            <div>
                <div class="d-flex post-actions">
                    <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart icon-md">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        <p class="d-none d-md-block mx-2">Like</p>
                    </a>
                    <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square icon-md">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <p class="d-none d-md-block mx-2">Comentar</p>
                    </a>
                    <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share icon-md">
                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                            <polyline points="16 6 12 2 8 6"></polyline>
                            <line x1="12" y1="2" x2="12" y2="15"></line>
                        </svg>
                        <p class="d-none d-md-block ml-2">Compartir</p>
                    </a>
                </div>
            </div>
        </article>
        <hr />
        <article class="wrap-article m-2">
            <span class="text-right d-block w-100 text-end">2015-05-17 19:00</span>
            <h3>API GatsBy JS</h3>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam dolores dolorum repellat facere dolore impedit? Ex accusamus a incidunt iure maxime corrupti vero facere necessitatibus ut corporis. Pariatur, perferendis libero. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa accusamus suscipit fugiat, dolores perspiciatis hic omnis incidunt officiis minus! Sit aut ipsum nobis qui illum at eos veniam incidunt quo.
            </p>
            <div>
                <div class="d-flex post-actions">
                    <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart icon-md">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        <p class="d-none d-md-block mx-2">Like</p>
                    </a>
                    <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square icon-md">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <p class="d-none d-md-block mx-2">Comentar</p>
                    </a>
                    <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share icon-md">
                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                            <polyline points="16 6 12 2 8 6"></polyline>
                            <line x1="12" y1="2" x2="12" y2="15"></line>
                        </svg>
                        <p class="d-none d-md-block ml-2">Compartir</p>
                    </a>
                </div>
            </div>

        </article>
    </section>

    <div class="col-md-12 col-lg-2  mx-2">
        <div class="row border shadow p-4">
            <strong class="mb-2">Redes Sociales</strong>
            <div class="col">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>
            <div class="col ">
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
            <div class="col">
                <a href="#"><i class="fa-brands fa-github"></i></a>
            </div>
        </div>
    </div>
</div>