$(function () {
    $("#adminsTable").DataTable({
        responsive: true,
        lengthChange: true,
        aLengthMenu: [
            [10, 50, 100, 500, 1000],
            [10, 50, 100, 500, 1000],
        ],
        autoWidth: false,
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: {
            url: "ajax/data-admins.php",
            type: "POST",
        },
        columns: [
            { data: "id_user" },
            { data: "picture_user", orderable: false, search: false },
            { data: "displayname_user" },
            { data: "username_user" },
            { data: "email_user" },
            { data: "country_user" },
            { data: "city_user" },
            { data: "date_created_user" },
            { data: "actions", orderable: false },
        ],
        // "language": {

        //   "sProcessing":     "Procesando...",
        //   "sLengthMenu":     "Mostrar _MENU_ registros",
        //   "sZeroRecords":    "No se encontraron resultados",
        //   "sEmptyTable":     "Ningún dato disponible en esta tabla",
        //   "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        //   "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        //   "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        //   "sInfoPostFix":    "",
        //   "sSearch":         "Buscar:",
        //   "sUrl":            "",
        //   "sInfoThousands":  ",",
        //   "sLoadingRecords": "Cargando...",
        //   "oPaginate": {
        //     "sFirst":    "Primero",
        //     "sLast":     "Último",
        //     "sNext":     "Siguiente",
        //     "sPrevious": "Anterior"
        //   },
        //   "oAria": {
        //     "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        //     "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        //   }

        // },
        buttons: [
            { extend: "copy", className: "btn-dark" },
            { extend: "csv", className: "btn-dark" },
            { extend: "excel", className: "btn-dark" },
            { extend: "pdf", className: "btn-dark" },
            { extend: "print", className: "btn-dark" },
            { extend: "colvis", className: "btn-dark" },
        ],
    });
});
