document.addEventListener('DOMContentLoaded', function () {
  let currentURL = window.location.pathname

  checkPassword()
  checkAlerts()
  showMenuResponse()
  showCreateProject()
  close_activity_perfil()
  showFriends()
  deleteFriend()
  listPosts()
  deletePost()
  update_post()
  send_response_comment()
  search_profile()
  getRequestsFollow()
  storage()
  previewImg()
  if (currentURL == '/editar-perfil') {
    getSkills()
  }
  if (currentURL == '/mensajes') {
    showContacts()
  }
})

async function showContacts() {
  const container__users = document.querySelector('#container__users')

  try {
    const url = 'http://127.0.0.1:8080/api/friends'
    const result = await fetch(url)
    let template = ''
    const friends = await result.json()
    friends[1].forEach((user) => {
      //ES UNO PORQUE LA API DEVUELVO friendsQuantity y los friends
      template += `
          <li class="follower__contact my-3  d-flex" data-chat="${user.id}">
            <div class="user  w-20">
                <img src="/build/img/${user.avatar}" data-avatar="/build/img/${user.avatar}" class="raidius_max w-100 " alt="Retail Admin">
            </div>
            <p class="name-time align-self-center text-dark mx-2">
                <span class="name_users_on_chat">${user.username}</span> 
            </p>

          </li>
        `
      container__users.innerHTML = template
    })
    showChatOnClick()
  } catch (error) {
    console.log(error)
  }
}

function showChatOnClick() {
  const follower__contacts = document.querySelectorAll('.follower__contact')
  const selected_user = document.querySelector('#selected-user') //text-content
  const chat__box__container = document.querySelector('#chat__box__container')

  let template = ''

  follower__contacts.forEach((contact) => {
    contact.addEventListener('click', (e) => {
      //pasar id del usuario selected
      //buscar los msg del usuario actual con dicho seleccionado
      let idSelected = Number(contact.getAttribute('data-chat'))
      let url_api = 'http://127.0.0.1:8080/api/chat/app'
      $.post(url_api, { idSelected }, (response) => {
        const mensages = JSON.parse(response)

        let name_users_on_chat = contact.children[1].children[0].textContent
        let image_avatar = contact.children[0].children[0].getAttribute(
          'data-avatar',
        )
        selected_user.textContent = name_users_on_chat
        mensages.forEach((msg) => {
          let isGroup = msg.isGroup == 1
          let isSender = msg.isSender == 1
          if (!isSender) {
            template += ` 
                <li class="chat-right d-flex justify-content-end my-2">
                    <div class="chat-text">
                      ${msg.msg}
                    </div>
                    <div class="chat-avatar mx-2 w-10">
                        <img src="${image_avatar}" class="raidius_max w-100" alt="Retail Admin">
                        <div class="chat-name">${name_users_on_chat}</div>
                    </div>
                </li>
            `
          } else {
            console.log('es sender')
            template += `
            <li class="chat-left d-flex align-items-center my-2">
                <div class="chat-avatar w-10">
                    <img src="${image_avatar}"  class="raidius_max w-100" alt="Retail Admin">
                    <div class="chat-name">Tú</div>
                </div>
                <div class="chat-text mb-2 mx-2">
                  ${msg.msg}
                </div>
            </li>
             `
          }
        })
        chat__box__container.innerHTML = template
      })
    })
  })
}

function createSkill() {
  let skill = $('#skill_name').val()
  console.log(skill)
  const btn_close_skill_user = document.querySelector('#btn_close_skill_user')
  const skills_data = document.querySelector('#skills_data')

  $.post('http://127.0.0.1:8080/api/create-skill', { skill }, (response) => {
    let result = JSON.parse(response)

    if (result) {
      btn_close_skill_user.click()
      skills_data.remove() //ESTO ES PARA VOLVER A MONTAR LAS SKILLS
      getSkills()
      Swal.fire('Creado correctamente', '', 'success')
    }
  })
}

function getSkills() {
  /*
  MARCAR COMO SELECTED LOS QUE YA ESTÁN EN DICHO USUARIO
  */

  const data_skills = document.createElement('select')
  data_skills.setAttribute('id', 'skills_data')
  data_skills.setAttribute('name', 'skills[]')
  data_skills.setAttribute('multiple', 'multiple')
  data_skills.classList.add('form-select')

  const container_skills = document.querySelector('#container_skills')
  let template = ''
  $.get('http://127.0.0.1:8080/api/get-skills', (response) => {
    const skills = JSON.parse(response)

    skills.forEach((skill) => {
      $.post(
        'http://127.0.0.1:8080/api/check-skill',
        { skill: skill.id },
        (response) => {
          if (response != null) {
            const id = JSON.parse(response)
            if (id != null) {
              template += `<option value="${skill.id}" selected>${skill.name}</option>`
            } else {
              template += `<option value="${skill.id}" >${skill.name}</option>`
            }
          }

          data_skills.innerHTML = template
          container_skills.appendChild(data_skills)
        },
      )
    })
  })
}

