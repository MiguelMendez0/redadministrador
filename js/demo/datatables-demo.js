// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    lengthChange: false, // Oculta el selector de número de entradas
    searching: false,     // Oculta el cuadro de búsqueda
    pageLenght: 10
  });
});
