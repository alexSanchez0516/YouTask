document.addEventListener('DOMContentLoaded', function () {
  let currentURL = window.location.pathname
  destroyCookies()

  checkPassword()
  checkAlerts()
  showMenuResponse()
  showCreateProject()
  close_activity_perfil()
  deleteFriend()
  listPosts()
  deletePost()
  update_post()
  send_response_comment()
  getRequestsFollow()
  storage()
  previewImg()

  if (currentURL == '/calendario') {
    buildEvents();
  }

  if (currentURL == '/seguidores') {
    showFriends()
    search_profile()
  }

  if (currentURL == '/editar-perfil') {
    getSkills()
  }
  if (currentURL == '/mensajes') {
    showContacts()
  }
  if (currentURL == '/proyectos') {
    getProjectsPaginate()
    getEntityByName('Projects')
  }

  if (currentURL == '/proyecto') {
    buildMembers()
    getMessagesProjects()
    getListByProject()
    loadBtnUploadFileProject()
    searchMembers()
    getTasksPaginate()
    getEntityByName('Tasks')

    setInterval(() => {
      getMessagesProjects()
    }, 9500)
  }

  if (currentURL == '/tareas') {
    getTasksPaginate()
    getEntityByName('Tasks')
  }

  if (currentURL == '/tarea') {
    loadBtnUploadFileProject()
    showMessagesTask()
    setInterval(() => {
      showMessagesTask()
    }, 9500)
  }

  if (currentURL == '/miembros-proyecto') {
    searchMembers()
    getAllMembersProject()
  }
})

async function showMessagesTask() {
  let url = 'https://youtask.es/api/showMessagesTask'
  const data = new FormData()
  let id_task = getParameterByName('id')
  data.append('id_task', id_task)

  try {
    const request = await fetch(url, {
      method: 'POST',
      body: data,
    })

    const response = await request.json()
    buildMessagesTask(response)
  } catch (error) {
    console.log(error)
  }
}

function buildMessagesTask(messages) {
  let template = ''
  const container__msgs_task = document.querySelector('#container__msgs_task')
  messages.forEach((message) => {
    template += `
    <li class="mt-4">
        <div class="media activity-item d-flex">
            <a href="#" class="pull-left w-20">
                <img src="/build/img/${message.avatar}" alt="Avatar" class="w-50 avatar rounded-circle m-2">
            </a>
            <div class="media-body">
                <strong>${message.username}</strong><br>
                <small class="text-muted">${message.create_at}</small>
                <a title="Eliminar" data-id="${message.id}" class="btn btn-link text-danger btn-remove"><i onclick="deleteCommentTask(${message.id});" class="fa-solid fa-trash-can"></i></a>
                <div class="well bg-messages_response rounded p-2">
                    ${message.msg}
                </div>
            </div>
        </div>
    </li>
    
    `
  })
  container__msgs_task.innerHTML = template
}

async function sendMessageTask() {
  const data = new FormData()
  let url = 'https://youtask.es/api/sendCommentChat'
  let id_task = getParameterByName('id')
  data.append('id_task', id_task)
  const msgTask = document.querySelector('#msgTask').value
  if (validateMessage(msgTask)) {
    data.append('msg', msgTask)

    try {
      const request = await fetch(url, {
        method: 'POST',
        body: data,
      })

      const response = await request.json()

      if (!response) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '¡Ha ocurrido un error!',
        })
      } else {
        Swal.fire('Enviado correctamente', '', 'success')
        $('#msgTask').val('')
        showMessagesTask()
      }
    } catch (error) {
      console.log(error)
    }
  }
}

function validateMessage(message) {
  if (message.trim().length > 0) {
    return true
  }
  return false
}

/**
 * @param mixed id_user
 *
 * @return [type]
 */
async function dissmisAdmin(id_user) {
  let url = 'https://youtask.es/api/dismisAdminByProject'
  const data = new FormData()
  let id_project = getParameterByName('id')
  data.append('id_project', id_project)
  data.append('id_user', id_user)

  const result = await Swal.fire({
    title: 'Eliminar',
    text: '¿Estás seguro de que ya no sea admnistrador?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#1f9bcf',
    cancelButtonColor: '#d9534f',
    cancelButtonText: 'No',
    confirmButtonText: 'Si',
  })

  // Stop if user did not confirm
  if (!result.value) {
    return
  }

  try {
    const request = await fetch(url, {
      method: 'POST',
      body: data,
    })

    const response = await request.json()

    if (!response) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '¡Ha ocurrido un error!',
      })
    } else {
      Swal.fire('Convertido en colaborador', '', 'success')
      getAllMembersProject()
    }
  } catch (error) {
    console.log(error)
  }
}
/**
 * @param mixed receiver
 *
 * @return [type]
 */
