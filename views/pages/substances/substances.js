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

//*Ver el alternativas de la terapia
$(document).on("click", ".sustanciaPerfil", function () {
    $("p").remove(".similarBorrar");

    var id_substance = $(this).attr("idItem");
    console.log(
        "🚀 ~ file: therapies.js ~ line 38 ~ id_substance",
        id_substance
    );

    var dataSimilar = new FormData();
    dataSimilar.append("rel", "articles,substances");
    dataSimilar.append("type", "article,substance");
    dataSimilar.append(
        "select",
        "id_article,code_article,name_article,id_substance_article"
    );
    dataSimilar.append("linkTo", "id_substance_article");
    dataSimilar.append("equalTo", id_substance);
    dataSimilar.append("orderBy", "frac_stock_article");
    dataSimilar.append("orderMode", "desc");
    dataSimilar.append("startAt", "0");
    dataSimilar.append("endAt", "10");

    $.ajax({
        url: "ajax/ajax-select.php",
        method: "POST",
        data: dataSimilar,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(
                "🚀 ~ file: substances.js ~ line 65 ~ response",
                response
            );
            var substances = JSON.parse(response);

            if (substances.status == 404) {
                ('<p class="p-0 m-0 similarBorrar" id="similarBorrar"></p>');
            } else {
                for (let i = 0; i < substances.results.length; i++) {
                    $(".similares").append(
                        '<p class="p-0 m-0 similarBorrar" id="similarBorrar">' +
                            substances.results[i]["code_article"] +
                            " - " +
                            substances.results[i]["name_article"] +
                            "</p>"
                    );
                }
            }
        },
    });
});