function openFileDialog() {
  document.querySelector('#image_avatar').click()
}

function previewImg() {
  let currentURL = window.location.pathname

  if (currentURL == '/editar-perfil') {
    const current_img = document.querySelector('#current_img')
    const inputImg = document.querySelector('#image_avatar')

    inputImg.addEventListener('change', () => {
      const img = inputImg.files
      if (img.length > 0) {
        const objURL = URL.createObjectURL(img[0])
        current_img.src = objURL
      }
    })
  }
}

function storage() {}

function deleteNotifications() {
  if (document.querySelectorAll('.fa-xmark') != undefined) {
    const fa_xmark = document.querySelectorAll('.fa-xmark')

    fa_xmark.forEach((xmark) => {
      xmark.addEventListener('click', () => {
        xmark.parentElement.remove()
      })
    })
  }
}

function getRequestsFollow() {
  const rutesNoProtected = ['/', '/inicio', '/login', '/registro', '/contacto']

  let currentURL = window.location.pathname

  const found = rutesNoProtected.find((r) => r == currentURL)
  if (found == undefined) {
    let url = 'http://127.0.0.1:8080/api/show-requests-followers'
    const wrap__notifications = document.querySelector('#wrap__notifications')

    $.get(url, (response) => {
      const followers = JSON.parse(response)
      let template = ''

      //solicitudes de seguimiento
      followers.forEach((follower) => {
        template += `<div class="d-flex justify-content-between">
        <span>Solicitud de Seguimiento de <a class=" " href="/seguidor?id=${follower.id}">${follower.username}</a></span>
        <i class="fa-solid fa-xmark m-2"></i>
        <button type="button" onclick="accept_request_follower(${follower.id_request});" class="btn btn-primary m-2">Aceptar</button>
        <button type="button" onclick="reject_request_follower(${follower.id_request});" data-bs-dismiss="modal" class="btn btn-danger m-2">Denegar</button>
      </div>  <hr/>`
      })
      wrap__notifications.innerHTML = template
      deleteNotifications()
    })
  }
}

function accept_request_follower(id_request) {
  $.post(
    'http://127.0.0.1:8080/api/accept-follower',
    { id_request },
    (response) => {
      if (response) {
        Swal.fire('Nuevo Seguidor', '', 'success')
        showFriends()
        getRequestsFollow()
      }
    },
  )
}

function reject_request_follower(id_request) {
  let url = 'http://127.0.0.1:8080/api/accept-reject'
  if (id_request != null) {
    $.post(url, { id_request }, (response) => {
      if (response) {
        getRequestsFollow()
      }
    })
  }
}

function send_request_friend(receiver) {
  if (receiver != null) {
    $.post(
      'http://127.0.0.1:8080/api/send-resquest-friend',
      { receiver },
      (response) => {
        Swal.fire(response)
      },
    )
  }
}

function search_profile() {
  if (document.querySelector('#search_profile') != null) {
    const btn__search__friends = document.querySelector('#btn__search__friends')
    btn__search__friends.classList.add('d-none')

    const search_profile = document.querySelector('#search_profile')
    search_profile.addEventListener('keyup', (element) => {
      let search = search_profile.value.trim()

      if (search.length >= 3) {
        btn__search__friends.classList.remove('d-none')
        btn__search__friends.classList.add('show')
      } else {
        btn__search__friends.classList.add('d-none')
      }

      $.ajax({
        //get obtener algo y post para enviar
        url: 'http://127.0.0.1:8080/api/search-friends-for-name',
        type: 'POST',
        data: { search },
        success: (response) => {
          if (!response.error) {
            if (response != null) {
              let profiles = JSON.parse(response)
              let noFollower = false
              let template = ''
              profiles.forEach((profile) => {
                console.log(profile)
                let id = profile.id
                $.post(
                  'http://127.0.0.1:8080/api/check-request-follower',
                  { id },
                  (response) => {
                    template += `<div class="d-flex flex-column align-items-center ">
                                  <img src="/build/img/${profile.avatar}" class="img-responsive w-10" alt="avatar" />
                                  <span>ID: ${profile.id}</span>
  
                                  <span class="w-75 text-center">Nombre: <span class="text-primary">${profile.username}</span></span>`

                    if (profile.description != null) {
                      template += `
                              <span class="w-75 text-center">Descripción: <span class="text-primary">${profile.description}</span></span>`
                    }

                    if (profile.rol != null) {
                      template += `
                              <span class="w-75 text-center">Rol: <span class="text-primary">${profile.rol}</span></span>`
                    }

                    template += ` <a href="/seguidor?id=${profile.id}">Ver perfil</a>`
                    const checkFollower = JSON.parse(response)
                    if (checkFollower != null) {
                      if (checkFollower.isAccept != null) {
                        if (checkFollower.isAccept == 1) {
                          template += `<button type="button"  class="btn btn-primary my-2">
                                      Seguido
                                      </button>
                                      <hr/>`
                        } else {
                          template += `<button type="button"  onclick="send_request_friend(${profile.id});" 
                                    class="btn request_friends btn-secondary my-2">
                                      Pendiente
                                    </button>
                                    <hr/>`
                        }
                      }
                    } else {
                      noFollower = true
                    }

                    if (noFollower) {
                      template += `<button type="button"  onclick="send_request_friend(${profile.id});" 
                            class="btn request_friends btn-secondary my-2">
                                      Seguir
                            </button>
                        <hr/>`
                    }
                    noFollower = false
                    template += `</div>`
                    $('#content__profiles').html(template)
                  },
                )
              })
            }
          }
        },
      })
    })
  }
}

