/*=============================================
Función para validar data repetida
=============================================*/
function validateConsulta(event, type, tipo) {
    validateRepeat(event, type, "laboratories", "ruc_laboratory");

    setTimeout(function () {
        var documento = document.getElementById("documento").value;

        if (tipo == "6") {
            if (documento.length == 11) {
                matPreloader("on");
                fncSweetAlert("loading", "Loading...", "");

                var data = new FormData();
                data.append("documento", documento);
                data.append("tipo", tipo);

                $.ajax({
                    url: "ajax/ajax-validate.php",
                    method: "POST",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response == "error") {
                            event.target.value = "";
                            $("#bussiness_name").val("");
                            $("#address").val("");
                            $("#ciudad").val("");
                            $("#ciudad").select2();
                        } else {
                            var data = JSON.parse(response);

                            $("#bussiness_name").val(
                                data.data["nombre_o_razon_social"]
                            );

                            $("#bussiness_name")
                                .parent()
                                .addClass("was-validated");

                            $("#address").val(data.data["direccion"]);
                            $("#address").parent().addClass("was-validated");

                            $("#ciudad").val(data.data["ubigeo"][2]);
                            $("#ciudad").select2();
                            $("#ciudad").parent().addClass("was-validated");
                        }
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                    },
                });
            } else {
                $(event.target).parent().addClass("was-validated");
                $(event.target)
                    .parent()
                    .children(".invalid-feedback")
                    .html("El RUC debe tener 11 dígitos");
            }
        }
    }, 100);
}

/*=============================================
Cambiar estado del laboratorio
=============================================*/
function changeState(event, idLaboratory) {
    if (event.target.checked) {
        var state = "1";
    } else {
        var state = "0";
    }

    var data = new FormData();
    data.append("state", state);
    data.append("idLaboratory", idLaboratory);
    data.append("token", localStorage.getItem("token_user"));

    $.ajax({
        url: "ajax/laboratories/ajax-laboratories.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response == 200) {
                fncNotie(1, "the record was updated");
            } else {
                fncNotie(3, "Error updating registry");
            }
        },
    });
}
