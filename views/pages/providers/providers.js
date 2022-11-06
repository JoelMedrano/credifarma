//* Función para validar datos del proveedor
function validateConsultaProviders(event, type) {
    $("#bussiness_name").val("");
    $("#address").val("");
    $("#ciudad").val("");
    $("#ciudad").select2();

    validateRepeat(event, type, "providers", "document_provider");

    var td_provider = document.getElementById("td_provider").value;

    if (td_provider == "1") {
        setTimeout(function () {
            var document_provider =
                document.getElementById("document_provider").value;

            if (document_provider != "") {
                if (document_provider.length == 8) {
                    matPreloader("on");
                    fncSweetAlert("loading", "Loading...", "");

                    var data = new FormData();
                    data.append("documento", document_provider);
                    data.append("tipo", td_provider);

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
                                $("#address")
                                    .parent()
                                    .addClass("was-validated");

                                $("#ciudad").val(data.data["ubigeo"][2]);
                                $("#ciudad").select2();
                                $("#ciudad").parent().addClass("was-validated");
                            }
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                        },
                    });
                } else {
                    event.target.value = "";
                    $(event.target).parent().addClass("was-validated");
                    $(event.target)
                        .parent()
                        .children(".invalid-feedback")
                        .html("El DNI debe tener 8 dígitos");
                }
            }
        }, 100);
    } else if (td_provider == "6") {
        setTimeout(function () {
            var document_provider =
                document.getElementById("document_provider").value;

            if (document_provider != "") {
                if (document_provider.length == 11) {
                    matPreloader("on");
                    fncSweetAlert("loading", "Loading...", "");

                    var data = new FormData();
                    data.append("documento", document_provider);
                    data.append("tipo", td_provider);

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
                                $("#address")
                                    .parent()
                                    .addClass("was-validated");

                                $("#ciudad").val(data.data["ubigeo"][2]);
                                $("#ciudad").select2();
                                $("#ciudad").parent().addClass("was-validated");
                            }
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                        },
                    });
                } else {
                    event.target.value = "";
                    $(event.target).parent().addClass("was-validated");
                    $(event.target)
                        .parent()
                        .children(".invalid-feedback")
                        .html("El RUC debe tener 11 dígitos");
                }
            }
        }, 100);
    }
}

//*Cambiar estado del proveedor
function changeState(event, idProvider) {
    if (event.target.checked) {
        var state = "1";
    } else {
        var state = "0";
    }

    var data = new FormData();
    data.append("state", state);
    data.append("idProvider", idProvider);
    data.append("token", localStorage.getItem("token_user"));

    $.ajax({
        url: "ajax/providers/ajax-providers.php",
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
