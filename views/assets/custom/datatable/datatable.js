var page;

function execDatatable(text) {
    /*=============================================
    Validamos tabla de administradores
    =============================================*/
    if ($(".tableAdmins").length > 0) {
        var url =
            "ajax/admins/data-admins.php?text=" +
            text +
            "&between1=" +
            $("#between1").val() +
            "&between2=" +
            $("#between2").val() +
            "&token=" +
            localStorage.getItem("token_user");
        var columns = [
            { data: "id_user" },
            {
                data: "picture_user",
                orderable: false,
                search: false,
                className: "text-center",
            },
            { data: "displayname_user" },
            { data: "username_user" },
            { data: "email_user" },
            { data: "rol_user", className: "text-center" },
            { data: "state_user", className: "text-center" },
            { data: "ruc_company" },
            { data: "name_company" },
            { data: "city_company" },
            { data: "date_created_user" },
            { data: "actions", orderable: false, className: "text-center" },
        ];
        var order = [[0, "asc"]];
        var aLengthMenu = [
            [10, 50, 100, 500, 1000],
            [10, 50, 100, 500, 1000],
        ];
        page = "admins";
    }

    /*=============================================
    Validamos tabla de categorias
    =============================================*/
    if ($(".tableCategories").length > 0) {
        var url =
            "ajax/categories/data-categories.php?text=" +
            text +
            "&between1=" +
            $("#between1").val() +
            "&between2=" +
            $("#between2").val() +
            "&token=" +
            localStorage.getItem("token_user");
        var columns = [
            { data: "id_category" },
            { data: "code_category" },
            { data: "name_category" },
            { data: "group_category" },
            { data: "date_created_category" },
            { data: "actions", orderable: false, className: "text-center" },
        ];
        var order = [[1, "asc"]];
        var aLengthMenu = [
            [20, 50, 100, 500, 1000],
            [20, 50, 100, 500, 1000],
        ];
        page = "categories";
    }

    /*=============================================
    Validamos tabla de laboratorios
    =============================================*/
    if ($(".tableLaboratories").length > 0) {
        var url =
            "ajax/laboratories/data-laboratories.php?text=" +
            text +
            "&between1=" +
            $("#between1").val() +
            "&between2=" +
            $("#between2").val() +
            "&token=" +
            localStorage.getItem("token_user");
        var columns = [
            { data: "id_laboratory" },
            { data: "code_laboratory" },
            { data: "ruc_laboratory" },
            { data: "bussiness_name_laboratory" },
            { data: "name_laboratory" },
            { data: "phone1_laboratory" },
            { data: "email_laboratory" },
            { data: "contact_laboratory" },
            { data: "state_laboratory" },
            { data: "date_created_laboratory" },
            { data: "actions", orderable: false, className: "text-center" },
        ];
        var order = [[1, "asc"]];
        var aLengthMenu = [
            [20, 50, 100, 500, 1000],
            [20, 50, 100, 500, 1000],
        ];
        page = "laboratories";
    }

    /*=============================================
    Validamos tabla de terapias
    =============================================*/
    if ($(".tableTherapies").length > 0) {
        var url =
            "ajax/therapies/data-therapies.php?text=" +
            text +
            "&between1=" +
            $("#between1").val() +
            "&between2=" +
            $("#between2").val() +
            "&token=" +
            localStorage.getItem("token_user");
        var columns = [
            { data: "id_therapy" },
            { data: "code_therapy" },
            { data: "name_therapy" },
            { data: "state_therapy" },
            { data: "date_created_therapy" },
            { data: "actions", orderable: false, className: "text-center" },
        ];
        var order = [[1, "asc"]];
        var aLengthMenu = [
            [20, 50, 100, 500, 1000],
            [20, 50, 100, 500, 1000],
        ];
        page = "therapies";
    }

    /*=============================================
    Validamos tabla de sustancias
    =============================================*/
    if ($(".tableSubstances").length > 0) {
        var url =
            "ajax/substances/data-substances.php?text=" +
            text +
            "&between1=" +
            $("#between1").val() +
            "&between2=" +
            $("#between2").val() +
            "&token=" +
            localStorage.getItem("token_user");
        var columns = [
            { data: "id_substance" },
            { data: "code_substance" },
            { data: "name_substance" },
            { data: "state_substance" },
            { data: "date_created_substance" },
            { data: "actions", orderable: false, className: "text-center" },
        ];
        var order = [[1, "asc"]];
        var aLengthMenu = [
            [20, 50, 100, 500, 1000],
            [20, 50, 100, 500, 1000],
        ];
        page = "substances";
    }

    /*=============================================
    Validamos tabla de articles
    =============================================*/
    if ($(".tableArticles").length > 0) {
        var url =
            "ajax/articles/data-articles.php?text=" +
            text +
            "&between1=" +
            $("#between1").val() +
            "&between2=" +
            $("#between2").val() +
            "&token=" +
            localStorage.getItem("token_user");
        var columns = [
            { data: "id_article" },
            { data: "code_article" },
            { data: "name_article" },
            { data: "name_category" },
            { data: "name_laboratory" },
            { data: "prescription_article", className: "text-center" },
            { data: "state_article", className: "text-center" },
            { data: "date_created_article" },
            { data: "actions", orderable: false, className: "text-center" },
        ];
        var order = [[1, "asc"]];
        var aLengthMenu = [
            [20, 50, 100, 500, 1000],
            [20, 50, 100, 500, 1000],
        ];
        page = "articles";
    }

    adminsTable = $("#adminsTable").DataTable({
        responsive: true,
        lengthChange: true,
        aLengthMenu: aLengthMenu,
        autoWidth: false,
        processing: true,
        serverSide: true,
        order: order,
        ajax: {
            url: url,
            type: "POST",
        },
        columns: columns,
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            oAria: {
                sSortAscending:
                    ": Activar para ordenar la columna de manera ascendente",
                sSortDescending:
                    ": Activar para ordenar la columna de manera descendente",
            },
        },
        buttons: [
            { extend: "copy", className: "btn-dark" },
            { extend: "csv", className: "btn-dark" },
            { extend: "excel", className: "btn-dark" },
            { extend: "pdf", className: "btn-dark" },
            { extend: "print", className: "btn-dark" },
            { extend: "colvis", className: "btn-dark" },
        ],
        fnDrawCallback: function (oSettings) {
            if (oSettings.aoData.length == 0) {
                $(".dataTables_paginate").hide();
                $(".dataTables_info").hide();
            } else {
                $(".dataTables_paginate").show();
                $(".dataTables_info").show();
            }
        },
    });

    if (text == "flat") {
        $("#adminsTable").on("draw.dt", function () {
            setTimeout(function () {
                adminsTable
                    .buttons()
                    .container()
                    .appendTo("#adminsTable_wrapper .col-md-6:eq(0)");
            }, 100);
        });
    }
}