function send_response_comment() {
  let url = 'http://127.0.0.1:8080/api/send_response_comment'

  let currentURL = window.location.href

  const response = document.querySelectorAll('.toogle_response')
  response.forEach((element) => {
    element.addEventListener('click', () => {
      const id_comment_response = element.dataset.id

      $('.response_comment').submit((e) => {
        e.preventDefault()

        let post_id = document.querySelector('#container_post').dataset.id

        const data = {
          id_comment_response: id_comment_response,
          content: $('#content').val(),
          post_id: post_id,
        }

        $.post(url, data, (response) => {
          window.location.href = currentURL
        })
      })
    })
  })
}

function deletePost() {
  $(document).on('click', '#delete_post', (element) => {
    if (confirm('¿Seguro que quieres eliminar este post?')) {
      let id_element = element.target.dataset.id
      $.post(
        'http://127.0.0.1:8080/api/post/delete',
        { id_element },
        (response) => {
          listPosts()
        },
      )
    }
  })
}

function update_post() {
  $(document).on('click', '#update_post', (element) => {
    let id_element = element.target.dataset.id
    window.location.href = `http://127.0.0.1:8080/modificar-post?id=${id_element}`
  })
}

function deleteFriend() {
  $(document).on('click', '.delete_friend', (element) => {
    if (confirm('¿Estas seguro que quieres eliminar este seguidor?')) {
      let id_element =
        element.target.parentElement.parentElement.children[2].textContent

      $.post(
        'http://127.0.0.1:8080/api/friends/delete',
        { id_element },
        (response) => {
          showFriends()
        },
      )
    }
  })
}

function close_activity_perfil() {
  const close_activity_perfil = document.querySelector('#close_activity_perfil')
  const activity_perfil = document.querySelectorAll('.activity_perfil')

  if (close_activity_perfil != null) {
    close_activity_perfil.addEventListener('click', function () {
      activity_perfil.forEach((element) => {
        element.classList.toggle('d-none')
        if (element.classList.contains('d-none')) {
          close_activity_perfil.textContent = 'mostrar'
        } else {
          close_activity_perfil.textContent = 'ocultar'
        }
      })
    })
  }
}

async function showFriends() {
  let currentURL = window.location.pathname

  if (currentURL == '/seguidores') {
    try {
      const url = 'http://127.0.0.1:8080/api/friends'
      const result = await fetch(url)

      const friends = await result.json()
      createFriendsList(friends[1], friends[0])
    } catch (error) {
      console.log(error)
    }
  }
}

function copyToClipboard() {
  const share = document.querySelector('.share')
  let url = share.dataset.text

  share.addEventListener('click', () => {
    navigator.clipboard.writeText(url).then(() => {
      Swal.fire('Copiado correctamente')
    })
  })
}

