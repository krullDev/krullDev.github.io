const entradaTarea = document.getElementById('tarea');
const botonTarea = document.getElementById('agregarTarea');
const listaTareas = document.getElementById('listaTareas');

function agregarElemento() {
  const textoTarea = entradaTarea.value.trim();

  if (textoTarea !== '') {
    const nuevaTarea = document.createElement('li');
    nuevaTarea.textContent = textoTarea;
    nuevaTarea.classList.add('pendiente');

    //Crear boton de eliminar
    const botonEliminar = document.createElement('button');
    botonEliminar.textContent = 'Eliminar';
    botonEliminar.classList.add('eliminar-btn');

    //Agregar el boton a la tarea
    nuevaTarea.appendChild(botonEliminar);
    listaTareas.appendChild(nuevaTarea);

    //Marcar tarea como completada 
    nuevaTarea.addEventListener('click', function (e) {
      //Evitar que el clic en el boton tambien active el evento del <li>
      if (e.target !== botonEliminar) {
        nuevaTarea.classList.toggle('completada');
      }
    });

    //Eliminar la tarea
    botonEliminar.addEventListener('click', function () {
      listaTareas.removeChild(nuevaTarea);
    });

    entradaTarea.value = ''; // limpiar campo
  }
}

botonTarea.addEventListener('click', agregarElemento);