async function dataMessageGeneral(receiver) {
  let url = 'https://youtask.es/api/chat/app/send-message'

  const send_msg_members_page = document.querySelector('#send_msg_members_page')
  $('#send_msg_members_page').click((event) => {
    event.preventDefault()
    event.stopImmediatePropagation() //evitar que se repita el evento
    if ($('#msg_page_members').val().length > 0) {
      $.post(
        url,
        { receiver: receiver, message: $('#msg_page_members').val() },
        (response) => {
          if (!response) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: '¡Ha ocurrido un error!',
            })
          } else {
            Swal.fire('Mensaje enviado correctamente', '', 'success')
          }

          $('#msg_page_members').val('')
        },
      )
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '¡Texto vacio!',
      })
    }
  })
}

/**
 * @param mixed id_user
 *
 * @return [type]
 */
async function converAdmin(id_user) {
  try {
    const result = await Swal.fire({
      title: 'Eliminar',
      text: '¿Estás seguro de que quieres hacerle admnistrador?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#1f9bcf',
      cancelButtonColor: '#d9534f',
      cancelButtonText: 'No',
      confirmButtonText: 'Si',
    })

    // Stop if user did not confirm
    if (!result.value) {
      return
    }

    let url = 'https://youtask.es/api/insertAdminByProject'
    const data = new FormData()
    let id_project = getParameterByName('id')
    data.append('id_user', id_user)
    data.append('id_project', id_project)

    const request = await fetch(url, {
      method: 'POST',
      body: data,
    })

    const response = await request.json()

    if (!response) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '¡Ha ocurrido un error!',
      })
    } else {
      Swal.fire('Convertido en administrador', '', 'success')
      getAllMembersProject()
      //window.location.reload()
    }
  } catch (error) {
    console.log(error)
  }
}

/**
 * @param mixed id_user
 *
 * @return [type]
 */
async function deleteMemberProject(id_user) {
  await deleteAny(id_user, 'Members_Projects')
  window.location.reload()
}

/**
 * @return [type]
 */
function getAllMembersProject() {
  let template = ''
  let id = getParameterByName('id')
  const teams__container = document.querySelector('#container__members__pag')
  let adminID = Number(teams__container.getAttribute('data-id'))
  const current_id_user = document.querySelector('#current_id_user')
  let current_id_user_val = Number(current_id_user.getAttribute('data-id'))
  const title_team = document.querySelector('#title_team')
  const members = getMembers(id).then((data) => {
    data.forEach((member) => {
      template += `
      <div class="col-lg-4 col-md-6">
                <div class="team-item">
                    <div class="team-img">
                        <img src="/build/img/${member.avatar}" alt="team Image">
                        <div class="normal-text">
                            <h4 class="team-name">${member.username}</h4>
                            <span class="subtitle">${
                              member.id_admin != null
                                ? 'Administrador'
                                : member.id == adminID
                                ? 'Creador'
                                : 'Colaborador'
                            }</span>
                        </div>
                    </div>
                    <div class="team-content">
                        <div class="display-table">
                            <div class="display-table-cell">
                                <div class="share-icons">
                                    <div class="border"></div>
                                    <ul class="team-social icons-1">

                                    `

      current_id_user_val != member.id
        ? (template += ` 
                                        <li><a onclick="dataMessageGeneral(${member.id});" title="Enviar mensaje" data-bs-toggle="modal" data-bs-target="#modal_send_message" class="social-icon"><i class="fa-solid fa-message"></i></a>
                                        </li> 
      `)
        : ''
      template += `
                                        <li><a href="/seguidor?id=${member.id}" title="Ver Perfil" class="social-icon"><i class="fa-solid fa-magnifying-glass"></i></a>
                                        </li>
                                    </ul>

                                    <ul class="team-social icons-2">
                                        <li><a  onclick='deleteMemberProject(${member.id})' title="Eliminar Integrante" class="social-icon"><i class="fa-solid fa-trash-can"></i></a>
                                        </li>
                                        
                                       `

      member.id_admin != null
        ? (template += `
        <li><a onclick="dissmisAdmin(${member.id})" title="Quitar administrador" class="social-icon"><i class="fa-solid fa-user-minus"></i></a>
        </li>

        `)
        : member.id == adminID
        ? ''
        : (template += `
        <li><a onclick="converAdmin(${member.id})" title="Convertir en administrador" class="social-icon"><i class="fa-solid fa-plus"></i></a>
        </li>

        `)

      template += `
                                    </ul>
                                </div>
                                <div class="team-details">
                                    <h4 class="team-name mt-2">
                                        <a href="speakers-single.html">${title_team.textContent}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      
      `
    })
    teams__container.innerHTML = template
  })
}