execDatatable("html");

/*=============================================
Ejecutar reporte 
=============================================*/
function reportActive(event) {
    if (event.target.checked) {
        $("#adminsTable").dataTable().fnClearTable();
        $("#adminsTable").dataTable().fnDestroy();

        setTimeout(function () {
            execDatatable("flat");
        }, 100);
    } else {
        $("#adminsTable").dataTable().fnClearTable();
        $("#adminsTable").dataTable().fnDestroy();

        setTimeout(function () {
            execDatatable("html");
        }, 100);
    }
}

/*=============================================
Rango de fechas
=============================================*/
$("#daterange-btn").daterangepicker(
    {
        locale: {
            format: "YYYY-MM-DD",
            separator: " - ",
            applyLabel: "Aplicar",
            cancelLabel: "Cancelar",
            fromLabel: "Desde",
            toLabel: "Hasta",
            customRangeLabel: "Rango Personalizado",
            daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            monthNames: [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre",
            ],
            firstDay: 1,
        },
        ranges: {
            Hoy: [moment(), moment()],
            Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Últimos 7 días": [moment().subtract(6, "days"), moment()],
            "Últimos 30 días": [moment().subtract(29, "days"), moment()],
            "Este Mes": [moment().startOf("month"), moment().endOf("month")],
            "Último Mes": [
                moment().subtract(1, "month").startOf("month"),
                moment().subtract(1, "month").endOf("month"),
            ],
            "Este Año": [moment().startOf("year"), moment().endOf("year")],
            "Último Año": [
                moment().subtract(1, "year").startOf("year"),
                moment().subtract(1, "year").endOf("year"),
            ],
        },
        startDate: moment($("#between1").val()),
        endDate: moment($("#between2").val()),
    },
    function (start, end) {
        window.location =
            page +
            "?start=" +
            start.format("YYYY-MM-DD") +
            "&end=" +
            end.format("YYYY-MM-DD");
    }
);
