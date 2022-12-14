/*=============================================
Cambiar estado del laboratorio
=============================================*/
function changeState(event, idSubstance) {
    if (event.target.checked) {
        var state = "1";
    } else {
        var state = "0";
    }

    var data = new FormData();
    data.append("state", state);
    data.append("idSubstance", idSubstance);
    data.append("token", localStorage.getItem("token_user"));

    $.ajax({
        url: "ajax/substances/ajax-substances.php",
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