/**
 * @return [type]
 */

/**
 * @return [type]
 */

/**
 * @param mixed id
 *
 * @return [type]
 */
async function deleteCommentProject(id) {
  await deleteAny(id, 'msgProjects')
  getMessagesProjects()
}

async function deleteCommentTask(id) {
  await deleteAny(id, 'msgTask')
  showMessagesTask()
}

/**
 * @param mixed id_user
 *
 * @return [type]
 */
async function sendInvitationProject(id_user) {
  const data = new FormData()
  let url = 'https://youtask.es/api/sendInvitationProject'
  let id_project = getParameterByName('id')

  data.append('id_project', id_project)
  data.append('id_user', id_user)

  const request = await fetch(url, {
    method: 'POST',
    body: data,
  })

  const response = await request.json()

  if (!response) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '¡Ya tiene una invitacion pendiente!',
    })
  } else {
    Swal.fire('Invitacion enviada correctamente', '', 'success')
    getMembers(id_project)
  }
}

/**
 * @return [type]
 */
function searchMembers() {
  const member_project = document.querySelector('#member_project')
  const data = new FormData()
  let url = 'https://youtask.es/api/getFriendsNotMembersByGroup'
  let id_project = getParameterByName('id')
  let template = ''
  //content__profiles

  $('#member_project').keyup(() => {
    let nameSearch = $('#member_project').val()

    $.ajax({
      //get obtener algo y post para enviar
      url: url,
      type: 'POST',
      data: { id_project, nameSearch },
      success: (response) => {
        if (!response.error) {
          template = ''
          $('#content__profiles').html(template)
          const result = JSON.parse(response)

          result.forEach((profile) => {
            template += `<div class="d-flex flex-column align-items-center ">
            <img src="/build/img/${profile.avatar}" class="img-responsive rounded-circle w-20" alt="avatar" />
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
            template += `<button type="button" onclick="sendInvitationProject(${profile.id});" class="btn btn-primary my-2">
                                      Invitar
                                      </button>
                                      <hr/>`
          })
          $('#content__profiles').html(template)
        }
      },
    })
  })
}

/**
 * @return [type]
 */
function loadBtnUploadFileProject() {
  const data = document.querySelector('#image_avatar') // es el input del file de project
  bnt__upload__Files = document.querySelector('#bnt__upload__Files')

  data.addEventListener('change', (event) => {
    const files = data.files
    const files_parse = Array.from(files)

    if (files_parse.length > 0) {
      files_parse.forEach((file) => {
        if (file.size > 3145728) {
          //comprueba si es superior a 3 mb
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡Te excedes en tamaño(3MB MAX)!',
          })
          return
        } else {
          bnt__upload__Files.classList.add('show')
          console.log('add')
        }
      })
    }
  })
}

/**
 * @param mixed nameFile
 *
 * @return [type]
 */
async function deleteFileByProject(nameFile) {
  let url = 'https://youtask.es/api/deleteFileByProject'
  const data = new FormData()
  let idProject = getParameterByName('id')
  data.append('name', nameFile)
  data.append('id', idProject)

  const result = await Swal.fire({
    title: 'Eliminar',
    text: '¿Estás seguro de que quieres eliminar este item?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#1f9bcf',
    cancelButtonColor: '#d9534f',
    cancelButtonText: 'No',
    confirmButtonText: 'Si, eliminarlo',
  })

  // Stop if user did not confirm
  if (!result.value) {
    return
  }
  const request = await fetch(url, {
    method: 'POST',
    body: data,
  })

  const response = await request.json()

  if (!response) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '¡Algo salió mal!',
    })
  } else {
    let timerInterval
    await Swal.fire({
      title: 'Eliminando',
      html: 'Se está eliminando, por favor espere',
      timer: 1000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
          b.textContent = Swal.getTimerLeft()
        }, 1000)
      },
      willClose: () => {
        clearInterval(timerInterval)
      },
    }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer')
      }
    })

    window.location.href = window.location.href //descartamos post
  }
}

function validateDataTask() {
  let valid = true
  const data = new FormData()
  let name_task = document.querySelector('#name__task__by__project').value
  let description__task = document.querySelector(
    '#description__task__by__project',
  ).value
  let priority__task = document.querySelector('#pririty__task__by__project')
    .value
  let projectID = document.querySelector('#projectID').value
  let create_end_task__by__project = document.querySelector(
    '#create_end_task__by__project',
  ).value

  let adminID = document.querySelector('#adminID').value
  console.log(adminID)

  if (name_task.trim().length < 3) {
    valid = false
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '¡Nombre invalido!',
    })
  }

  if (description__task.trim().length < 3) {
    valid = false
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Descripción inválida!',
    })
  }
  if (valid) {
    data.append('name', name_task)
    data.append('description', description__task)
    data.append('priority', priority__task)
    data.append('projectID', projectID)
    data.append('date_end', create_end_task__by__project)
    data.append('adminID', adminID)
    sendTaskByProject(data)
  }
}

async function sendTaskByProject(formdata) {
  let url = 'https://youtask.es/api/addTaskByProject'
  const request = await fetch(url, {
    method: 'POST',
    body: formdata,
  })

  const response = await request.json()

  if (!response) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '¡Algo salió mal!',
    })
  } else {
    Swal.fire('Creado correctamente', '', 'success')
    getListByProject()
  }

  console.log(response)
}

/**
 * METODO QUE RECOGE LOS DATOS DEL MODAL Y
 * LO MANDA A LA API PARA SALVARLOS
 * @return [type]
 */
async function sendMessagesProject() {
  let msg = document.querySelector('#msg_project').value
  let url = 'https://youtask.es/api/sendMessageProject'
  let project_id = getParameterByName('id')
  const data = new FormData()

  data.append('msg', msg)
  data.append('project_id', project_id)

  const request = await fetch(url, {
    method: 'POST',
    body: data,
  })

  const response = await request.json()

  if (!response) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '¡Algo salió mal!',
    })
  } else {
    getMessagesProjects()
  }
}

/**
 * METODO PARA PINTAR LOS Mensajes JUNTO A SUS DATA-ID
 * @return [type]
 */
async function getMessagesProjects() {
  let url = 'https://youtask.es/api/getMessagesProjects'
  const data = new FormData()
  let id = Number(getParameterByName('id'))
  data.append('id', id)

  const request = await fetch(url, {
    method: 'POST',
    body: data,
  })

  const response = await request.json()
  buildMessageProject(response)
}

/**
 * @param array messages
 *
 * @return [type]
 */
function buildMessageProject(messages) {
  const project__msg__list = document.querySelector('#project__msg__list')
  let template = '<h3 class="text-center">Mensajes</h3>'
  messages.forEach((message) => {
    template += `
    <li class="mt-4">
        <div class="media activity-item d-flex">
            <a href="#" class="pull-left w-20">
                <img src="/build/img/${message.avatar}" alt="Avatar" class="w-50 avatar rounded-circle m-2">
            </a>
            <div class="media-body">
                <strong>${message.username}</strong><br>
                <small class="text-muted">${message.create_at}</small>
                <a title="Eliminar" data-id="${message.id}" class="btn btn-link text-danger btn-remove"><i onclick="deleteCommentProject(${message.id});" class="fa-solid fa-trash-can"></i></a>
                <div class="well bg-messages_response rounded p-2">
                    ${message.msg}
                </div>
            </div>
        </div>
    </li>
    
    `
  })
  project__msg__list.innerHTML = template
}

/**
 * METODO PARA PINTAR DESDE LA API EL TODO LIST Y
 * ASINAR SU CORRESPONDIENTE DATA-ID
 * @return [type]
 */
async function deleteListProject(id) {
  await deleteAny(id, 'Tasks')
  getListByProject()
}

async function getListByProject() {
  let id = getParameterByName('id')
  let url = 'https://youtask.es/api/to-do-list'
  const data = new FormData()
  data.append('id', id)

  const request = await fetch(url, {
    method: 'POST',
    body: data,
  })

  const response = await request.json()
  buildTodoList(response)
}

function buildTodoList(tasks) {
  const task_filter = tasks.filter((task) => task.state === 'EN PROCESO')
  let template = ''
  const todo__list = document.querySelector('#todo__list')

  task_filter.forEach((task) => {
    template += `
    <li>
        <a class="text-dark" href="/tarea?id=${task.id}"><span class="todo-text"><i class="mx-2 my-2 fa-solid fa-list-check"></i>${task.name}</span></a>
    </li>

    `
  })
  todo__list.innerHTML = template
}

async function showContacts() {
  const container__users = document.querySelector('#container__users')

  try {
    const url = 'https://youtask.es/api/friends'
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

  follower__contacts.forEach((contact) => {
    contact.addEventListener('click', (e) => {
      //llamamos al metodo que refresca mensajes de
      setMessages(contact, 0)
      setInterval(() => {
        setMessages(contact, 0)
      }, 20500)
    })
  })
}

function setMessages(contact, execution) {
  const selected_user = document.querySelector('#selected-user') //text-content
  const chat__box__container = document.querySelector('#chat__box__container')

  let template = ''

  chat__box__container.innerHTML = template

  $('#msg').val('')
  //pasar id del usuario selected
  //buscar los msg del usuario actual con dicho seleccionado
  if (execution != contact.dataset.chat) {
    let idSelected = Number(contact.getAttribute('data-chat'))

    let url_api = 'https://youtask.es/api/chat/app'
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
                <li class="chat-right d-flex flex-column flex-md-row flex p-2 bg-messages_response border rounded justify-content-end my-2">
                    <div class="chat-text d-flex flex-column align-items-center justify-content-center w-100">
                      <span>${msg.create_at}</span>
                      <p class="m-2">${msg.msg}</p>
                    </div>
                    <div class="chat-avatar mx-5 w-50">
                        <img src="${image_avatar}" class="raidius_max w-50" alt="Retail Admin">
                        <p class="chat-name">${name_users_on_chat}</p>
                    </div>
                </li>
            `
        } else {
          template += `
            <li class="chat-left d-flex flex-column flex-md-row flex align-items-center bg-messages_sender border rounded p-2 my-2">
                <div class="chat-avatar w-50">
                    <img src="${image_avatar}"  class="raidius_max w-50" alt="Retail Admin">
                    <p class="chat-name">${name_users_on_chat}</p>
                </div>
                <div class="chat-text d-flex flex-column mb-2 mx-2 w-100">
                  <span>${msg.create_at}</span>
                  <p class="m-2">${msg.msg}</p>
                </div>
            </li>
             `
        }
        template += `<hr />`
      })

      execution = contact.dataset.chat
      chat__box__container.setAttribute('data-id', contact.dataset.chat)
      chat__box__container.innerHTML = template
      $('#send_message').addClass('show')
    })
  }
}

function sendMessage(message) {
  const receiver = $('#chat__box__container').attr('data-id')
  $.post(
    'https://youtask.es/api/chat/app/send-message',
    { receiver, message },
    (response) => {
      const dataID = document
        .querySelector('#chat__box__container')
        .getAttribute('data-id')
      const follower__contacts = document.querySelectorAll('.follower__contact')

      follower__contacts.forEach((contact) => {
        if (contact.getAttribute('data-chat') == dataID) {
          setMessages(contact, 0)
        }
      })
    },
  )
}

function createSkill() {
  let skill = $('#skill_name').val()
  console.log(skill)
  const btn_close_skill_user = document.querySelector('#btn_close_skill_user')
  const skills_data = document.querySelector('#skills_data')

  $.post('https://youtask.es/api/create-skill', { skill }, (response) => {
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
  $.get('https://youtask.es/api/get-skills', (response) => {
    const skills = JSON.parse(response)

    skills.forEach((skill) => {
      $.post(
        'https://youtask.es/api/check-skill',
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

/**
 * @return [type]
 */
function getRequestsFollow() {
  const rutesNoProtected = ['/', '/inicio', '/login', '/registro', '/contacto']

  let currentURL = window.location.pathname

  const found = rutesNoProtected.find((r) => r == currentURL)
  if (found == undefined) {
    let url = 'https://youtask.es/api/show-requests-followers'
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

/**
 * @param String name
 * @return String
 */
function getParameterByName(name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]')
  var regex = new RegExp('[\\?&]' + name + '=([^&#]*)'),
    results = regex.exec(location.search)
  return results === null
    ? ''
    : decodeURIComponent(results[1].replace(/\+/g, ' '))
}

async function getEntityByName(entity) {
  const data = new FormData()

  $('#search').keyup(() => {
    if ($('#search').val()) {
      let search = $('#search').val()
      console.log(search)
      if (entity === 'Projects') {
        getProjectsPaginate(null, search)
      } else {
        getTasksPaginate(null, search)
      }
    }
  })
}

/**
 * @param null filter
 * @param null value
 *
 * @return [type]
 */
async function getProjectsPaginate(filter = null, value = null) {
  const data = new FormData()
  let url = 'https://youtask.es/api/get-projects-paginate'
  let page = getParameterByName('page')
  let limit = getParameterByName('limit')

  if (filter != null) {
    data.append('filter', filter)
  }
  if (value != null) {
    data.append('value', value)
  }

  data.append('page', page)
  data.append('limit', limit)

  const response = await fetch(url, {
    method: 'POST',
    body: data,
  })
  const results = await response.json()
  buildProjects(results.data)
}

/**
 * @param null filter
 * @param null value
 *
 * @return object
 */
async function getTasksPaginate(filter = null, value = null) {
  let currentURL = window.location.pathname

  const data = new FormData()
  let url = 'https://youtask.es/api/get-tasks-paginate'
  let page = getParameterByName('page')
  let limit = getParameterByName('limit')

  let id_project = 0

  if (currentURL == '/proyecto') {
    id_project = getParameterByName('id')
    data.append('id_project', id_project)
  }

  if (filter != null) {
    data.append('filter', filter)
  }
  if (value != null) {
    data.append('value', value)
  }

  data.append('page', page)
  data.append('limit', limit)

  const response = await fetch(url, {
    method: 'POST',
    body: data,
  })
  const results = await response.json()
  buildTasks(results.data)
}

async function checkAdminOrCreator() {}

async function deleteAny(id, table) {
  //comprobar si es admin o creator

  /*
  let url_check = 'https://youtask.es/api/checkAdminOrCreator'
  let currentURL = window.location.pathname
  const data_check = new FormData()

  if (currentURL == '/proyectos') {
    data_check.append('id_project', id)
  } else {
    if (currentURL == '/tareas') {
      data_check.append('id_task', getParameterByName('id'))
    }
  }

  const request_check = await fetch(url_check, {
    method: 'POST',
    body: data_check,
  })

  const response = await request_check.json()

  console.log(response)
  */

  if (true) {
    const data = new FormData()
    let url = 'https://youtask.es/api/delete'

    let currentURL = window.location.pathname
    data.append('table', table)
    if (currentURL == '/miembros-proyecto') {
      data.append('id_user', id)
    } else {
      data.append('id', id)
    }

    //console.log(...data)
    const result = await Swal.fire({
      title: 'Eliminar',
      text: '¿Estás seguro de que quieres eliminar este item?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#1f9bcf',
      cancelButtonColor: '#d9534f',
      cancelButtonText: 'No',
      confirmButtonText: 'Si, eliminarlo',
    })

    // Stop if user did not confirm
    if (!result.value) {
      return
    }
    const request = await fetch(url, {
      method: 'POST',
      body: data,
    })

    const response = await request.json()

    if (response) {
      Swal.fire('Eliminado correctamente', '', 'success')
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '¡Algo salió mal!',
      })
    }
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '¡No eres administrador!',
    })
  }

  /*
  
  */
}

function buildTasks(tasks) {
  let template = ''
  const content__tasks = document.querySelector('#content__tasks')

  tasks.forEach((task) => {
    if (task != null) {
      template += `
      <tr>
      `
      if (task.priority == 'ALTA') {
        template += `<td class="bg-danger text-white border rounded">${task.priority}</td>`
      }
      if (task.priority == 'BAJA') {
        template += `<td class="bg-primary text-white border rounded">${task.priority}</td>`
      }
      if (task.priority == 'MEDIA') {
        template += `<td class="bg-secondary text-white border rounded">${task.priority}</td>`
      }

      template += `<td>${task.name}</td>`

      if (task.state == 'EN PROCESO') {
        template += `<td class="bg-secondary text-white border rounded">${task.state}</td>`
      }
      if (task.state == 'REALIZADO') {
        template += `<td class="bg-success text-white border rounded">${task.state}</td>`
      }
      if (task.state == 'CANCELADO') {
        template += `<td class="bg-danger text-white border rounded">${task.state}</td>`
      }

      template += `<td class="bg-success text-white border rounded">${task.Project}</td>`

      template += `
      <td>${task.date_end}</td>
      <td id="delete__task" onclick="deleteTask(${task.id});" class="mx-2 btn btn-danger bg-danger border rounded"><i class="fa-solid fa-trash-can"></i></td>
      <td class="btn btn-danger bg-primary border rounded"><a href="/tarea?id=${task.id}" class="text-white"><i class="fa-solid fa-pen-to-square"></i></a></td>

      </tr>`
    }
  })

  content__tasks.innerHTML = template
}

async function deleteTask(id) {
  await deleteAny(id, 'Tasks')
  getTasksPaginate()
}
async function deleteProject(id) {
  await deleteAny(id, 'Projects')
  getProjectsPaginate()
}

function buildProjects(projects) {
  let template = ''
  let templateIMG = ''
  const content_projects = document.querySelector('#content_projects')
  let url = 'https://youtask.es/api/getMembersByProject'

  projects.forEach((project) => {
    if (project != null) {
      template += `
      <tr>
      `
      if (project.priority == 'ALTA') {
        template += `<td class="bg-danger text-white border rounded">${project.priority}</td>`
      }
      if (project.priority == 'BAJA') {
        template += `<td class="bg-primary text-white border rounded">${project.priority}</td>`
      }
      if (project.priority == 'MEDIA') {
        template += `<td class="bg-secondary text-white border rounded">${project.priority}</td>`
      }

      template += `<td>${project.name}</td>`

      if (project.state == 'EN PROCESO') {
        template += `<td class="bg-secondary text-white border rounded">${project.state}</td>`
      }
      if (project.state == 'REALIZADO') {
        template += `<td class="bg-success text-white border rounded">${project.state}</td>`
      }
      if (project.state == 'CANCELADO') {
        template += `<td class="bg-danger text-white border rounded">${project.state}</td>`
      }

      template += `
              <td class=" w-10 text-white border rounded">
                <a href="/seguidor?id=${project.userID}">
                  <img class="rounded-circle w-75 img-responsive" src="/build/img/${project.avatar}">
                  </img>
                </a>
              </td>`

      template += `
      <td>${project.date_end}</td>
      <td id="delete__project" onclick="deleteProject(${project.id});" class="mx-2 btn btn-danger bg-danger border rounded"><i class="fa-solid fa-trash-can"></i></td>
      <td class="btn btn-danger bg-primary border rounded"><a href="/proyecto?id=${project.id}&limit=5&page=1" class="text-white"><i class="fa-solid fa-pen-to-square"></i></a></td>

      </tr>`
    }
  })
  content_projects.innerHTML = template
}

function buildMembers() {
  const current_id_user = document.querySelector('#current_id_user')
  let current_id_user_val = Number(current_id_user.getAttribute('data-id'))
  let template = ''
  let id = getParameterByName('id')
  const teams__container = document.querySelector('#teams__container')
  const members = getMembers(id).then((data) => {
    data.forEach((member) => {
      template += `
                     <div class="col-5 d-flex justify-content-center">
                        <nav class="navbar navbar-expand-sm">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle d-flex justify-content-center" href="/seguidor?id=${member.id}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      <img class="rounded-circle w-40 img-responsive" src="/build/img/${member.avatar}">
                                      </img>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="/seguidor?id=${member.id}">Ver Perfil</a></li>
                                        
                                        <li class="d-none">${member.id}</li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

      `

      member.id != current_id_user_val
        ? (template += `                     <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_send_message" onclick="dataMessageGeneral(${member.id});">Enviar mensaje</a></li>`)
        : ''
      template += `
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
            `
    })
    teams__container.innerHTML = template
  })
}

async function getMembers(project_id) {
  let url = 'https://youtask.es/api/getMembersByProject'
  const data = new FormData()
  let currentURL = window.location.pathname
  data.append('id', project_id)

  if (currentURL == '/proyecto') {
    data.append('limit', 4)
  }

  const request = await fetch(url, {
    method: 'POST',
    body: data,
  })

  const response = await request.json()

  return response
}

function accept_request_follower(id_request) {
  $.post(
    'https://youtask.es/api/accept-follower',
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
  let url = 'https://youtask.es/api/accept-reject'
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
      'https://youtask.es/api/send-resquest-friend',
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
        url: 'https://youtask.es/api/search-friends-for-name',
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
                  'https://youtask.es/api/check-request-follower',
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

/**
 * @return [type]
 */
function send_response_comment() {
  let url = 'https://youtask.es/api/send_response_comment'

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
        'https://youtask.es/api/post/delete',
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
    window.location.href = `https://youtask.es/modificar-post?id=${id_element}`
  })
}

function deleteFriend() {
  $(document).on('click', '.delete_friend', (element) => {
    if (confirm('¿Estas seguro que quieres eliminar este seguidor?')) {
      let id_element =
        element.target.parentElement.parentElement.children[2].textContent

      $.post(
        'https://youtask.es/api/friends/delete',
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

  try {
    const url = 'https://youtask.es/api/friends'
    const result = await fetch(url)
    const friends = await result.json()
    if (currentURL == '/seguidores') {
      createFriendsList(friends[1], friends[0])
    }
  } catch (error) {
    console.log(error)
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

/**
 * @return [type]
 */
async function listPosts() {
  let currentURL = window.location.pathname

  if (currentURL == '/posts' || currentURL == '/perfil') {
    try {
      const url = 'https://youtask.es/api/posts'
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

/**
 * @return [type]
 */
async function getEvents() {
  let url = 'https://youtask.es/api/getEvents'

  const request = await fetch(url, {
    method: 'GET',
  })

  const response = await request.json()

  return response
}

/**
 * @return [type]
 */
async function buildEvents() {
  console.log('cargando eventos')

  const events = await getEvents()
  const start_event = document.querySelector('#start_event')
  const modalEvent = document.querySelector('#staticBackdrop')
  const body__calendar_event = modalEvent.querySelector(
    '#modal__calendar_event',
  )
  const modal__footer = modalEvent.querySelector('#modal__footer')

  var calendarEl = document.getElementById('calendar')
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'es',
    events: events,
    dateClick: function (info) {
      start_event.value = info.dateStr
      const modalCreateEvent = document.querySelector('#modalCreateEvent')
      modalCreateEvent.classList.add('show')
      //alert('Clicked on: ' + info.dateStr)
      //alert('Current view: ' + info.view.type)
    },
    eventClick: function (info) {
      let init = info.event._instance.range.start.toLocaleDateString()
      let end = info.event._instance.range.end.toLocaleDateString()

      let templateModalEvent = ''
      modalEvent.classList.add('show')
      templateModalEvent = `
        <div class="row">
          <div class="col-12- col-md-10 d-flex flex-column flex-wrap">
            <h3><a class="text-decoration-none text-dark text-capitalize" href="/tarea?id=${info.event.extendedProps.taskID}">
            ${info.event.title}</a></h3>
            <p>${info.event.extendedProps.description}</p>
            <span>Inicio: ${init}</span>
            <span>Fin: ${end}</span>
          </div>
        </div>
      `
      body__calendar_event.innerHTML = templateModalEvent
      modal__footer.innerHTML = ` 
      <button type="button" id="btn_close_modal_event" data-dismiss="#staticBackdrop" class="btn btn-secondary" onclick="closeModal('#staticBackdrop')">Cerrar</button>
      <button type="button" onclick="deleteEvent(${info.event.extendedProps.eventID})" class="btn btn-danger">Eliminar</button>
      `
    },
  })
  calendar.render()
}

/**
 * @return [type]
 */
function closeModal(modal) {
  $(modal).removeClass('show')
}

/**
 * @return [type]
 */
async function createEventC() {
  const modalCreateEvent = document.querySelector('#modalCreateEvent')
  modalCreateEvent.classList.add('show')

  const data = new FormData()
  let url = 'https://youtask.es/api/createEventC'

  let id_task = document.querySelector('#id_task').value

  let init = document.querySelector('#start_event')
  let end = document.querySelector('#end_event')

  try {
    //validamos fechas
    if (!ValidateDateEvent(init.valueAsDate, end.valueAsDate)) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Fechas incorrectas',
      })
      return
    }

    data.append('id_task', id_task)
    data.append('start', init.value)
    data.append('end', end.value)

    const request = await fetch(url, {
      method: 'POST',
      body: data,
    })

    const response = await request.json()

    if (!response) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '¡Ha ocurrido un error!',
      })
      return
    }

    Swal.fire('Evento creado correctamente', '', 'success')
    closeModal('#modalCreateEvent')
    init.value = ''
    end.value = ''

    buildEvents()
  } catch (error) {
    console.log(error)
  }
}

/**
 * @param mixed eventID
 *
 * @return [type]
 */
async function deleteEvent(eventID) {
  await deleteAny(eventID, 'events')
  buildEvents()
  closeModal('#staticBackdrop')

  console.log('delete')
}

/**
 * @param date init
 * @param date end
 *
 * @return bool
 */
function ValidateDateEvent(init, end) {
  let result = true
  const xhoy = new Date()

  xhoy.setMilliseconds(0)
  xhoy.setSeconds(0)
  xhoy.setMinutes(0)
  xhoy.setHours(0)

  init.setMilliseconds(0)
  init.setSeconds(0)
  init.setMinutes(0)
  init.setHours(0)

  result = init <= end && init >= xhoy

  return result
}

function getEventsByTask() {}

/**
 * @param mixed friends
 * @param mixed count
 *
 * @return [type]
 */
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

/**
 * @return [type]
 */
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

/**
 * @return [type]
 */
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

/**
 * @return [type]
 */
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

/**
 * @return [type]
 */
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

function onSubmit(token) {
  document.getElementById('form_login').submit()
}

function destroyCookies() {
  const accept_cookies = document.querySelector('#btn-aceptar-cookies')
  const cookies = document.querySelector('.cookies')

  if (cookies == null) {
    return
  }

  dataLayer = []

  if (!localStorage.getItem('cookies-aceptadas')) {
    cookies.classList.add('activo')
  } else {
    dataLayer.push({ event: 'cookies-aceptadas' })
    cookies.remove()
  }

  accept_cookies.addEventListener('click', () => {
    console.log('click')
    cookies.remove()

    localStorage.setItem('cookies-aceptadas', true)

    dataLayer.push({ event: 'cookies-aceptadas' })
  })
}
