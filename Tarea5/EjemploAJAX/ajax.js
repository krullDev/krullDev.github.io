document.getElementById('cargar').addEventListener('click', function() {
  //Fetch para hacer una solicitud AJAX
  fetch('https://jsonplaceholder.typicode.com/users') // API pública de ejemplo (gracias a JSONPlaceholder)
    .then(response => response.json()) //Convertir la respuesta a JSON
    .then(data => {
      const contenedor = document.getElementById('datos');
      contenedor.innerHTML = ''; //Limpiar el contenido previo

      //Mosrtrar solo los primeros 5 usuarios
      data.slice(0, 5).forEach(usuario => {
        const p = document.createElement('p');
        p.textContent = `${usuario.name} (${usuario.email})`;
        contenedor.appendChild(p);
      });
    })
    .catch(error => {
      document.getElementById('datos').textContent = 'Error al cargar datos.';
      console.error('Error en la solicitud AJAX:', error);
    });
});