async function listPosts() {
  let currentURL = window.location.pathname

  if (currentURL == '/posts' || currentURL == '/perfil') {
    try {
      const url = 'http://127.0.0.1:8080/api/posts'
      const result = await fetch(url)

      const posts = await result.json()
      const wrap_articles = document.querySelector('#wrap-articles')

      template = ''

      if (posts.length > 0) {
        posts.forEach((post) => {
          let url = `https://www.youtask.es/post?id=${post.id}`
          template += `
                    <article class="wrap-article m-2 d-flex flex-column">
                        
                        <div class="align-self-end">
                            <button id="update_post" data-id="${
                              post.id
                            }" type="button" class="btn  my-2 btn-primary text-right text-end  " >Modificar</button>
                            <button id="delete_post" data-id="${
                              post.id
                            }" type="button" class="btn  my-2 btn-danger text-right text-end" >Eliminar</button>
                            
                        </div>
                        
                        
                        <span class="text-right d-block w-100 text-end">${
                          post.create_at
                        }</span>
                        <h3><a class="text-decoration-none text-dark text-capitalize" href="/post?id=${
                          post.id
                        }">${post.name}</a></h3>
                        <p>
                            ${post.content.substring(0, 500)}


                            <a  href="/post?id=${
                              post.id
                            }"><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="19" cy="12" r="1"></circle>
                                    <circle cx="5" cy="12" r="1"></circle>
                                </svg></a>
                            </span>
                        </p>
                        <div>
                            <div class="d-flex post-actions">
                                
                                <a href="javascript:;" class="d-flex mx-2 align-items-center text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share icon-md">
                                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                        <polyline points="16 6 12 2 8 6"></polyline>
                                        <line x1="12" y1="2" x2="12" y2="15"></line>
                                    </svg>
                                    <p class="d-none share d-md-block ml-2" data-text="${url}" onclick="copyToClipboard();">Compartir</p>
                                </a>
                            </div>
                        </div>
                    </article>
                    <hr/>
                    `
        })
      } else {
        template = `<div><span>No hay artículos</span></div>`
      }

      if (location.pathname === '/perfil') {
        template += ` 
                <div class="d-flex justify-content-center mt-5">
                    <button class="btn btn-secondary" onclick="window.location.href='/posts'">Ver más</button>
                </div>
                `
      }

      wrap_articles.innerHTML = template
    } catch (error) {
      console.log(error)
    }
  }
}

function createFriendsList(friends, count) {
  const container_friends = document.querySelector('#container_friends') ?? 0
  const countFriends = document.querySelector('#countFriends') ?? 0

  countFriends.textContent = 'Lista de seguidores (' + count + ')'

  let template = ''

  if (friends.length > 0) {
    friends.forEach((friend) => {
      template += `
            <div class="col-12 col-md-5 border rounded shadow m-2">
                <div class="row">
                    <div class="col-3" id="">
                        <img id="avatar" src="/build/img/${friend.avatar}" alt="avatar" srcset="" class="img-fluid m-2">
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center">
                        <span id="friend_username">${friend.username}</span>
                    </div>
                    <div class="col-5 d-flex">
                        <nav class="navbar navbar-expand-sm">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Acciones
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="/seguidor?id=${friend.id}">Ver Perfil</a></li>
                                        <li><a class="dropdown-item delete_friend" href="#">Eliminar</a></li>
                                        <li class="d-none">${friend.id}</li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Enviar mensaje</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            `
    })
  } else {
    template = `<p class="text-center text-danger">No tienes seguidores agregados</p>`
  }

  container_friends.innerHTML = template
}

function showCreateProject() {
  const create_project = document.querySelector('#create_project')
  const wrap_initials = document.querySelector('#wrap_initials')
  const wrap_create_project = document.querySelector('#wrap_create_project')

  if (document.querySelector('#create_project') != null) {
    if (create_project != null) {
      create_project.addEventListener('click', () => {
        wrap_initials.remove()
        wrap_create_project.classList.add('show_wrap_create_project')
      })
    } else {
      wrap_create_project.classList.add('show_wrap_create_project')
    }
  } else {
    if (document.querySelector('#wrap_create_project') != null) {
      wrap_create_project.classList.add('show_wrap_create_project')
    }
  }
}

function checkPassword() {
  const password = document.querySelector('#password')
  const repeatPassword = document.querySelector('#repeatPassword')
  const btn_register = document.querySelector('#btn-register')
  const privacity = document.querySelector('#privacity')

  if (privacity != null) {
    privacity.addEventListener('change', function () {
      if (privacity.checked) {
        if (password.value == repeatPassword.value) {
          btn_register.classList.toggle('d-flex')
        }
      }
    })
  }
}

function checkAlerts() {
  if (document.querySelectorAll('.alerts')) {
    const alerts = document.querySelectorAll('.alerts')
    alerts.forEach((alert) => {
      setTimeout(() => {
        alert.remove()
      }, 6000)
    })
  }
}

function showMenuResponse() {
  const burger = document.querySelector('.fa-bars')
  const nav__menu = document.querySelector('.nav__menu')
  const nav__list = document.querySelector('.nav__list')

  if (burger != null) {
    burger.addEventListener('click', () => {
      nav__menu.classList.toggle('d-flex')
      nav__list.classList.toggle('flex-column')
    })
  }
}
